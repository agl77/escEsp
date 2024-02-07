<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<?php
// Função para exibir o cabeçalho do cadastro
function exibirCabecalhoCadastro($infoCadastro) {
    echo "<p>Nasc: {$infoCadastro['nascimento']} - Fone: {$infoCadastro['telefone']} - Inst: {$infoCadastro['instituicao']}</p>";

    if ($infoCadastro['formado']) {
        echo "<p>Formado: Sim - Conclusão: {$infoCadastro['periodo']} - Especialidade: {$infoCadastro['especialidade']}</p>";
    } else {
        echo "<p>Formado: Não - Período: {$infoCadastro['periodo']}</p>";
    }
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica o login e senha (substitua isso pela lógica de autenticação adequada)
    $login = $_POST["login"];
    $senha = $_POST["senha"];

    // Substitua esta condição pela lógica de autenticação adequada
    if ($login == "usuario" && $senha == "senha") {
        // Se autenticação bem-sucedida, exiba o dropdown com os cadastros
        include('../db_conf.php');

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
                $value = $cadastro['idcadastro'] . '-' . $cadastro['email'];
                echo "<option value='{$value}'>{$value}</option>";
            }
            echo "</select>";
            echo "</form>";
            echo "<div id='infoCadastro'></div>";

        } catch (PDOException $e) {
            echo "Erro ao obter os dados: " . $e->getMessage();
        }
    } else {
        // Se a autenticação falhar, exiba uma mensagem de erro
        echo "<p>Login ou senha incorretos</p>";
    }
} else {
    // Se o formulário não foi enviado, exiba o formulário de login
    echo '
    <form method="post" action="">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <input type="submit" value="Login">
    </form>';
}

if (!isset($_GET['pagina'])) {
    echo "<div>";
    foreach ($paginas as $pagina) {
        echo "<a href='?pagina=$pagina&idcadastro=$idcadastro'>$pagina</a> ";
    }
    echo "</div>";
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

<?php
// Páginas navegáveis
$paginas = array('pagina1', 'pagina2', 'pagina3', 'pagina4');

// Verifica se uma página específica foi solicitada
if (isset($_GET['pagina']) && in_array($_GET['pagina'], $paginas)) {
    $paginaAtual = $_GET['pagina'];

    // Obtém o ID do cadastro selecionado (se existir)
    $cadastroSelecionado = isset($_GET['idcadastro']) ? $_GET['idcadastro'] : null;

    // Inclui o conteúdo da página selecionada
    include($paginaAtual . '.php');
} else {
    // Se não há uma página específica, exibe o dropdown padrão e a primeira página
    echo "<form method='post' action='' id='formCadastro'>";
    echo "<label for='cadastro'>Selecione um cadastro:</label>";
    echo "<select id='cadastro' name='cadastro' onchange='carregarInfoCadastro(this.value)'>";
    foreach ($cadastros as $cadastro) {
        $value = $cadastro['idcadastro'] . '-' . $cadastro['email'];
        $selected = ($cadastroSelecionado == $cadastro['idcadastro']) ? 'selected' : '';
        echo "<option value='{$value}' {$selected}>{$value}</option>";
    }
    echo "</select>";
    echo "</form>";
    echo "<div id='infoCadastro'></div>";

    // Exibe o cabeçalho do cadastro se um cadastro estiver selecionado
    if ($cadastroSelecionado) {
        // Consulta para obter informações do cadastro selecionado
        $consultaCadastro = $pdo->prepare("SELECT * FROM cadastro WHERE idcadastro = ?");
        $consultaCadastro->execute([$cadastroSelecionado]);
        $infoCadastroSelecionado = $consultaCadastro->fetch(PDO::FETCH_ASSOC);

        // Exibe o cabeçalho do cadastro
        exibirCabecalhoCadastro($infoCadastroSelecionado);
    }

    // Exibe a primeira página por padrão
    include($paginas[0] . '.php');
}
?>
<?php
    echo "<div>";
    foreach ($paginas as $pagina) {
        echo "<a href='?pagina=$pagina&idcadastro=$idcadastro'>$pagina</a> ";
    }
    echo "</div>";
    ?>
</body>
</html>
