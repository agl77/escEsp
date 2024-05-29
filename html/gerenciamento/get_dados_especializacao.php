<?php
// Busca os dados das perguntas para inserir no localstorage pelo js
include('../db_conf.php');

if (isset($_GET['idcadastro'])) {
    $idcadastro = $_GET['idcadastro'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para obter as informações do cadastro específico
        $consulta = $pdo->prepare("SELECT liked, disliked, selectedValues FROM esp_valor WHERE idcadastro = ?");
        $consulta->execute([$idcadastro]);
        $infoCadastro = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($infoCadastro) {
            // Devolver os dados em formato JSON
            header('Content-Type: application/json');
            echo json_encode($infoCadastro);
        } else {
            echo "Nenhum dado encontrado para o ID de cadastro fornecido.";
        }

    } catch (PDOException $e) {
        echo "Erro ao obter os dados: " . $e->getMessage();
    }
} else { 
    echo "ID do cadastro não fornecido.";
}
?>
