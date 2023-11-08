<?php
// Configurações de conexão com o MySQL
// $host = 'mysql';
// $usuario = 'base';
// $senha = 'abc';
// $banco = 'base';
// header("Location: esp.php");

// try {
//    // Conecta ao banco de dados usando PDO
//    $pdo = new PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);
//   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     Dados do formulário
//    $nome = $_POST['nome'];
//    $nascimento = $_POST['data_nascimento'];
//    $instituicao = $_POST['instituicao'];
//    $formado = isset($_POST['formado']) ? 1 : 0;
//    $periodo = $formado ? $_POST['ano_conclusao'] : $_POST['semestre'];
//    $especialidade = $formado ? $_POST['especialidade'] : null;

//     Insere os dados na tabela 'cadastro'
//    $sql = "INSERT INTO cadastro (nome, nascimento, formado, instituicao, periodo, especialidade) VALUES (?, ?, ?, ?, ?, ?)";
//    $stmt = $pdo->prepare($sql);
//    $stmt->execute([$nome, $nascimento, $formado, $instituicao, $periodo, $especialidade]);

//     ID do cadastro inserido
//    $idcadastro = $pdo->lastInsertId();
//    //insere no localstorage o idcadastro
//    echo '<script>localStorage.setItem("idcadastro", ' . $idcadastro . ')</script>';
//    //zera o localstorage
//    echo '<script>localStorage.clear();</script>';

//    //Redireciona para a próxima página com o ID do cadastro
    header("Location: esp.php");
 

// } catch (PDOException $e) {
//    echo "Erro ao inserir os dados: " . $e->getMessage();
// }

// Fecha a conexão com o banco de dados (o PDO faz isso automaticamente)
?>
