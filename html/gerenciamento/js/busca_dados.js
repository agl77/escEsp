document.addEventListener("DOMContentLoaded", function() {
    var selectCadastro = document.getElementById('cadastro');
    selectCadastro.addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var idCadastro = selectedOption.value.split(' - ')[0];
        
        // Chama as funções para buscar dados do servidor
        buscarDadosDoServidor(idCadastro);
        buscarDadosEspecializacao(idCadastro);
    });
});

// Carrega as informações do cadastro selecionado no dropdown
function carregarInfoCadastro(idcadastro) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("infoCadastro").innerHTML = this.responseText;
            localStorage.setItem('dadosCadastro', this.responseText);
        }
    };
    xhttp.open("GET", "get_info_cadastro.php?idcadastro=" + idcadastro, true);
    xhttp.send();
}

// Carrega do banco de dados as respostas do id do cadastro selecionado
function buscarDadosDoServidor(idCadastro) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                var dadosPerguntas = JSON.parse(this.responseText);
                localStorage.setItem('dadosPerguntas', JSON.stringify(dadosPerguntas));

                // Envia os dados para o PHP via AJAX
                var xhr = new XMLHttpRequest();
                var url = 'receber_dados.php';
                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        try {
                            var resposta = JSON.parse(xhr.responseText);

                            // Grava as respostas no localStorage
                            localStorage.setItem('respostas', JSON.stringify(resposta));

                            // Exibe as respostas recebidas
                            exibirRespostas(resposta);
                        } catch (e) {
                            console.error("Erro ao parsear a resposta JSON:", e, xhr.responseText);
                        }
                    }
                };
                xhr.send(JSON.stringify(dadosPerguntas));
            } catch (e) {
               // console.error("Erro ao parsear a resposta JSON:", e, this.responseText);
            }
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
    carregafuncoes();
}

// Carrega os dados das especializações em uma página
function buscarDadosEspecializacao(idCadastro) {
    // Cria uma requisição AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `get_dados_especializacao.php?idcadastro=${idCadastro}`);

    // Trata a resposta
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                const dados = JSON.parse(xhr.responseText);

                // Extrai os dados
                const likedData = dados.liked;
                const dislikedData = dados.disliked;
                const selectedValuesData = dados.selectedValues;

                // Armazena os dados no localStorage
                localStorage.setItem('maisIdentifica', JSON.stringify(likedData));
                localStorage.setItem('menosIdentifica', JSON.stringify(dislikedData));
                localStorage.setItem('selecionaValores', JSON.stringify(selectedValuesData));

                // Exibe os dados nas células da tabela
                document.getElementById('mais-se-identifica').innerHTML = JSON.stringify(likedData);
                document.getElementById('menos-se-identifica').innerHTML = JSON.stringify(dislikedData);
                document.getElementById('valores-selecionados').innerHTML = JSON.stringify(selectedValuesData);
                
            } catch (e) {
                //console.error("Erro ao parsear a resposta JSON:", e, xhr.responseText);
            }
        } else {
            //console.error(`Erro ao obter dados: ${xhr.statusText}`);
        }
    };

    // Envia a requisição
    xhr.send();
    
}

function atualizarResultadosPersonalidade() {
    const respostasLocalStorage = JSON.parse(localStorage.getItem("respostas"));
    let resultadoR1 = "";
    let resultadoR2 = "";
    let resultadoR3 = "";
    let valorR2 = 0;
    let valorR3 = 0;
    let funcaoPersonalidade = "";

    if (respostasLocalStorage["Introversão"].percentual >= respostasLocalStorage["Extroversão"].percentual) {
        resultadoR1 = "I";
    } else { 
        resultadoR1 = "E"; 
    }

    if (respostasLocalStorage["Intuição"].percentual >= respostasLocalStorage["Sensação"].percentual){
        resultadoR2 = "In";
        valorR2 = respostasLocalStorage["Intuição"].percentual;
    } else { 
        resultadoR2 = "Ss"; 
        valorR2 = respostasLocalStorage["Sensação"].percentual;
    }

    if (respostasLocalStorage["Pensamento"].percentual >= respostasLocalStorage["Sentimento"].percentual){
        resultadoR3 = "Ps";
        valorR3 = respostasLocalStorage["Pensamento"].percentual;
    } else { 
        resultadoR3 = "St";  // Adicionado ponto e vírgula aqui
        valorR3 = respostasLocalStorage["Sentimento"].percentual;
    }

    // Monta a função principal e Auxiliar para apresentar na pagina
    if (valorR2 >= valorR3){
        funcaoPersonalidade = resultadoR1 + " " + resultadoR2 + " " + resultadoR3;
    } else {
        funcaoPersonalidade = resultadoR1 + " " + resultadoR3 + " " + resultadoR2;
    }

    document.getElementById("R1").textContent = resultadoR1;
    document.getElementById("R2").textContent = resultadoR2;
    document.getElementById("R3").textContent = resultadoR3;
    document.getElementById("personalidade").textContent = funcaoPersonalidade;

    // Grava os valores no localStorage
    let personalidade = {
        R1: resultadoR1,
        R2: resultadoR2,
        R3: resultadoR3,
        funcao: funcaoPersonalidade
    };
    localStorage.setItem("personalidade", JSON.stringify(personalidade));
}

function buscarCaracteristicasPrevalentes() {
    // Pega as respostas do localStorage e parseia para um objeto
    const respostas = JSON.parse(localStorage.getItem('respostas'));

    if (!respostas) {
        console.error('Nenhum dado encontrado no localStorage com a chave "respostas".');
        return;
    }

    // Características a serem desconsideradas
    const ignorar = ["Extroversão", "Introversão", "Intuição", "Sensação", "Pensamento", "Sentimento", "Saúde"];

    // Filtra e organiza as características válidas em ordem decrescente de percentual
    const caracteristicasValidas = Object.keys(respostas)
        .filter(key => !ignorar.includes(key) && respostas[key].percentual > 50)
        .map(key => ({ caracteristica: key, percentual: respostas[key].percentual }))
        .sort((a, b) => b.percentual - a.percentual);

    // Armazena todas as características com percentual maior que 50 no localStorage
    localStorage.setItem('caracteristicasPrevalentes', JSON.stringify(caracteristicasValidas));

    console.log('Características prevalentes salvas no localStorage:', caracteristicasValidas);
}
function carregafuncoes() {
    // Atualiza os resultados de personalidade após um pequeno delay
    atualizarResultadosPersonalidade();
    buscarCaracteristicasPrevalentes();
    processarEspecialidades();
}
