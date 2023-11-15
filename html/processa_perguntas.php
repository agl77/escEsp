<?php
include('db_conf.php');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Dados do formulário
    $idcadastro = $_POST['idcadastro'];

    // Convertendo as respostas de JSON para um array associativo
    $answers = json_decode($_POST['answers'], true);

    // Construindo a parte do SQL para as perguntas
    $sql = "INSERT INTO question (idcadastro, ";
    $values = "VALUES (?, ";
    
    foreach ($answers as $question => $answer) {
        $sql .= "$question, ";
        $values .= "?, ";
    }

    // Removendo a vírgula extra no final das strings SQL
    $sql = rtrim($sql, ", ") . ")";
    $values = rtrim($values, ", ") . ")";

    // Montando a consulta SQL completa
    $fullSql = "$sql $values";

    // Preparando e executando a consulta
    $stmt = $pdo->prepare($fullSql);

    // Montando o array de valores a serem vinculados
    $bindValues = array_merge([$idcadastro], array_values($answers));

    //echo "answers " . $answer;
    //echo "<br> sql " . $sql;
    //echo "<br> values " . $values;
    //echo "<br> fullsql" . $fullSql;
    //echo "<br> bind " . $bindValues;

    // Executando a consulta com os valores vinculados
    $stmt->execute($bindValues);

    header("Location: range.html");
} catch (PDOException $e) {
  echo "Erro ao inserir os dados: " . $e->getMessage();
}
?>