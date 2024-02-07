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

// Função para exibir o cabeçalho do cadastro
function exibirCabecalhoCadastro($infoCadastro) {
    // Formata a data para o formato brasileiro
    $dataFormatada = date('d/m/Y', strtotime($infoCadastro['Nascimento']));

    // Exibe o cabeçalho em uma linha
    

    echo "<p><strong>Nascimento.:</strong> {$dataFormatada} | <strong>Fone:</strong> {$infoCadastro['telefone']} | <strong>Inst:</strong> {$infoCadastro['instituicao']}";

    if ($infoCadastro['formado']) {
        echo " | <strong>Formado:</strong> Sim | <strong>Conclusão:</strong> {$infoCadastro['periodo']} | <strong>Especialidade:</strong> {$infoCadastro['especialidade']}</p>";
    } else {
        echo " | <strong>Formado:</strong> Não | <strong>Período:</strong> {$infoCadastro['periodo']}</p>";
    }
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

    // Páginas navegáveis
    $paginas = array('pagina1', 'pagina2', 'pagina3', 'pagina4');
    // Exibe o link das páginas no cabeçalho
            echo "<div>";
            foreach ($paginas as $pagina) {
            $idcadastro = isset($_GET['idcadastro']) ? $_GET['idcadastro'] : ''; // Verifica se idcadastro está definido
            echo "<a href='?pagina=$pagina&idcadastro=$idcadastro'>$pagina</a> "; // Usando $idcadastro
        }
        echo "</div>";

    // Verifica se uma página específica foi solicitada
    if (isset($_GET['pagina']) && in_array($_GET['pagina'], $paginas)) {
        $paginaAtual = $_GET['pagina'];

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

        // Inclui o conteúdo da página selecionada
        include($paginaAtual . '.php');
    } else {
        // Exibe a primeira página por padrão
        if ($cadastroSelecionado) {
            // Consulta para obter informações do cadastro selecionado
            $consultaCadastro = $pdo->prepare("SELECT * FROM cadastro WHERE idcadastro = ?");
            $consultaCadastro->execute([$cadastroSelecionado]);
            $infoCadastroSelecionado = $consultaCadastro->fetch(PDO::FETCH_ASSOC);

            // Exibe o cabeçalho do cadastro
            exibirCabecalhoCadastro($infoCadastroSelecionado);
        }

        include($paginas[0] . '.php');
    }

    // Exibe os links para as páginas
    echo "<div>";
    foreach ($paginas as $pagina) {
        echo "<a href='?pagina=$pagina&idcadastro={$_GET['idcadastro']}'>$pagina</a> ";
    }
    echo "</div>";

} catch (PDOException $e) {
    echo "Erro ao obter os dados: " . $e->getMessage();
}
?>
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
                localStorage.setItem('dadosCadastro' , this.responseText);
            }
        };
        // Define a URL da sua API ou script PHP que retorna os dados da consulta
        xhttp.open("GET", "get_dados_perguntas.php?idcadastro=" + idCadastro, true);
        xhttp.send();
    }

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
</script>

</body>
</html>
