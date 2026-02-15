// ---------------------------------------------------------
// PRÉVISU DE LA PYRAMIDE (uniquement sur home.php)
// ---------------------------------------------------------
const slider = document.getElementById("sliderPyramide");
const value = document.getElementById("valeurPyramide");
const preview = document.getElementById("previewPyramide");

if (slider && value && preview) {

    function renderPyramide(n) {
        preview.innerHTML = "";
        for (let i = 1; i <= n; i++) {
            const row = document.createElement("div");
            row.className = "preview-row";
            preview.appendChild(row);
        }
    }

    value.textContent = slider.value;
    renderPyramide(slider.value);

    slider.addEventListener("input", () => {
        value.textContent = slider.value;
        renderPyramide(slider.value);
    });
}



// ---------------------------------------------------------
// LIGHT / DARK MODE
// ---------------------------------------------------------

const root = document.documentElement;
const btn = document.getElementById("themeToggleBtn");

const savedTheme = localStorage.getItem("theme");

if (savedTheme) {
    root.setAttribute("data-theme", savedTheme);
    updateIcon(savedTheme);
} else {
    const prefersLight = window.matchMedia("(prefers-color-scheme: light)").matches;
    const defaultTheme = prefersLight ? "light" : "dark";
    root.setAttribute("data-theme", defaultTheme);
    updateIcon(defaultTheme);
}

btn.addEventListener("click", () => {
    const current = root.getAttribute("data-theme");
    const next = current === "light" ? "dark" : "light";
    root.setAttribute("data-theme", next);
    localStorage.setItem("theme", next);
    updateIcon(next);
});

function updateIcon(theme) {
    if (theme === "light") {
        btn.innerHTML = '<i class="fa-solid fa-moon"></i>';
    } else {
        btn.innerHTML = '<i class="fa-solid fa-sun"></i>';
    }
}



// ---------------------------------------------------------
// INTERACTIONS AVEC LES BATONS
// ---------------------------------------------------------

document.querySelectorAll(".baton").forEach(baton => {

    baton.addEventListener("mouseenter", () => {
        const ligne = baton.dataset.ligne;
        const index = parseInt(baton.dataset.index);

        document.querySelectorAll(`.baton[data-ligne="${ligne}"]`).forEach(b => {
            if (parseInt(b.dataset.index) <= index) {
                b.classList.add("preview");
            }
        });
    });

    baton.addEventListener("mouseleave", () => {
        document.querySelectorAll(".baton.preview").forEach(b => {
            b.classList.remove("preview");
        });
    });

    baton.addEventListener("click", () => {
        const ligne = baton.dataset.ligne;
        const index = parseInt(baton.dataset.index);

        document.querySelectorAll(`.baton[data-ligne="${ligne}"]`).forEach(b => {
            if (parseInt(b.dataset.index) <= index) {
                b.classList.add("disappear");
            }
        });

        setTimeout(() => {
            const form = document.createElement("form");
            form.method = "post";
            form.action = "?action=play";

            const inputLigne = document.createElement("input");
            inputLigne.type = "hidden";
            inputLigne.name = "ligne";
            inputLigne.value = ligne;

            const inputChoix = document.createElement("input");
            inputChoix.type = "hidden";
            inputChoix.name = "choix";
            inputChoix.value = index + 1;

            form.appendChild(inputLigne);
            form.appendChild(inputChoix);
            document.body.appendChild(form);

            form.submit();
        }, 300);
    });

});


// faire disparaitre les messages de jeu
document.addEventListener("DOMContentLoaded", () => { const messages = document.querySelectorAll(".messages-jeu .message");
    messages.forEach((msg, index) => { setTimeout(() => { msg.classList.add("fade-out");

     }, 2500 + index * 300);
    });
});



// ---------------------------------------------------------
// CONFETTIS DE VICTOIRE (uniquement sur end.php)
// ---------------------------------------------------------
const victoryFlag = document.getElementById("victory-flag");

if (victoryFlag) {
    const winner = victoryFlag.dataset.winner;

    const div = document.createElement("div");
    div.style.position = "fixed";
    div.style.top = "50%";
    div.style.left = "50%";
    div.style.transform = "translate(-50%, -50%) scale(0)";
    div.style.fontSize = "4rem";
    div.style.fontWeight = "bold";
    div.style.color = "var(--text)";
    div.style.textAlign = "center";
    div.style.zIndex = 2;
    div.style.transition = "transform 0.6s ease, opacity 0.6s ease";
    div.style.opacity = 0;

    if (winner === "joueur1") {
        // Victoire
        div.innerHTML = "Félicitations!<br>Tu m'as battu!";

        // Confettis
        const script = document.createElement("script");
        script.src = "https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js";
        document.body.appendChild(script);
        script.onload = () => {
            setTimeout(() => {
                confetti({
                    particleCount: 2000,
                    spread: 180,
                    origin: { y: 0.5 }
                });
            }, 300);
        };
    } else {
        // Défaite
    div.innerHTML = "Perdu!<br>Retente ta chance…";
    }

    document.body.appendChild(div);

    setTimeout(() => {
        div.style.transform = "translate(-50%, -50%) scale(1)";
        div.style.opacity = 1;
    }, 50);
}


// JS pour la modal CV

let modal = null

const openModal = function (e) {
    e.preventDefault()
    const targetSelector = e.target.getAttribute('data-target')
    const target = document.querySelector(targetSelector)
    if (!target) return

    target.style.display = "flex"
    target.removeAttribute('aria-hidden')
    target.setAttribute('aria-modal', 'true')
    modal = target

    // Fermer en cliquant sur l'overlay
    modal.addEventListener('click', closeModal)

    // Fermer via bouton X (si présent)
    const btnClose = modal.querySelector('.js-modal-close')
    if (btnClose) {
        btnClose.addEventListener('click', closeModal)
    }

    // Stop propagation sur le contenu
    const modalContent = modal.querySelector('.js-modal-stop')
    if (modalContent) {
        modalContent.addEventListener('click', stopPropagation)
    }
}

const closeModal = function (e) {
    if (!modal) return
    e.preventDefault()

    modal.setAttribute('aria-hidden', 'true')
    modal.removeAttribute('aria-modal')

    modal.removeEventListener('click', closeModal)

    // Retirer listener sur le bouton X (si présent)
    const btnClose = modal.querySelector('.js-modal-close')
    if (btnClose) {
        btnClose.removeEventListener('click', closeModal)
    }

    // Retirer listener sur le contenu
    const modalContent = modal.querySelector('.js-modal-stop')
    if (modalContent) {
        modalContent.removeEventListener('click', stopPropagation)
    }

    const hideModal = function () {
        modal.style.display = "none"
        modal.removeEventListener('animationend', hideModal)
        modal = null
    }
    modal.addEventListener('animationend', hideModal)
}

const stopPropagation = function(e) {
    e.stopPropagation()
}

// Boutons pour ouvrir la modal
document.querySelectorAll('.js-modal').forEach(btn => {
    btn.addEventListener('click', openModal)
})

// Fermer la modal avec Escape
window.addEventListener('keydown', function (e){
    if(e.key === "Escape" || e.key === "Esc"){
        closeModal(e)
    }
})



