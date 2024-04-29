<?php
// Configurações de conexão com o MySQL
include ('db_conf.php');
print_r($_POST);

try {
    // Verifica se os dados foram recebidos corretamente
    $json_data = file_get_contents('php://input');
    if(empty($json_data)) {
        throw new Exception("Nenhum dado recebido.");
    }

    // Decodifica os dados JSON
    $data = json_decode($json_data, true);
    if($data === null) {
        throw new Exception("Erro ao decodificar os dados JSON.");
    }

    // Dados do formulário
    $liked = implode(', ', $data['liked']); // Converta o array em uma string
    $disliked = implode(', ', $data['disliked']); // Converta o array em uma string
    $idcadastro = $data['idcadastro'];

    // Conecta ao banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para verificar se já existe uma linha com o mesmo idcadastro
    $checkQuery = "SELECT idespvalor FROM esp_valor WHERE idcadastro = ?";
    $checkStatement = $pdo->prepare($checkQuery);
    $checkStatement->execute([$idcadastro]);
    $existingRow = $checkStatement->fetch(PDO::FETCH_ASSOC);

    if ($existingRow) {
        // Já existe uma linha, então atualiza os valores
        $updateQuery = "UPDATE esp_valor SET liked = ?, disliked = ? WHERE idcadastro = ?";
        $updateStatement = $pdo->prepare($updateQuery);
        $updateStatement->execute([$liked, $disliked, $idcadastro]);
    } else {
        // Não existe uma linha, então insere os valores
        $insertQuery = "INSERT INTO esp_valor (idcadastro, liked, disliked) VALUES (?, ?, ?)";
        $insertStatement = $pdo->prepare($insertQuery);
        $insertStatement->execute([$idcadastro, $liked, $disliked]);
    }

    // Redireciona para a próxima página
    header("Location: agradecimento.html");
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>
