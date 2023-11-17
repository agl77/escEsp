<?php
include('db_conf.php');

try {
    // Dados do formulário
    $idcadastro = $_POST['idcadastro'];
  
    // Convertendo as respostas de JSON para um array associativo
    $answrange = json_decode($_POST['answrange'], true);

    $valores = array();
    foreach ($answrange as $array) {
        $valores = array_merge($valores, array_values($array));
    }

    // Obtendo os nomes dos campos (chaves)
    $indices = array();
    foreach ($answrange as $array) {
        $indices = array_merge($indices, array_keys($array));
    }
    // Obtém os índices da primeira entrada (assumindo que há pelo menos uma entrada)
    //$indices = array_keys($answrange[*]);
    
    
    // Conectar ao banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Construindo a parte do SQL para as perguntas
    $sql = "INSERT INTO slide (idcadastro, " . implode(", ", $indices) . ")";
    $valuesSql = "VALUES (?, " . rtrim(str_repeat("?, ", count($indices)), ', ') . ")";
    
    // Montando a consulta SQL completa
    $fullSql = "$sql $valuesSql";

    // Preparando e executando a consulta
    $stmt = $pdo->prepare($fullSql);
     
    // Exibindo os valores
    //print_r($valores);



    // Montando o array de valores a serem vinculados
    $bindValues = array_merge([$idcadastro], array_values($valores));
    
    //echo "answrange " . print_r($answrange, true);
    //echo "<br> sql " . $sql;
    //echo "<br> values " . $valuesSql;
    //echo "<br> fullsql" . $fullSql;
    //echo "<br> bind " . print_r($bindValues, true);
    //echo "<br><br> " . print_R($indices, true);
    

    // Executando a consulta com os valores vinculados
    $stmt->execute($bindValues);

    header("Location: agradecimento.html");
} catch (PDOException $e) {
    echo "Erro ao inserir os dados: " . $e->getMessage();
}
?>
