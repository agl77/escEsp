<?php

// Conexão com o banco de dados
#$conn = new mysqli("localhost", "root", "", "teste");

// Lista de opções
$opcoes = array(
    "Acupuntura",
    "Cirurgia Vascular",
    "Mastologia",
    "Nutrologia",
    "Alergia e Imunologia",
    "Clínica Médica",
    "Medicina de Emergência",
    "Oncologia Clínica",
    "Anestesiologia",
    "Coloproctologia",
    "Medicina da Família e Comunidade",
    "Ortopedia",
    "Angiologia",
    "Dermatologia",
    "Medicina do Trabalho",
    "Otorrinolaringologia",
    "Cardiologia",
    "Endocrinologia",
    "Medicina do Tráfego",
    "Patologia",
    "Cirurgia Cardíaca",
    "Endoscopia",
    "Medicina Esportiva",
    "Patologia Clínica",
    "Cirurgia da Mão",
    "Gastroenterologia",
    "Fisiatria e Reabilitação",
    "Pediatria",
    "Cirurgia de Cabeça e Pescoço",
    "Genética",
    "Medicina Intensiva",
    "Pneumologia",
    "Cirurgia do Aparelho Digestivo",
    "Geriatria",
    "Medicina Legal e Perícia",
    "Psiquiatria",
    "Cirurgia Geral",
    "Ginecologia e Obstetrícia",
    "Medicina Nuclear",
    "Radiologia e Imagem",
    "Cirurgia Oncológica",
    "Hematologia",
    "Medicina Preventiva",
    "Radioterapia",
    "Cirurgia Pediátrica",
    "Homeopatia",
    "Nefrologia",
    "Reumatologia",
    "Cirurgia Plástica",
    "Infectologia",
    "Neurologia",
    "Urologia",
    "Cirurgia Torácica",
    "Oftalmologia",
    "Neurocirurgia"
);

// Formulário
echo '<form action="index.php" method="post">';

// Lista de opções
echo '<ul>';
foreach ($opcoes as $opcao) {
    echo '<li><input type="checkbox" name="opcoes[]" value="' . $opcao . '"> ' . $opcao . '</li>';
}
echo '</ul>';

// Botões de submit
echo '<input type="submit" name="submit" value="Enviar">';
echo '</form>';

// Armazenamento das respostas no banco de dados
if (isset($_POST['submit'])) {

    // Obtenção das respostas
    $opcoes_agrada = $_POST['opcoes'];
    $opcoes_desagrada = $_POST['opcoes_desagrada'];

    // Inserção das respostas no banco de dados
    $sql = "INSERT INTO respostas (opcoes_agrada, opcoes_desagrada) VALUES ('" . implode(",", $opcoes_agrada) . "', '" . implode(",", $opcoes_desagrada) . "')";
    $conn->query($sql);

    // Mensagem de sucesso
    echo '<div class="alert alert-success">Respostas enviadas com sucesso!</div>';
}

// Retângulos
echo '<div class="mais-se-identifica">';
echo '<h3>Mais se identifica</h3>';
echo '<ul id="mais-se-identifica-list">';
echo '</ul>';
echo '</div>';

echo '<div class="menos-se-identifica">';
echo '<h3>Menos se identifica</h3>';
echo '<ul id="menos-se-identifica-list">';
echo '</ul>';
echo '</div>';