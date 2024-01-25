<?php
include('../db_conf.php');

if (isset($_GET['idcadastro'])) {
    $idcadastro = $_GET['idcadastro'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para obter as informações do cadastro específico
        $consulta = $pdo->prepare("SELECT * FROM cadastro WHERE idcadastro = ?");
        $consulta->execute([$idcadastro]);
        $infoCadastro = $consulta->fetch(PDO::FETCH_ASSOC);

        // Exibe as informações do cadastro
        echo "<p>Nasc: {$infoCadastro['nascimento']} - Fone: {$infoCadastro['telefone']} - Inst: {$infoCadastro['instituicao']}</p>";

        if ($infoCadastro['formado']) {
            echo "<p>Formado: Sim - Ano de Conclusão: {$infoCadastro['periodo']} - Especialidade: {$infoCadastro['especialidade']}</p>";
        } else {
            echo "<p>Formado: Não - Período: {$infoCadastro['periodo']}</p>";
        }

    } catch (PDOException $e) {
        echo "Erro ao obter os dados: " . $e->getMessage();
    }
} else {
    echo "ID do cadastro não fornecido.";
}
?>