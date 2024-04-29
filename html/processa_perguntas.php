<?php
include('db_conf.php');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Dados do formulário
    $idcadastro = $_POST['idcadastro'];

    // Convertendo as respostas de JSON para um array associativo
    $answers = json_decode($_POST['answers'], true);

    // Consulta para verificar se já existe uma linha com o mesmo idcadastro
    $checkQuery = "SELECT idcadastro FROM question WHERE idcadastro = ?";
    $checkStatement = $pdo->prepare($checkQuery);
    $checkStatement->execute([$idcadastro]);
    $existingRow = $checkStatement->fetch(PDO::FETCH_ASSOC);

    if ($existingRow) {
        // Já existe uma linha, então atualiza os valores
        $updateSql = "UPDATE question SET ";
        $updateValues = [];
        foreach ($answers as $question => $answer) {
            $updateSql .= "$question = ?, ";
            $updateValues[] = $answer;
        }
        // Removendo a vírgula extra no final da string SQL
        $updateSql = rtrim($updateSql, ", ");
        $updateSql .= " WHERE idcadastro = ?";

        // Adiciona o idcadastro para o array de valores da atualização
        $updateValues[] = $idcadastro;

        // Preparando e executando a consulta de atualização
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute($updateValues);
    } else {
        // Não existe uma linha, então insere os valores
        $insertSql = "INSERT INTO question (idcadastro, ";
        $values = "VALUES (?, ";
        foreach ($answers as $question => $answer) {
            $insertSql .= "$question, ";
            $values .= "?, ";
        }
        // Removendo a vírgula extra no final das strings SQL
        $insertSql = rtrim($insertSql, ", ") . ")";
        $values = rtrim($values, ", ") . ")";

        // Montando a consulta SQL completa
        $fullInsertSql = "$insertSql $values";

        // Preparando e executando a consulta de inserção
        $insertValues = array_merge([$idcadastro], array_values($answers));
        $insertStmt = $pdo->prepare($fullInsertSql);
        $insertStmt->execute($insertValues);
    }

    header("Location: valores.html");
} catch (PDOException $e) {
    echo "Erro ao inserir/atualizar os dados: " . $e->getMessage();
}
?>
