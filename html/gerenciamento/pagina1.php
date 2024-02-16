<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receber Dados do PHP</title>
</head>
<body>
    <h1>Pontuação das Variáveis</h1>
    <ul id="pontuacao-lista">
        <!-- Aqui serão inseridos os itens da lista de pontuação -->
    </ul>

    <script>
        // Lê os dados do localStorage
        var dadosLocalStorage = localStorage.getItem('dadosCadastro');

        // Envia os dados para o PHP via AJAX
        var xhr = new XMLHttpRequest();
        var url = 'receber_dados.php';
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Recebe a resposta do PHP
                var resposta = JSON.parse(xhr.responseText);

                // Seleciona a lista de pontuação
                var listaPontuacao = document.getElementById('pontuacao-lista');

                // Itera sobre as chaves e valores da resposta
                for (var chave in resposta) {
                    if (resposta.hasOwnProperty(chave)) {
                        // Cria um item da lista para cada chave e valor
                        var itemLista = document.createElement('li');
                        itemLista.textContent = chave + ': ' + resposta[chave];
                        // Adiciona o item à lista
                        listaPontuacao.appendChild(itemLista);
                    }
                }

                // Imprime a resposta do PHP no console
                console.log('Resposta do PHP:', resposta);
            }
        };
        xhr.send(dadosLocalStorage);
    </script>
</body>
</html>
