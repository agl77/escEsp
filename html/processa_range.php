<?php
include('db_conf.php');

try {
    // Conectar ao banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
    
    // Consulta para verificar se já existe uma linha com o mesmo idcadastro
    $checkQuery = "SELECT idcadastro FROM slide WHERE idcadastro = ?";
    $checkStatement = $pdo->prepare($checkQuery);
    $checkStatement->execute([$idcadastro]);
    $existingRow = $checkStatement->fetch(PDO::FETCH_ASSOC);
    
    if ($existingRow) {
        // Se já existe a linha, ele faz o update do valor
        $updateQuery = "UPDATE slide SET ";
        $updateQuery .= implode(" = ?, ", $indices) . " = ?";  // Adiciona placeholders para cada coluna
        $updateQuery .= " WHERE idcadastro = ?";
        
        $stmt = $pdo->prepare($updateQuery);
        
        // Montando o array de valores a serem vinculados
        $bindValues = array_merge(array_values($valores), [$idcadastro]);

        // Executando a consulta com os valores vinculados
        $stmt->execute($bindValues);
        
    } else {
        // Construindo a parte do SQL para as perguntas
        $sql = "INSERT INTO slide (idcadastro, " . implode(", ", $indices) . ")";
        $valuesSql = "VALUES (?, " . rtrim(str_repeat("?, ", count($indices)), ', ') . ")";
        
        // Montando a consulta SQL completa
        $fullSql = "$sql $valuesSql";

        // Preparando e executando a consulta
        $stmt = $pdo->prepare($fullSql);
        
        // Montando o array de valores a serem vinculados
        $bindValues = array_merge([$idcadastro], array_values($valores));
        // Executando a consulta com os valores vinculados
        $stmt->execute($bindValues);
    }

    header("Location: agradecimento.html");
} catch (PDOException $e) {
    echo "Erro ao inserir os dados: " . $e->getMessage();
}
?>
