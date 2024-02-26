<?php
session_start();

if (!isset($_SESSION['usuario_autenticado'])) {
    header("Location: login.php");
    exit();
}

$tempoAtual = time();
$tempoExpiracao = 1800; // 30 minutos em segundos

if (isset($_SESSION['ultima_atividade']) && ($tempoAtual - $_SESSION['ultima_atividade'] > $tempoExpiracao)) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

$_SESSION['ultima_atividade'] = $tempoAtual;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apresentação das respostas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<?php
include('../db_conf.php');

function exibirCabecalhoCadastro($infoCadastro) {
    $dataFormatada = date('d/m/Y', strtotime($infoCadastro['Nascimento']));
    echo "<p><strong>Nascimento.:</strong> {$dataFormatada} | <strong>Fone:</strong> {$infoCadastro['telefone']} | <strong>Inst:</strong> {$infoCadastro['instituicao']}";
    if ($infoCadastro['formado']) {
        echo " | <strong>Formado:</strong> Sim | <strong>Conclusão:</strong> {$infoCadastro['periodo']} | <strong>Especialidade:</strong> {$infoCadastro['especialidade']}</p>";
    } else {
        echo " | <strong>Formado:</strong> Não | <strong>Período:</strong> {$infoCadastro['periodo']}</p>";
    }
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $consulta = $pdo->query("SELECT idcadastro, email FROM cadastro");
    $cadastros = $consulta->fetchAll(PDO::FETCH_ASSOC);

    echo "<form method='post' action='' id='formCadastro'>";
    echo "<label for='cadastro'>Selecione um cadastro:</label>";
    echo "<select id='cadastro' name='cadastro' onchange='carregarInfoCadastro(this.value)'>";
    foreach ($cadastros as $cadastro) {
        $value = $cadastro['idcadastro'] . ' - ' . $cadastro['email'];
        $selected = (isset($_GET['idcadastro']) && $_GET['idcadastro'] == $cadastro['idcadastro']) ? 'selected' : '';
        echo "<option value='{$value}' {$selected}>{$value}</option>";
    }
    echo "</select>";
    echo "</form>";
    echo "<div id='infoCadastro'></div>";

    if (isset($_GET['idcadastro'])) {
        $cadastroSelecionado = $_GET['idcadastro'];
        $consultaCadastro = $pdo->prepare("SELECT * FROM cadastro WHERE idcadastro = ?");
        $consultaCadastro->execute([$cadastroSelecionado]);
        $infoCadastroSelecionado = $consultaCadastro->fetch(PDO::FETCH_ASSOC);
        exibirCabecalhoCadastro($infoCadastroSelecionado);
    }

} catch (PDOException $e) {
    echo "Erro ao obter os dados: " . $e->getMessage();
}
?>
<div id="pageContent">
    <!-- O conteúdo da página será carregado aqui -->
    <ul id="dadosRecebidos"></ul>

</div>

<script>
    function carregarInfoCadastro(idcadastro) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("infoCadastro").innerHTML = this.responseText;
                localStorage.setItem('dadosCadastro' , this.responseText);
            }
        };
        xhttp.open("GET", "get_info_cadastro.php?idcadastro=" + idcadastro, true);
        xhttp.send();
    }
</script>
<script>
function buscarDadosDoServidor(idCadastro) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            localStorage.setItem('dadosPerguntas', this.responseText);

            // Envia os dados para o PHP via AJAX
            var xhr = new XMLHttpRequest();
            var url = 'receber_dados.php';
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Recebe a resposta do PHP
                    var resposta = JSON.parse(xhr.responseText);

                    // Seleciona o elemento onde os dados serão exibidos
                    var listaDados = document.getElementById('dadosRecebidos');

                    // Limpa o conteúdo existente
                    listaDados.innerHTML = '';

                    // Itera sobre as chaves do objeto resposta
                    for (var variavel in resposta) {
                        if (resposta.hasOwnProperty(variavel)) {
                            // Formata a saída para cada variável
                            var pontuacao = resposta[variavel].pontuacao;
                            var totalQuestoes = resposta[variavel].total_questoes;
                            var percentual = resposta[variavel].percentual.toFixed(1) + '%';

                            // Cria um item da lista para cada variável
                            var itemLista = document.createElement('li');

                            // Adiciona a descrição formatada ao item da lista
                            var descricao = document.createTextNode(variavel + ': ' + pontuacao + '/' + totalQuestoes + ', ' + percentual);
                            itemLista.appendChild(descricao);

                            // Adiciona o item à lista
                            listaDados.appendChild(itemLista);
                        }
                    }

                    // Imprime a resposta do PHP no console
                    console.log('Resposta do PHP:', resposta);
                }
            };
            xhr.send(localStorage.getItem('dadosPerguntas'));
        }
    };
    xhttp.open("GET", "get_dados_perguntas.php?idcadastro=" + idCadastro, true);
    xhttp.send();
}

document.addEventListener("DOMContentLoaded", function() {
    var selectCadastro = document.getElementById('cadastro');
    selectCadastro.addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var idCadastro = selectedOption.value.split(' - ')[0];
        buscarDadosDoServidor(idCadastro);
    });
});

</script>

</body>
</html>
