<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Dados para o PHP</title>
</head>
<body>
    <h1>Enviar Dados para o PHP</h1>
    <form action="recebedados.php" method="post">
        <input type="text" name="pergunta001" value="A">
        <input type="text" name="pergunta002" value="B">
        <!-- Adicione mais campos conforme necessário -->
        <button type="submit">Enviar</button>
    </form>
</body>
</html>