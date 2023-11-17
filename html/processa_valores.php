<?php
// Configurações de conexão com o MySQL
include ('db_conf.php');

try {
   // Conecta ao banco de dados usando PDO
   $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   // Dados do formulário
   $idcadastro = $_POST['idcadastro']; // Certifique-se de validar/sanitizar isso conforme necessário
   $selectedValues = $_POST['values'];
   
   // Converte os arrays para strings sem quebras de linha e espaços adicionais
   $liked = str_replace(["\n", "\r", "  "], "", implode(', ', json_decode($_POST['liked'])));
   $disliked = str_replace(["\n", "\r", "  "], "", implode(', ', json_decode($_POST['disliked'])));

   //Insere os dados na tabela 'cadastro'
   $sql = "INSERT INTO esp_valor (idcadastro, liked, disliked, selectedValues) VALUES (?, ?, ?, ?)";
   $stmt = $pdo->prepare($sql);
   $stmt->execute([$idcadastro, $liked, $disliked, implode(', ', $selectedValues)]);

   //Redireciona para a próxima página
   header("Location: perguntas.html");

} catch (PDOException $e) {
   echo "Erro ao inserir os dados: " . $e->getMessage();
}
?>
