//carrega as informações do cadastro selecionado no dropdown
function carregarInfoCadastro(idcadastro) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("infoCadastro").innerHTML = this.responseText;
            localStorage.setItem('dadosCadastro' , this.responseText);
        }
    };
    xhttp.open("GET", "../get_info_cadastro.php?idcadastro=" + idcadastro, true);
    xhttp.send();
}

// carrega do banco de dados as respostas do id do cadastro selecionado
function buscarDadosDoServidor(idCadastro) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            localStorage.setItem('dadosPerguntas', this.responseText);

            // Envia os dados para o PHP via AJAX
            var xhr = new XMLHttpRequest();
            var url = '../receber_dados.php';
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Recebe a resposta do PHP
                    var resposta = JSON.parse(xhr.responseText);

                    // Grava as respostas no localStorage
                    localStorage.setItem('respostas', JSON.stringify(resposta));

                    // Exibe as respostas recebidas
                    exibirRespostas(resposta);
                }
            };
            xhr.send(localStorage.getItem('dadosPerguntas'));
        }
    };
    xhttp.open("GET", "../get_dados_perguntas.php?idcadastro=" + idCadastro, true);
    xhttp.send();
}

// Função para exibir as respostas na página
function exibirRespostas(respostas) {
    var listaDados = document.getElementById('dadosRecebidos');
    listaDados.innerHTML = '';

    // Exibe as respostas recebidas
    for (var pergunta in respostas) {
        if (respostas.hasOwnProperty(pergunta)) {
            var respostaPergunta = respostas[pergunta];
            var itemLista = document.createElement('li');
            itemLista.textContent = pergunta + ': ' + respostaPergunta;
            listaDados.appendChild(itemLista);
        }
    }
}


document.addEventListener("DOMContentLoaded", function() {
var selectCadastro = document.getElementById('cadastro');
selectCadastro.addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var idCadastro = selectedOption.value.split(' - ')[0];
    buscarDadosDoServidor(idCadastro);
});
});