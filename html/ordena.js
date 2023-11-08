// ... (seu código JavaScript) ...

// Adicione event listeners para as novas divs vazias
const maisIdentificaDivs = document.querySelectorAll('.mais-identifica > div');
const menosIdentificaDivs = document.querySelectorAll('.menos-identifica > div');

[...maisIdentificaDivs, ...menosIdentificaDivs].forEach(div => {
    div.addEventListener('dragover', (e) => {
        e.preventDefault();
    });

    div.addEventListener('drop', (e) => {
        e.preventDefault();
        const especialidadeNome = e.dataTransfer.getData('text/plain');
        const especialidadeIdentificacao = e.dataTransfer.getData('identificacao');

        // Verifique se a especialidade não foi adicionada à outra coluna e se não excedeu 5 especialidades
        if (div.children.length < 1) {
            const especialidade = document.createElement('div');
            especialidade.className = 'especialidade';
            especialidade.textContent = especialidadeNome;
            especialidade.setAttribute('data-identificacao', especialidadeIdentificacao);
            div.appendChild(especialidade);
        }
    });
});
