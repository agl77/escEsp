// Variáveis para controlar a página atual
let currentPage = 1;
const totalPages = 3; // Defina o número total de páginas do questionário

// Função para exibir a página atual
function showPage(pageNumber) {
    // Esconda todas as páginas
    for (let i = 1; i <= totalPages; i++) {
        document.getElementById(`page${i}`).style.display = 'none';
    }
    // Mostre a página atual
    document.getElementById(`page${pageNumber}`).style.display = 'block';
}

// Inicialmente, mostre a primeira página
showPage(currentPage);

// Botão "Anterior"
document.getElementById('prevPage').addEventListener('click', function() {
    if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
    }
});

// Botão "Próxima"
document.getElementById('nextPage').addEventListener('click', function() {
    if (currentPage < totalPages) {
        currentPage++;
        showPage(currentPage);
    }
});
