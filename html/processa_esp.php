<?php
// Configurações de conexão com o MySQL
include ('db_conf.php');
print_r($_POST);

try {
    // Conecta ao banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Dados do formulário
    $idcadastro = $_POST['idcadastro']; // Certifique-se de validar/sanitizar isso conforme necessário
    //$selectedValues = $_POST['values'];

    // Converte os arrays para strings sem quebras de linha e espaços adicionais
    $liked = str_replace(["\n", "\r", "  "], "", implode(', ', json_decode($_POST['liked'])));
    $disliked = str_replace(["\n", "\r", "  "], "", implode(', ', json_decode($_POST['disliked'])));

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
