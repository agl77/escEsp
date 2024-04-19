const items = document.querySelectorAll('.item');
const topLikes = document.getElementById('top-likes');
const topDislikes = document.getElementById('top-dislikes');

let ratings = {};

function rateItem(button, type, rating) {
  const item = button.closest('.item');
  const itemName = item.querySelector('.item-name').textContent;
  
  // Remover classificações anteriores
  Object.keys(ratings).forEach(key => {
    if (ratings[key][itemName]) {
      delete ratings[key][itemName];
    }
  });

  // Adicionar classificação atual
  if (!ratings[type]) {
    ratings[type] = {};
  }
  ratings[type][itemName] = rating;

  updateLists();
}

function updateLists() {
  // Limpar as listas
  topLikes.innerHTML = '';
  topDislikes.innerHTML = '';

  // Ordenar itens por classificação
  const likesArray = Object.entries(ratings.like || {});
  const dislikesArray = Object.entries(ratings.dislike || {});

  // Ordenar por classificação (maior para menor)
  likesArray.sort((a, b) => b[1] - a[1]);
  dislikesArray.sort((a, b) => a[1] - b[1]);

  // Adicionar os itens às listas
  likesArray.slice(0, 5).forEach(item => {
    const li = document.createElement('li');
    li.textContent = item[0];
    topLikes.appendChild(li);
  });

  dislikesArray.slice(0, 5).forEach(item => {
    const li = document.createElement('li');
    li.textContent = item[0];
    topDislikes.appendChild(li);
  });
}
