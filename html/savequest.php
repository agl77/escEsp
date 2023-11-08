<?php
// Receber os dados enviados do JavaScript
$data = json_decode($_POST['data'], true);
header("Location: range.html");


        // try {
        //     // Conectar ao banco de dados usando PDO
        //     $dsn = "mysql:host=seu_servidor;dbname=seu_banco_de_dados";
        //     $username = "seu_usuario";
        //     $password = "sua_senha";

        //     $pdo = new PDO($dsn, $username, $password);
        //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //     // Iterar pelas respostas e inseri-las no banco de dados
        //     foreach ($data as $questionId => $answer) {
        //         $sql = "INSERT INTO respostas (pergunta_id, resposta) VALUES (:pergunta_id, :resposta)";
        //         $stmt = $pdo->prepare($sql);
        //         $stmt->bindParam(':pergunta_id', $questionId);
        //         $stmt->bindParam(':resposta', $answer);
        //         $stmt->execute();
        //     }

        //     // Fechar a conexão com o banco de dados
        //     $pdo = null;

        //     // Resposta ao cliente (opcional)
        //     echo "Respostas salvas com sucesso no banco de dados!";
        // } catch (PDOException $e) {
        //     die("Erro ao conectar ao banco de dados: " . $e->getMessage());
        // }
?>
