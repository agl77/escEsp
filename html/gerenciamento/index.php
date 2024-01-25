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
                echo "<option value='{$cadastro['idcadastro']}'>{$cadastro['email']}</option>";
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

    try {
        // Consulta para obter informações da página atual usando o idcadastro
        $consultaPagina = $pdo->prepare("SELECT * FROM $paginaAtual WHERE idcadastro = ?");
        $consultaPagina->execute([$idcadastro]);
        $infoPagina = $consultaPagina->fetchAll(PDO::FETCH_ASSOC);

        // Exibe as informações da página atual
        foreach ($infoPagina as $info) {
            // Exiba os dados da página conforme necessário
            echo "<p>{$info['campo1']}</p>";
            echo "<p>{$info['campo2']}</p>";
            // ...
        }

    } catch (PDOException $e) {
        echo "Erro ao obter os dados da página: " . $e->getMessage();
    }
}
?>

</body>
</html>
