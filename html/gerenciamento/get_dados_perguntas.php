<?php
// Busca os dados das perguntas para inserir no localstorage pelo
include('../db_conf.php');

if (isset($_GET['idcadastro'])) {
    $idcadastro = $_GET['idcadastro'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Lista de perguntas que deseja selecionar
        $perguntas = array();
        for ($i = 1; $i <= 111; $i++) {
            $pergunta = "pergunta" . str_pad($i, 3, '0', STR_PAD_LEFT);
            $perguntas[] = $pergunta;
        }
        $perguntas_sql = implode(', ', $perguntas);

        // Consulta para obter as informações do cadastro específico
        $consulta = $pdo->prepare("SELECT $perguntas_sql FROM question WHERE idcadastro = ?");
        $consulta->execute([$idcadastro]);
        $infoCadastro = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($infoCadastro) {
            // Devolver os dados em formato JSON
            header('Content-Type: application/json');
            echo json_encode($infoCadastro);
        } else {
            $respostavasia = ('pergunta001');
            echo json_encode($respostavasia);
        }

    } catch (PDOException $e) {
        echo "Erro ao obter os dados: " . $e->getMessage();
    }
} else { 
    echo "ID do cadastro não fornecido.";
}
?>
