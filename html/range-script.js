// Atualize o valor exibido ao lado da barra de deslizamento quando o usuário interagir com ela
// serve para manter os vlores do range no php e nos html

const sliders = document.querySelectorAll('input[type="range"]');
sliders.forEach((slider) => {
  const valueSpan = document.getElementById(`value${slider.name}`);
  slider.addEventListener('input', () => {
    valueSpan.textContent = slider.value;
  });
});