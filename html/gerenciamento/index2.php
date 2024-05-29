<?php
session_start();

if (!isset($_SESSION['usuario_autenticado'])) {
    header("Location: login.php");
    exit();
}

$tempoAtual = time();
$tempoExpiracao = 1800; // 30 minutos em segundos

if (isset($_SESSION['ultima_atividade']) && ($tempoAtual - $_SESSION['ultima_atividade'] > $tempoExpiracao)) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

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
    <style>
    table {
        border-collapse: collapse;
        width: 500px;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 2px;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>
</head>
<body>
    <script src="js/busca_dados.js" ></script>
<?php
include('../db_conf.php');

function exibirCabecalhoCadastro($infoCadastro) {
    $dataFormatada = date('d/m/Y', strtotime($infoCadastro['Nascimento']));
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

    $consulta = $pdo->query("SELECT idcadastro, email FROM cadastro");
    $cadastros = $consulta->fetchAll(PDO::FETCH_ASSOC);

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

    if (isset($_GET['idcadastro'])) {
        $cadastroSelecionado = $_GET['idcadastro'];
        $consultaCadastro = $pdo->prepare("SELECT * FROM cadastro WHERE idcadastro = ?");
        $consultaCadastro->execute([$cadastroSelecionado]);
        $infoCadastroSelecionado = $consultaCadastro->fetch(PDO::FETCH_ASSOC);
        exibirCabecalhoCadastro($infoCadastroSelecionado);
    }

} catch (PDOException $e) {
    echo "Erro ao obter os dados: " . $e->getMessage();
}
?>
<div id="pageContent">
    <!-- O conteúdo da página será carregado aqui -->
    <ul id="dadosRecebidos"></ul>

</div>



</body>
</html>
