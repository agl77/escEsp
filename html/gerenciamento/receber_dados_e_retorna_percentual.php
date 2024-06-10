<?php
// Define o cabeçalho HTTP para indicar que o conteúdo é UTF-8
header('Content-Type: text/html; charset=utf-8');

// Recebe os dados do localStorage
$dadosLocalStorage = json_decode(file_get_contents('php://input'), true);

// Inicializa um array para armazenar a pontuação de cada variável
$pontuacoes = [
    "Organizacional/Administrativo" => ["pontuacao" => 0, "total_questoes" => 25],
    "Comportamental/Educacional" => ["pontuacao" => 0, "total_questoes" => 15],
    "Físico/Matemático" => ["pontuacao" => 0, "total_questoes" => 15],
    "Físico/Químico" => ["pontuacao" => 0, "total_questoes" => 10],
    "Simbólico/Linguístico" => ["pontuacao" => 0, "total_questoes" => 19],
    "Manual/Artístico" => ["pontuacao" => 0, "total_questoes" => 17],
    "Jurídico/Social" => ["pontuacao" => 0, "total_questoes" => 12],
    "Saúde" => ["pontuacao" => 0, "total_questoes" => 9],
    "Cálculo/Finanças" => ["pontuacao" => 0, "total_questoes" => 22],
    "Comunicação/Persuasão" => ["pontuacao" => 0, "total_questoes" => 21],
    "Extroversão" => ["pontuacao" => 0, "total_questoes" => 31],
    "Introversão" => ["pontuacao" => 0, "total_questoes" => 31],
    "Intuição" => ["pontuacao" => 0, "total_questoes" => 31],
    "Sensação" => ["pontuacao" => 0, "total_questoes" => 31],
    "Pensamento" => ["pontuacao" => 0, "total_questoes" => 31],
    "Sentimento" => ["pontuacao" => 0, "total_questoes" => 31],
];

// Array associativo para mapear perguntas às opções de respostas
$pontuacao_respostas = [
    // (colocar mapeamento de perguntas e respostas aqui)
];

// Processa os dados e calcula a pontuação para cada variável
foreach ($dadosLocalStorage as $pergunta => $resposta) {
    // Verifica se a pergunta não está vazia e se existe nas respostas disponíveis
    if (!empty($pergunta) && array_key_exists($pergunta, $pontuacao_respostas)) {
        // Obtém as respostas possíveis para a pergunta
        $respostas_possiveis = $pontuacao_respostas[$pergunta];
        
        // Verifica se a resposta é um array (ou seja, está associada a mais de uma variável)
        if (array_key_exists($resposta, $respostas_possiveis)) {
            if (is_array($respostas_possiveis[$resposta])) {
                // Itera sobre as variáveis associadas à resposta
                foreach ($respostas_possiveis[$resposta] as $variavel) {
                    // Incrementa a pontuação correspondente à variável
                    $pontuacoes[$variavel]["pontuacao"]++;
                }
            } else {
                // Incrementa a pontuação correspondente à resposta
                $pontuacao = $respostas_possiveis[$resposta];
                $pontuacoes[$pontuacao]["pontuacao"]++;
            }
        }
    }
}

// Calcular os percentuais para cada variável
foreach ($pontuacoes as $variavel => $dados) {
    $percentual = round(($dados["pontuacao"] / $dados["total_questoes"]) * 100, 1);
    $pontuacoes[$variavel]["percentual"] = $percentual;
}

// Separar categorias para ordenação
$categorias_ordenadas = [];
$categorias_fixas = ["Extroversão", "Introversão", "Intuição", "Sensação", "Pensamento", "Sentimento"];

// Adicionar categorias fixas ao array final
foreach ($categorias_fixas as $categoria) {
    if (isset($pontuacoes[$categoria])) {
        $categorias_ordenadas[$categoria] = $pontuacoes[$categoria];
    }
}

// Filtrar e ordenar as categorias restantes
$categorias_restantes = array_diff_key($pontuacoes, array_flip($categorias_fixas));
uasort($categorias_restantes, function($a, $b) {
    return $b['percentual'] <=> $a['percentual'];
});

// Adicionar categorias restantes ordenadas ao array final
foreach ($categorias_restantes as $categoria => $dados) {
    $categorias_ordenadas[$categoria] = $dados;
}

// Retorna a pontuação como JSON
$resposta_json = json_encode($categorias_ordenadas, JSON_UNESCAPED_UNICODE);
echo $resposta_json;
?>
