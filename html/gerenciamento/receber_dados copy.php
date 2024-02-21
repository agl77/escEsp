<?php
// Define o cabeçalho HTTP para indicar que o conteúdo é UTF-8
header('Content-Type: text/html; charset=utf-8');

// Recebe os dados do localStorage

$dadosLocalStorage = json_decode(file_get_contents('php://input'), true);
// Inicializa um array para armazenar a pontuação de cada variável
$pontuacoes = [
    "Extroversão" => ["pontuacao" => 0, "total_questoes" => 31],
    "Introversão" => ["pontuacao" => 0, "total_questoes" => 31],
    "Intuição" => ["pontuacao" => 0, "total_questoes" => 31],
    "Sensação" => ["pontuacao" => 0, "total_questoes" => 31],
    "Pensamento" => ["pontuacao" => 0, "total_questoes" => 31],
    "Sentimento" => ["pontuacao" => 0, "total_questoes" => 31],
    "Organizacional/Administrativo" => ["pontuacao" => 0, "total_questoes" => 25],
    "Comportamental/Educacional" => ["pontuacao" => 0, "total_questoes" => 16],
    "Físico/Matemático" => ["pontuacao" => 0, "total_questoes" => 15],
    "Físico/Químico" => ["pontuacao" => 0, "total_questoes" => 10],
    "Simbólico/Linguístico" => ["pontuacao" => 0, "total_questoes" => 19],
    "Manual/Artístico" => ["pontuacao" => 0, "total_questoes" => 17],
    "Jurídico/Social" => ["pontuacao" => 0, "total_questoes" => 12],
    "Saúde" => ["pontuacao" => 0, "total_questoes" => 9],
    "Cálculo/Finanças" => ["pontuacao" => 0, "total_questoes" => 22],
    "Comunicação/Persuasão" => ["pontuacao" => 0, "total_questoes" => 20],
];
// Array associativo para mapear perguntas às opções de respostas

