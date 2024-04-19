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
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Questionário Vocacional de Especialidade Médica</title>
    <!-- Inclua os links para os arquivos CSS e JavaScript do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body>
    <div class="container">
      <h1>Questionário Vocacional de Especialidade Médica</h1>
      <p><b>Leia atentamente cada uma das situações propostas e tente, por alguns minutos, visualizar-se nelas. Responda quais seriam suas reais preferências em cada uma das situações propostas.</b></p>
    </div>