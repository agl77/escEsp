<?php
session_start();

// Lógica de autenticação
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $senha = $_POST["senha"];

    // Substitua pela lógica de autenticação adequada
    if ($login == "andrelauer" && $senha == "lauer1977") {
        // Define a variável de sessão para indicar que o usuário está autenticado
        $_SESSION['usuario_autenticado'] = true;
        $_SESSION['ultima_atividade'] = time();

        // Redireciona para a página protegida
        header("Location: index.php");
        exit();
    } else {
        // Exibe uma mensagem de erro
        $mensagemErro = "Login ou senha incorretos";
    }
}
?>

<!-- Formulário de login -->
<form method="post" action="">
    <label for="login">Login:</label>
    <input type="text" id="login" name="login" required>
    <br>
    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required>
    <br>
    <input type="submit" value="Login">
</form>

<?php
// Exibe mensagem de erro (se houver)
if (isset($mensagemErro)) {
    echo "<p>{$mensagemErro}</p>";
}
?>