$pontuacao_respostas = [
    "pergunta001" => ["A" => "Extroversão", "B" => "Intuição"],
    "pergunta002" => ["A" => "Intuição", "B" => "Sensação"],
    "pergunta003" => ["A" => "Pensamento", "B" => "Sentimento"],
    "pergunta004" => ["A" => "Extroversão", "B" => "Introversão"],
    "pergunta005" => ["A" => "Intuição", "B" => ["Organizacional/Administrativo", "Sensação"]],
    "pergunta006" => ["A" => ["Comunicação/Persuasão" , "Pensamento"], "B" => "Sentimento"],
    "pergunta007" => ["A" => "Comunicação/Persuasão", "B" => ["Extroversão", "Introversão"]],
    "pergunta008" => ["A" => "Intuição", "B" => "Sensação"],
    "pergunta009" => ["A" => ["Comunicação/Persuasão", "Pensamento"],"B" =>  "Sentimento"],
    "pergunta010" => ["A" => "Extroversão", "B" => "Introversão"],
    "pergunta011" => ["A" => "Intuição", "B" => ["Organizacional/Administrativo", "Sensação"]],
    "pergunta012" => ["A" => "Pensamento", "B" => "Sentimento"],
    "pergunta013" => ["A" => "Extroversão", "B" => ["Cálculo/Finanças", "Introversão"]],
    "pergunta014" => ["A" => "Intuição", "B" => ["Comportamental/Educacional", "Sensação"]],
    "pergunta015" => ["A" => "Pensamento", "B" => ["Simbólico/Linguístico", "Sentimento"]],
    "pergunta016" => ["A" => "Físico/Matemático", "B" => "Saúde"],
    "pergunta017" => ["A" => "Comportamental/Educacional", "B" => "Físico/Químico"],
    "pergunta018" => ["A" => ["Organizacional/Administrativo", "Extroversão"],"B" => ["Saúde", "Introversão"]],
    "pergunta019" => ["A" => ["Saúde", "Intuição"], "B" => ["Cálculo/Finanças", "Sensação"]],
    "pergunta020" => ["A" => ["Organizacional/Administrativo", "Pensamento"], "B" => ["Jurídico/Social",  "Sentimento"]],
    "pergunta021" => ["A" => "Extroversão", "B" => ["Cálculo/Finanças", "Introversão"]],
    "pergunta022" => ["A" => ["Cálculo/Finanças", "Intuição"], "B" => ["Organizacional/Administrativo", "Sensação"]],
    "pergunta023" => ["A" => "Jurídico/Social", "B" => "Pensamento", "Comportamental/Educacional", "Sentimento"],
    "pergunta024" => ["A" => "Simbólico/Linguístico", "B" => "Extroversão", "Introversão"],
    "pergunta025" => ["A" => "Simbólico/Linguístico", "B" => "Intuição", "Organizacional/Administrativo", "Sensação"],
    "pergunta026" => ["A" => "Pensamento", "B" => "Sentimento"],
    "pergunta027" => ["A" => "Extroversão", "B" => "Introversão"],
    "pergunta028" => ["A" => "Organizacional/Administrativo", "B" => "Intuição", "Sensação"],
    "pergunta029" => ["A" => "Cálculo/Finanças", "B" => "Pensamento", "Organizacional/Administrativo", "Sentimento"],
    "pergunta030" => ["A" => "Extroversão", "B" => "Introversão"],
    "pergunta031" => ["A" => "Comunicação/Persuasão", "B" => "Intuição", "Cálculo/Finanças", "Sensação"],
    "pergunta032" => ["A" => "Físico/Matemático", "B" => "Pensamento", "Saúde", "Sentimento"],
    "pergunta033" => ["A" => "Físico/Matemático", "B" => "Simbólico/Linguístico"],
    "pergunta034" => ["A" => "Organizacional/Administrativo", "B" => "Simbólico/Linguístico"],
    "pergunta035" => ["A" => "Extroversão", "B" => "Organizacional/Administrativo", "Introversão"],
    "pergunta036" => ["A" => "Intuição", "B" => "Cálculo/Finanças", "Sensação"],
    "pergunta037" => ["A" => "Cálculo/Finanças", "B" => "Pensamento", "Manual/Artístico"],
    "pergunta038" => ["A" => "Comunicação/Persuasão", "B" => "Extroversão", "Organizacional/Administrativo", "Introversão"],
    "pergunta039" => ["A" => "Organizacional/Administrativo", "B" => "Intuição", "Comunicação/Persuasão", "Sensação"],
    "pergunta040" => ["A" => "Comportamental/Educacional", "B" => "Pensamento", "Manual/Artístico", "Sentimento"],
    "pergunta041" => ["A" => "Extroversão", "B" => "Introversão"],
    "pergunta042" => ["A" => "Organizacional/Administrativo", "B" => "Intuição", "Comportamental/Educacional", "Sensação"],
    "pergunta043" => ["A" => "Físico/Matemático", "B" => "Pensamento", "Manual/Artístico", "Sentimento"],
    "pergunta044" => ["A" => "Cálculo/Finanças", "B" => "Extroversão", "Simbólico/Linguístico", "Introversão"],
    "pergunta045" => ["A" => "Intuição", "B" => "Sensação"],
    "pergunta046" => ["A" => "Pensamento", "B" => "Jurídico/Social", "Sentimento"],
    "pergunta047" => ["A" => "Extroversão", "B" => "Introversão"],
    "pergunta048" => ["A" => "Simbólico/Linguístico", "B" => "Intuição", "Manual/Artístico", "Sensação"],
    "pergunta049" => ["A" => "Cálculo/Finanças", "B" => "Pensamento", "Simbólico/Linguístico", "Sentimento"],
    "pergunta050" => ["A" => "Manual/Artístico", "B" => "Cálculo/Finanças"],
    "pergunta051" => ["A" => "Comunicação/Persuasão", "B" => "Extroversão", "Introversão"],
    "pergunta052" => ["A" => "Manual/Artístico", "B" => "Intuição", "Físico/Matemático", "Sensação"],
    "pergunta053" => ["A" => "Físico/Químico", "B" => "Pensamento", "Sentimento"],
    "pergunta054" => ["A" => "Extroversão", "B" => "Introversão"],
    "pergunta055" => ["A" => ["Simbólico/Linguístico","Intuição"],  "B" => ["Físico/Matemático","Sensação"]],
    "pergunta056" => ["A" => ["Cálculo/Finanças", "Pensamento"], "B" => ["Comunicação/Persuasão", "Sentimento"]],
    "pergunta057" => ["A" => "Comunicação/Persuasão", "B" => "Extroversão", "Introversão"],
    "pergunta058" => ["A" => "Intuição", "B" => "Cálculo/Finanças", "Sensação"],
    "pergunta059" => ["A" => "Físico/Matemático", "B" => "Pensamento", "Simbólico/Linguístico", "Sentimento"],
    "pergunta060" => ["A" => "Comunicação/Persuasão", "B" => "Extroversão", "Simbólico/Linguístico", "Introversão"],
    "pergunta061" => ["A" => "Físico/Matemático", "B" => "Intuição", "Cálculo/Finanças", "Sensação"],
    "pergunta062" => ["A" => "Jurídico/Social", "B" => "Pensamento", "Comunicação/Persuasão", "Sentimento"],
    "pergunta063" => ["A" => "Comportamental/Educacional", "B" => "Extroversão", "Manual/Artístico", "Introversão"],
    "pergunta064" => ["A" => "Físico/Matemático", "B" => "Intuição", "Físico/Químico", "Sensação"],
    "pergunta065" => ["A" => "Simbólico/Linguístico", "B" => "Pensamento", "Jurídico/Social", "Sentimento"],
    "pergunta066" => ["A" => "Comunicação/Persuasão", "B" => "Simbólico/Linguístico"],
    "pergunta067" => ["A" => "Organizacional/Administrativo", "B" => "Cálculo/Finanças"],
    "pergunta068" => ["A" => "Físico/Matemático", "B" => "Comportamental/Educacional"],
    "pergunta069" => ["A" => "Físico/Químico", "B" => "Jurídico/Social"],
    "pergunta070" => ["A" => "Extroversão", "B" => "Introversão"],
    "pergunta071" => ["A" => "Intuição", "B" => "Cálculo/Finanças", "Sensação"],
    "pergunta072" => ["A" => "Físico/Matemático", "B" => "Pensamento", "Saúde", "Sentimento"],
    "pergunta073" => ["A" => "Comunicação/Persuasão", "B" => "Extroversão", "Introversão"],
    "pergunta074" => ["A" => "Manual/Artístico", "B" => "Intuição", "Organizacional/Administrativo", "Sensação"],
    "pergunta075" => ["A" => "Físico/Matemático", "B" => "Pensamento", "Simbólico/Linguístico", "Sentimento"],
    "pergunta076" => ["A" => "Saúde", "B" => "Extroversão", "Manual/Artístico", "Introversão"],
    "pergunta077" => ["A" => "Manual/Artístico", "B" => "Intuição", "Organizacional/Administrativo", "Sensação"],
    "pergunta078" => ["A" => "Jurídico/Social", "B" => "Pensamento", "Comunicação/Persuasão", "Sentimento"],
    "pergunta079" => ["A" => "Extroversão", "B" => "Introversão"],
    "pergunta080" => ["A" => "Cálculo/Finanças", "B" => "Intuição", "Manual/Artístico", "Sensação"],
    "pergunta081" => ["A" => "Pensamento", "B" => "Sentimento"],
    "pergunta082" => ["A" => "Extroversão", "B" => "Introversão"],
    "pergunta083" => ["A" => "Simbólico/Linguístico", "B" => "Intuição", "Comunicação/Persuasão", "Sensação"],
    "pergunta084" => ["A" => "Organizacional/Administrativo", "B" => "Pensamento", "Comunicação/Persuasão", "Sentimento"],
    "pergunta085" => ["A" => "Comportamental/Educacional", "B" => "Jurídico/Social"],
    "pergunta086" => ["A" => "Saúde", "B" => "Organizacional/Administrativo"],
    "pergunta087" => ["A" => "Comunicação/Persuasão", "B" => "Extroversão", "Comportamental/Educacional", "Introversão"],
    "pergunta088" => ["A" => "Simbólico/Linguístico", "B" => "Intuição", "Físico/Matemático", "Sensação"],
    "pergunta089" => ["A" => "Cálculo/Finanças", "B" => "Pensamento", "Simbólico/Linguístico", "Sentimento"],
    "pergunta090" => ["A" => "Comunicação/Persuasão", "B" => "Extroversão", "Físico/Químico", "Introversão"],
    "pergunta091" => ["A" => "Cálculo/Finanças", "B" => "Intuição", "Organizacional/Administrativo", "Sensação"],
    "pergunta092" => ["A" => "Físico/Matemático", "B" => "Pensamento", "Comunicação/Persuasão", "Sentimento"],
    "pergunta093" => ["A" => "Comportamental/Educacional", "B" => "Extroversão", "Manual/Artístico", "Introversão"],
    "pergunta094" => ["A" => "Físico/Químico", "B" => "Intuição", "Cálculo/Finanças", "Sensação"],
    "pergunta095" => ["A" => "Comportamental/Educacional", "B" => "Pensamento", "Simbólico/Linguístico", "Sentimento"],
    "pergunta096" => ["A" => "Manual/Artístico", "B" => "Extroversão", "Cálculo/Finanças", "Introversão"],
    "pergunta097" => ["A" => "Manual/Artístico", "B" => "Intuição", "Organizacional/Administrativo", "Sensação"],
    "pergunta098" => ["A" => "Jurídico/Social", "B" => "Pensamento", "Saúde", "Sentimento"],
    "pergunta099" => ["A" => "Organizacional/Administrativo", "B" => "Extroversão", "Físico/Químico", "Introversão"],
    "pergunta100" => ["A" => "Comunicação/Persuasão", "B" => "Intuição", "Organizacional/Administrativo", "Sensação"],
    "pergunta101" => ["A" => "Físico/Matemático", "B" => "Pensamento", "Comportamental/Educacional", "Sentimento"],
    "pergunta102" => ["A" => "Físico/Químico", "B" => "Extroversão", "Jurídico/Social", "Introversão"],
    "pergunta103" => ["A" => "Manual/Artístico", "B" => "Intuição", "Organizacional/Administrativo", "Sensação"],
    "pergunta104" => ["A" => "Jurídico/Social", "B" => "Pensamento", "Manual/Artístico", "Sentimento"],
    "pergunta105" => ["A" => "Simbólico/Linguístico", "B" => "Manual/Artístico"],
    "pergunta106" => ["A" => "Comportamental/Educacional", "B" => "Físico/Químico"],
    "pergunta107" => ["A" => "Comportamental/Educacional", "B" => "Físico/Químico"],
    "pergunta108" => ["A" => "Organizacional/Administrativo", "B" => "Saúde"],
    "pergunta109" => ["A" => "Cálculo/Finanças", "B" => "Jurídico/Social"],
    "pergunta110" => ["A" => "Comunicação/Persuasão", "B" => "Comportamental/Educacional"],
    "pergunta111" => ["A" => "Organizacional/Administrativo", "B" => "Simbólico/Linguístico"],
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
        } else {
            // Trate aqui o caso em que a resposta não está definida nas respostas possíveis
        }
    }
}

// Calcular os percentuais para cada variável
foreach ($pontuacoes as $variavel => $dados) {
    $pontuacoes[$variavel]["percentual"] = ($dados["pontuacao"] / $dados["total_questoes"]) * 100;
}

// Imprimir os percentuais
foreach ($pontuacoes as $variavel => $dados) {
    echo "{$variavel}: {$dados['percentual']}%<br>";
}
// Retorna a pontuação como JSON
echo json_encode($pontuacoes);
?>
