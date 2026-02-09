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
