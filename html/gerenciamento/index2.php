<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario_autenticado'])) {
    // Redireciona para a página de login se não estiver autenticado
    header("Location: login.php");
    exit();
}

// Verifica a validade da sessão (30 minutos)
$tempoAtual = time();
$tempoExpiracao = 1800; // 30 minutos em segundos
if (isset($_SESSION['ultima_atividade']) && ($tempoAtual - $_SESSION['ultima_atividade'] > $tempoExpiracao)) {
    // Se a sessão expirou, faz logout e redireciona para o login
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// Atualiza o tempo da última atividade
$_SESSION['ultima_atividade'] = $tempoAtual;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apresentação das respostas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<?php
include('../db_conf.php');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $cadastroSelecionado = null;
    if (!isset($_GET['idcadastro']) && !empty($cadastros)) {
        $cadastroSelecionado = $cadastros[0]['idcadastro'];
    }
    // Consulta para obter os cadastros
    $consulta = $pdo->query("SELECT idcadastro, email, nascimento, telefone, instituicao, formado, periodo, especialidade, aceite FROM cadastro");
    $cadastros = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // Exibe o dropdown com os cadastros
    echo "<form method='post' action='' id='formCadastro'>";
    echo "<label for='cadastro'>Selecione um cadastro:</label>";
    echo "<select id='cadastro' name='cadastro' onchange='carregarInfoCadastro(this.value)'>";
    foreach ($cadastros as $cadastro) {
        $value = $cadastro['idcadastro'] . ' - ' . $cadastro['email'];
        $selected = (isset($_GET['idcadastro']) && $_GET['idcadastro'] == $cadastro['idcadastro']) ? 'selected' : '';
        echo "<option value='{$value}' {$selected}>{$value}</option>";
    }
    echo "</select>";
    echo "</form>";
    echo "<div id='infoCadastro'></div>";

        // Obtém o ID do cadastro selecionado (se existir)
        $cadastroSelecionado = null;
        if (isset($_GET['idcadastro'])) {
        // Sanitize o valor recebido
        $cadastroSelecionado = filter_var($_GET['idcadastro'], FILTER_SANITIZE_NUMBER_INT);
        }

        // Exibe o cabeçalho do cadastro selecionado
        if ($cadastroSelecionado) {
            // Consulta para obter informações do cadastro selecionado
            $consultaCadastro = $pdo->prepare("SELECT * FROM cadastro WHERE idcadastro = ?");
            $consultaCadastro->execute([$cadastroSelecionado]);
            $infoCadastroSelecionado = $consultaCadastro->fetch(PDO::FETCH_ASSOC);
        }
     
} catch (PDOException $e) {
    echo "Erro ao obter os dados: " . $e->getMessage();
}
?>
<select id="selectPagina">
    <option value="pagina1.php">Página 1</option>
    <option value="pagina2.php">Página 2</option>
    <option value="respostas_questionario.php">Página 3</option>
    <option value="pagina4.php">Página 4</option>
</select>
<div id="pageContent">
      <!-- O conteúdo da página será carregado aqui -->
</div>
<script>
function carregarInfoCadastro(idcadastro) {
    // Realiza uma solicitação AJAX para obter informações adicionais do cadastro
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("infoCadastro").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "get_info_cadastro.php?idcadastro=" + idcadastro, true);
    xhttp.send();
}
</script>
<!-- Adicione este script logo após o bloco PHP que exibe o dropdown de cadastros -->
<script>
    // Função para fazer a solicitação AJAX
    function buscarDadosDoServidor(idCadastro) {
        // Realiza uma solicitação AJAX para obter os dados do servidor
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Quando a resposta é recebida, armazena os dados no localStorage
                localStorage.setItem('respostasQuestionario' , this.responseText);
            }
        };
        // Define a URL da sua API ou script PHP que retorna os dados da consulta
        xhttp.open("GET", "get_dados_perguntas.php?idcadastro=" + idCadastro, true);
        xhttp.send();
    }
        // Lê os dados do RespostaQuestionario e contabiliza quantas respostas de cada
        var dadosLocalStorage = localStorage.getItem('respostasQuestionario');

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




    // Chama a função para buscar os dados do servidor quando o documento estiver pronto
    document.addEventListener("DOMContentLoaded", function() {
        // Obtém o elemento select do dropdown
        var selectCadastro = document.getElementById('cadastro');
        
        // Define um evento onchange para o dropdown
        selectCadastro.addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var idCadastro = selectedOption.value.split(' - ')[0]; // Obter o idcadastro corretamente
        buscarDadosDoServidor(idCadastro); // Chama a função para buscar os dados do servidor
        });
    });
    // Função para carregar o conteúdo da página selecionada via AJAX
    function carregarPagina(pagina) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("pageContent").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", pagina , true);
        xhttp.send();
    }

    // Função para carregar as informações do cadastro
    function carregarInfoCadastro(idcadastro) {
        // Realiza uma solicitação AJAX para obter informações adicionais do cadastro
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //exibe as info no div
                document.getElementById("infoCadastro").innerHTML = this.responseText;
                // Salva as informações do cadastro no localStorage
                localStorage.setItem('infoCadastro', this.responseText);
            }
        };
        xhttp.open("GET", "get_info_cadastro.php?idcadastro=" + idcadastro, true);
        xhttp.send();
    }

    // Função para carregar a página selecionada e as informações do cadastro
    function carregarPaginaSelecionada() {
        var selectPagina = document.getElementById('selectPagina');
        var selectedOption = selectPagina.value;
        carregarPagina(selectedOption);

        // Obtém o ID do cadastro selecionado no dropdown
        var idcadastro = document.getElementById('cadastro').value.split(' - ')[0];
        carregarInfoCadastro(idcadastro);
    }

    // Chama a função para carregar a página selecionada quando o documento estiver pronto
    document.addEventListener("DOMContentLoaded", function() {
        carregarPaginaSelecionada();
    });

    // Define um evento onchange para o select de páginas
    var selectPagina = document.getElementById('selectPagina');
    selectPagina.addEventListener('change', carregarPaginaSelecionada);

    // Define um evento onchange para o dropdown de cadastros
    var selectCadastro = document.getElementById('cadastro');
    selectCadastro.addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var idCadastro = selectedOption.value.split(' - ')[0];
        carregarInfoCadastro(idCadastro);
    });
</script>

</body>
</html>