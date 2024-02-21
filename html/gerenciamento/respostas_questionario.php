<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div id="pageContent">
    <!-- Aqui serão exibidos os dados do localStorage -->
</div>

<script>
// Recupera os dados do localStorage
var respostasQuestionario = localStorage.getItem('respostasQuestionario');

// Verifica se os dados foram recuperados corretamente
if (respostasQuestionario !== null) {
    // Converte os dados para um objeto JavaScript
    var dados = JSON.parse(respostasQuestionario);

    // Cria uma lista para exibir os dados
    var lista = document.createElement('ul');

    // Itera sobre os dados e cria itens de lista para cada chave-valor
    for (var chave in dados) {
        if (dados.hasOwnProperty(chave)) {
            var itemLista = document.createElement('li');
            itemLista.textContent = chave + ': ' + dados[chave];
            lista.appendChild(itemLista);
        }
    }

    // Adiciona a lista à página
    document.getElementById('pageContent').appendChild(lista);
} else {
    // Caso não haja dados no localStorage, exibe uma mensagem indicando isso
    document.getElementById('pageContent').textContent = 'Nenhum dado encontrado no localStorage "respostasQuestionario".';
}
</script>

</body>
</html>pontuacao-lista