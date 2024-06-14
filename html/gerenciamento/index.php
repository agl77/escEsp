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
            body {
            margin-left: 45px; /* Adição de margem esquerda */
        }

        table {
            border-collapse: collapse;
            width: 500px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 2px;
            word-break: break-all; /* Quebra de linhas em células */
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #resultados-personalidade,
        #resultados-especialidades {
            margin-top: 20px;
            margin-bottom: 20px; /* Espaçamento entre seções */
        }
</style>
</head>
<body>
    <script src="js/processa_caracteristicas.js" ></script>
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
    echo "<label for='cadastro'>Cadastro:</label>";
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
<section id="resultados-personalidade">
    <h6><br> Resultados da personalidade</h6>
    <table width="1200">
        <tr>
            <th>R1</th>
            <th>R2</th>
            <th>R3</th>
        </tr>
        <tr>
            <td id="R1"><br></td>
            <td id="R2"><br></td>
            <td id="R3"><br></td>
        </tr>
    </table>
    <h6>Personalidade</h6>
    <table>
        <tr>
            <th id="personalidade"><br></th>
        </tr>
    </table>
    </table>
    <h6>Especialidades compatíveis</h6>
    <table id="tabela-especialidades">
        <thead>
            <tr>
                <th>Especialidade</th>
                <th>Pontuação</th>
            </tr>
        </thead>
        <tbody>
            <!-- As linhas da tabela serão inseridas aqui pelo JavaScript -->
        </tbody>
    </table>



</section>

</body>
</html>


<section id="resultados-especialidades">
    <h6><br>Respostas sobre especialidades e escolha de valores</h6>
    <table width="1200">
        <tr>
            <th>Itens</th>
            <th>Escolhas</th>
        </tr>
        <tr>
            <td>Mais se identifica</td>
            <td id="mais-se-identifica"></td>
        </tr>
        <tr>
            <td>Menos se identifica</td>
            <td id="menos-se-identifica"></td>
        </tr>
        <tr>
            <td>Valores Selecionados</td>
            <td id="valores-selecionados"></td>
        </tr>
      
    </table>
</section>

</body>
</html>
