// prévisu de la pyramide
const slider = document.getElementById("sliderPyramide");
const value = document.getElementById("valeurPyramide");
const preview = document.getElementById("previewPyramide");

function renderPyramide(n) {
  preview.innerHTML = "";
  for (let i = 1; i <= n; i++) {
    const row = document.createElement("div");
    row.className = "preview-row";
    row.style.width = `${i * 24}px`;
    preview.appendChild(row);
  }
}

value.textContent = slider.value; 
renderPyramide(slider.value);

slider.addEventListener("input", () => {
  value.textContent = slider.value;
  renderPyramide(slider.value);
});



// Light/Dark Mode

// Sélecteurs
const root = document.documentElement;
const btn = document.getElementById("themeToggleBtn");

// 1. Charger le thème stocké ou détecter le thème système
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

// 2. Toggle au clic
btn.addEventListener("click", () => {
    const current = root.getAttribute("data-theme");
    const next = current === "light" ? "dark" : "light";
    root.setAttribute("data-theme", next);
    localStorage.setItem("theme", next);
    updateIcon(next);
});

// 3. Changer l’icône selon le thème
function updateIcon(theme) {
    if (theme === "light") {
        btn.innerHTML = '<i class="fa-solid fa-moon"></i>';
    } else {
        btn.innerHTML = '<i class="fa-solid fa-sun"></i>';
    }
}
