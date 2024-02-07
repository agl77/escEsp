<?php
include('../db_conf.php');

if (isset($_GET['idcadastro'])) {
    $idcadastro = $_GET['idcadastro'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para obter as informações do cadastro específico
        $consulta = $pdo->prepare("SELECT pergunta001, pergunta002, pergunta003, pergunta004, pergunta005, pergunta006, pergunta007, pergunta008, pergunta009, pergunta010, pergunta011, pergunta012, pergunta013, pergunta014, pergunta015, pergunta016, pergunta017, pergunta018, pergunta019, pergunta020, pergunta021, pergunta022, pergunta023, pergunta024, pergunta025, pergunta026, pergunta027, pergunta028, pergunta029, pergunta030, pergunta031, pergunta032, pergunta033, pergunta034, pergunta035, pergunta036, pergunta037, pergunta038, pergunta039, pergunta040, pergunta041, pergunta042, pergunta043, pergunta044, pergunta045, pergunta046, pergunta047, pergunta048, pergunta049, pergunta050, pergunta051, pergunta052, pergunta053, pergunta054, pergunta055, pergunta056, pergunta057, pergunta058, pergunta059, pergunta060, pergunta061, pergunta062, pergunta063, pergunta064, pergunta065, pergunta066, pergunta067, pergunta068, pergunta069, pergunta070, pergunta071, pergunta072, pergunta073, pergunta074, pergunta075, pergunta076, pergunta077, pergunta078, pergunta079, pergunta080, pergunta081, pergunta082, pergunta083, pergunta084, pergunta085, pergunta086, pergunta087, pergunta088, pergunta089, pergunta090, pergunta091, pergunta092, pergunta093, pergunta094, pergunta095, pergunta096, pergunta097, pergunta098, pergunta099, pergunta100, pergunta101, pergunta102, pergunta103, pergunta104, pergunta105, pergunta106, pergunta107, pergunta108, pergunta109, pergunta110, pergunta111
        FROM question WHERE idcadastro = ?");
        $consulta->execute([$idcadastro]);
        $infoCadastro = $consulta->fetch(PDO::FETCH_ASSOC);

        // Devolver os dados em formato JSON
        header('Content-Type: application/json');
        echo json_encode($infoCadastro);

    } catch (PDOException $e) {
        echo "Erro ao obter os dados: " . $e->getMessage();
    }
} else { 
    echo "ID do cadastro não fornecido.";
}
?>