//carrega as informações do cadastro selecionado no dropdown
function carregarInfoCadastro(idcadastro) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("infoCadastro").innerHTML = this.responseText;
            localStorage.setItem('dadosCadastro' , this.responseText);
        }
    };
    xhttp.open("GET", "get_info_cadastro.php?idcadastro=" + idcadastro, true);
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
            var url = 'receber_dados.php';
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
    xhttp.open("GET", "get_dados_perguntas.php?idcadastro=" + idCadastro, true);
    xhttp.send();
    
}
// Função para exibir as respostas na página
function exibirRespostas(respostas) {
    var tabelaDados = document.getElementById('dadosRecebidos');
    tabelaDados.innerHTML = ''; // Limpa qualquer conteúdo existente

    // Cria a tabela
    var tabela = document.createElement('table');
    
    // Cria a linha de cabeçalho
    var cabecalho = tabela.createTHead();
    var cabecalhoRow = cabecalho.insertRow();
    var cabecalhoCols = ['Característica', 'Pontos', 'n Quest', 'Percent'];
    cabecalhoCols.forEach(function(col) {
        var th = document.createElement('th');
        th.textContent = col;
        cabecalhoRow.appendChild(th);
    });

    // Adiciona os dados
    for (var caracteristica in respostas) {
        if (respostas.hasOwnProperty(caracteristica)) {
            var dado = respostas[caracteristica];
            var linha = tabela.insertRow();
            var celulaCaracteristica = linha.insertCell();
            var celulaPontuacao = linha.insertCell();
            var celulaTotalQuestoes = linha.insertCell();
            var celulaPercentual = linha.insertCell();
            celulaCaracteristica.textContent = caracteristica;
            celulaPontuacao.textContent = dado.pontuacao;
            celulaTotalQuestoes.textContent = dado.total_questoes;
            celulaPercentual.textContent = dado.percentual + "%";
        }
    }

    // Adiciona a tabela ao elemento HTML
    tabelaDados.appendChild(tabela);
}

//carrega os dados das especializações em uma página
function buscarDadosEspecializacao(idCadastro) {
    // Create an AJAX request
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `get_dados_especializacao.php?idcadastro=${idCadastro}`);
  
    // Handle response
    xhr.onload = function() {
      if (xhr.status === 200) {
        const dados = JSON.parse(xhr.responseText);
  
        // Extract data
        const likedData = dados.liked;
        const dislikedData = dados.disliked;
        const selectedValuesData = dados.selectedValues;
  
        // Store data in localStorage
        localStorage.setItem('maisIdentifica', JSON.stringify(likedData));
        localStorage.setItem('menosIdentifica', JSON.stringify(dislikedData));
        localStorage.setItem('selecionaValores', JSON.stringify(selectedValuesData));
        // Display data in table cells
        document.getElementById('mais-se-identifica').innerHTML = JSON.stringify(likedData);
        document.getElementById('menos-se-identifica').innerHTML = JSON.stringify(dislikedData);
        document.getElementById('valores-selecionados').innerHTML = JSON.stringify(selectedValuesData);

      // Perform any necessary actions after storing data
  
        // Perform any necessary actions after storing data
        console.log('Dados armazenados com sucesso!');
      } else {
        console.error(`Erro ao obter dados: ${xhr.statusText}`);
      }
    };
  
    // Send the request
    xhr.send();
  }

function atualizarResultadosPersonalidade(dados) {
    const respostasLocalStorage = JSON.parse(localStorage.getItem("respostas"));
    let resultadoIntroversaoExt = "";
    let resultadoIntuicaoSenc = "";
    let resultadoPensamentoSent = "";
    resultadoIntroversaoExt = respostasLocalStorage["Introversão"].pontuacao / respostasLocalStorage["Entroversão"].pontuacao
    resultadoIntuicaoSenc = respostasLocalStorage["Intuição"].pontuacao / respostasLocalStorage["Sensação"].pontuacao
    resultadoPensamentoSent = respostasLocalStorage["Pensamento"].pontuacao / respostasLocalStorage["Sentimento"].pontuacao

    document.getElementById("mais-se-identifica").textContent = resultadoIntroversaoExt;
    document.getElementById("menos-se-identifica").textContent = resultadoIntuicaoSenc;
    document.getElementById("valores-selecionados").textContent = resultadoPensamentoSent;
}

document.addEventListener("DOMContentLoaded", function() {
var selectCadastro = document.getElementById('cadastro');
selectCadastro.addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var idCadastro = selectedOption.value.split(' - ')[0];
    buscarDadosDoServidor(idCadastro);
    buscarDadosEspecializacao(idCadastro);
    
});
});