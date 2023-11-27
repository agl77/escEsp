<?php
// Configurações de conexão com o MySQL
include ('db_conf.php');


 try {
   // Conecta ao banco de dados usando PDO
   $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   // Dados do formulário
   $nascimento = $_POST['data_nascimento'];
   $email = $_POST['email'];
   $telefone = $_POST['telefone'];
   $instituicao = $_POST['instituicao'];
   $formado = isset($_POST['formado']) ? 1 : 0;
   $periodo = $formado ? $_POST['ano_conclusao'] : $_POST['semestre'];
   $especialidade = $formado ? $_POST['especialidade'] : null;
   $aceitarTermos = isset($_POST['aceitar_termos']) ? 1 : 0;

   //Insere os dados na tabela 'cadastro'
   $sql = "INSERT INTO cadastro (nascimento, email, telefone, instituicao, formado, periodo, especialidade, aceite) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
   $stmt = $pdo->prepare($sql);
   $stmt->execute([$nascimento, $email, $telefone, $instituicao, $formado, $periodo, $especialidade, $aceitarTermos]);

    //zera o localstorage
    echo '<script>localStorage.clear();</script>';

   // ID do cadastro inserido
   $idcadastro = $pdo->lastInsertId();
   //insere no localstorage o idcadastro
   // Insere no localStorage o idcadastro como uma string JSON após o carregamento da página
   echo '<script>
   document.addEventListener("DOMContentLoaded", function() {
      localStorage.setItem("idcadastro", ' . $idcadastro . ');
      window.location.href = "esp.php";
   });
   </script>';


} catch (PDOException $e) {
   echo "Erro ao inserir os dados: " . $e->getMessage();
}

// Fecha a conexão com o banco de dados (o PDO faz isso automaticamente)
?>
