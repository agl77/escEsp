<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Questionário Vocacional de Especialidade Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body>
    <?php
    // Dados das respostas do localStorage em formato JSON
    $respostas_json = isset($_GET["dadosCadastro"]) ? $_GET["dadosCadastro"] : "[]";

    // Decodifica os dados JSON em um array associativo
    $respostas = json_decode($respostas_json, true);

    // Define um array associativo que mapeia cada resposta à sua pontuação correspondente
    $pontuacao_respostas = [
      "pergunta001" => ["A" => "Extroversão", "B" => "Intuição"],
      "pergunta002" => ["A" => "Intuição", "B" => "Sensação"],
      "pergunta003" => ["A" => "Pensamento", "B" => "Sentimento"],
      "pergunta004" => ["A" => "Extroversão", "B" => "Introversão"],
      "pergunta005" => ["A" => "Intuição", "B" => "Organizacional/Administrativo", "C" => "Sensação"],
      "pergunta006" => ["A" => "Comunicação/Persuasão", "B" => "Pensamento", "C" => "Sentimento"],
      "pergunta007" => ["A" => "Comunicação/Persuasão", "B" => "Extroversão", "C" => "Introversão"],
      "pergunta008" => ["A" => "Intuição", "B" => "Sensação"],
      "pergunta009" => ["A" => "Comunicação/Persuasão", "B" => "Pensamento", "C" => "Sentimento"],
      "pergunta010" => ["A" => "Extroversão", "B" => "Introversão"],
      "pergunta011" => ["A" => "Intuição", "B" => "Organizacional/Administrativo", "C" => "Sensação"],
      "pergunta012" => ["A" => "Pensamento", "B" => "Sentimento"],
      "pergunta013" => ["A" => "Extroversão", "B" => "Cálculo/Finanças", "C" => "Introversão"],
      "pergunta014" => ["A" => "Intuição", "B" => "Comportamental/Educacional", "C" => "Sensação"],
      "pergunta015" => ["A" => "Pensamento", "B" => "Simbólico/Linguístico", "C" => "Sentimento"],
      "pergunta016" => ["A" => "Físico-Matemático", "B" => "Saúde"],
      "pergunta017" => ["A" => "Comportamental-Educacional", "B" => "Físico-Químico"],
      "pergunta018" => ["A" => "Organizacional-Administrativo", "B" => "Extroversão", "C" => "Paciente (Saúde)", "D" => "Introversão"],
      "pergunta019" => ["A" => "Saúde", "B" => "Intuição", "C" => "Cálculo/Finanças", "D" => "Sensação"],
      "pergunta020" => ["A" => "Organizacional/Administrativo", "B" => "Pensamento", "C" => "Jurídico/Social", "D" => "Sentimento"],
      "pergunta021" => ["A" => "Extroversão", "B" => "Cálculo/Finanças", "C" => "Introversão"],
      "pergunta022" => ["A" => "Cálculo/Finanças", "B" => "Intuição", "C" => "Organizacional/Administrativo", "D" => "Sensação"],
      "pergunta023" => ["A" => "Jurídico/Social", "B" => "Pensamento", "C" => "Comportamental/Educacional", "D" => "Sentimento"],
      "pergunta024" => ["A" => "Simbólico/Linguístico", "B" => "Extroversão", "C" => "Introversão"],
      "pergunta025" => ["A" => "Simbólico/Linguístico", "B" => "Intuição", "C" => "Organizacional/Administrativo", "D" => "Sensação"],
      "pergunta026" => ["A" => "Pensamento", "B" => "Sentimento"],
      "pergunta027" => ["A" => "Extroversão", "B" => "Introversão"],
      "pergunta028" => ["A" => "Organizacional/Administrativo", "B" => "Intuição", "C" => "Sensação"],
      "pergunta029" => ["A" => "Cálculo/Finanças", "B" => "Pensamento", "C" => "Organizacional/Administrativo", "D" => "Sentimento"],
      "pergunta030" => ["A" => "Extroversão", "B" => "Introversão"],
      "pergunta031" => ["A" => "Comunicação/Persuasão", "B" => "Intuição", "C" => "Cálculo/Finanças", "D" => "Sensação"],
      "pergunta032" => ["A" => "Físico/Matemático", "B" => "Pensamento", "C" => "Saúde", "D" => "Sentimento"],
      "pergunta033" => ["A" => "Físico/Matemático", "B" => "Simbólico/Linguístico"],
      "pergunta034" => ["A" => "Organizacional/Administrativo", "B" => "Simbólico/Linguístico"],
      "pergunta035" => ["A" => "Extroversão", "B" => "Organizacional/Administrativo", "C" => "Introversão"],
      "pergunta036" => ["A" => "Intuição", "B" => "Cálculo/Finanças", "C" => "Sensação"],
      "pergunta037" => ["A" => "Cálculo/Finanças", "B" => "Pensamento", "C" => "Manual/Artístico"],
      "pergunta038" => ["A" => "Comunicação/Persuasão", "B" => "Extroversão", "C" => "Organizacional/Administrativo", "D" => "Introversão"],
      "pergunta039" => ["A" => "Organizacional/Administrativo", "B" => "Intuição", "C" => "Comunicação/Persuasão", "D" => "Sensação"],
      "pergunta040" => ["A" => "Comportamental/Educacional", "B" => "Pensamento", "C" => "Manual/Artístico", "D" => "Sentimento"],
      "pergunta041" => ["A" => "Extroversão", "B" => "Introversão"],
      "pergunta042" => ["A" => "Organizacional/Administrativo", "B" => "Intuição", "C" => "Comportamental/Educacional", "D" => "Sensação"],
      "pergunta043" => ["A" => "Físico/Matemático", "B" => "Pensamento", "C" => "Manual/Artístico", "D" => "Sentimento"],
      "pergunta044" => ["A" => "Cálculo/Finanças", "B" => "Extroversão", "C" => "Simbólico/Linguístico", "D" => "Introversão"],
      "pergunta045" => ["A" => "Intuição", "B" => "Sensação"],
      "pergunta046" => ["A" => "Pensamento", "B" => "Jurídico/Social", "C" => "Sentimento"],
      "pergunta047" => ["A" => "Extroversão", "B" => "Introversão"],
      "pergunta048" => ["A" => "Simbólico/Linguístico", "B" => "Intuição", "C" => "Manual/Artístico", "D" => "Sensação"],
      "pergunta049" => ["A" => "Cálculo/Finanças", "B" => "Pensamento", "C" => "Simbólico/Linguístico", "D" => "Sentimento"],
      "pergunta050" => ["A" => "Manual/Artístico", "B" => "Cálculo/Finanças"],
      "pergunta051" => ["A" => "Comunicação/Persuasão", "B" => "Extroversão", "C" => "Introversão"],
      "pergunta052" => ["A" => "Manual/Artístico", "B" => "Intuição", "C" => "Físico/Matemático", "D" => "Sensação"],
      "pergunta053" => ["A" => "Físico/Químico", "B" => "Pensamento", "C" => "Sentimento"],
      "pergunta054" => ["A" => "Extroversão", "B" => "Introversão"],
      "pergunta055" => ["A" => "Ideias (Simbólico/Linguístico)", "B" => "Intuição", "C" => "Físico/Matemático", "D" => "Sensação"],
      "pergunta056" => ["A" => "Cálculo/Finanças", "B" => "Pensamento", "C" => "Comunicação/Persuasão", "D" => "Sentimento"],
      "pergunta057" => ["A" => "Comunicação/Persuasão", "B" => "Extroversão", "C" => "Introversão"],
      "pergunta058" => ["A" => "Intuição", "B" => "Cálculo/Finanças", "C" => "Sensação"],
      "pergunta059" => ["A" => "Físico/Matemático", "B" => "Pensamento", "C" => "Simbólico/Linguístico", "D" => "Sentimento"],
      "pergunta060" => ["A" => "Comunicação/Persuasão", "B" => "Extroversão", "C" => "Simbólico/Linguístico", "D" => "Introversão"],
      "pergunta061" => ["A" => "Físico/Matemático", "B" => "Intuição", "C" => "Cálculo/Finanças", "D" => "Sensação"],
      "pergunta062" => ["A" => "Jurídico/Social", "B" => "Pensamento", "C" => "Comunicação/Persuasão", "D" => "Sentimento"],
      "pergunta063" => ["A" => "Comportamental/Educacional", "B" => "Extroversão", "C" => "Manual/Artístico", "D" => "Introversão"],
      "pergunta064" => ["A" => "Físico/Matemático", "B" => "Intuição", "C" => "Físico/Químico", "D" => "Sensação"],
      "pergunta065" => ["A" => "Simbólico/Linguístico", "B" => "Pensamento", "C" => "Jurídico/Social", "D" => "Sentimento"],
      "pergunta066" => ["A" => "Comunicação/Persuasão", "B" => "Simbólico/Linguístico"],
      "pergunta067" => ["A" => "Organizacional/Administrativo", "B" => "Cálculo/Finanças"],
      "pergunta068" => ["A" => "Físico/Matemático", "B" => "Comportamental/Educacional"],
      "pergunta069" => ["A" => "Físico/Químico", "B" => "Jurídico/Social"],
      "pergunta070" => ["A" => "Extroversão", "B" => "Introversão"],
      "pergunta071" => ["A" => "Intuição", "B" => "Cálculo/Finanças", "C" => "Sensação"],
      "pergunta072" => ["A" => "Físico/Matemático", "B" => "Pensamento", "C" => "Saúde", "D" => "Sentimento"],
      "pergunta073" => ["A" => "Comunicação/Persuasão", "B" => "Extroversão", "C" => "Introversão"],
      "pergunta074" => ["A" => "Manual/Artístico", "B" => "Intuição", "C" => "Organizacional/Administrativo", "D" => "Sensação"],
      "pergunta075" => ["A" => "Físico/Matemático", "B" => "Pensamento", "C" => "Simbólico/Linguístico", "D" => "Sentimento"],
      "pergunta076" => ["A" => "Saúde", "B" => "Extroversão", "C" => "Manual/Artístico", "D" => "Introversão"],
      "pergunta077" => ["A" => "Manual/Artístico", "B" => "Intuição", "C" => "Organizacional/Administrativo", "D" => "Sensação"],
      "pergunta078" => ["A" => "Jurídico/Social", "B" => "Pensamento", "C" => "Comunicação/Persuasão", "D" => "Sentimento"],
      "pergunta079" => ["A" => "Extroversão", "B" => "Introversão"],
      "pergunta080" => ["A" => "Cálculo/Finanças", "B" => "Intuição", "C" => "Manual/Artístico", "D" => "Sensação"],
      "pergunta081" => ["A" => "Pensamento", "B" => "Sentimento"],
      "pergunta082" => ["A" => "Extroversão", "B" => "Introversão"],
      "pergunta083" => ["A" => "Simbólico/Linguístico", "B" => "Intuição", "C" => "Comunicação/Persuasão", "D" => "Sensação"],
      "pergunta084" => ["A" => "Organizacional/Administrativo", "B" => "Pensamento", "C" => "Comunicação/Persuasão", "D" => "Sentimento"],
      "pergunta085" => ["A" => "Comportamental/Educacional", "B" => "Jurídico/Social"],
      "pergunta086" => ["A" => "Saúde", "B" => "Organizacional/Administrativo"],
      "pergunta087" => ["A" => "Comunicação/Persuasão", "B" => "Extroversão", "C" => "Comportamental/Educacional", "D" => "Introversão"],
      "pergunta088" => ["A" => "Simbólico/Linguístico", "B" => "Intuição", "C" => "Físico/Matemático", "D" => "Sensação"],
      "pergunta089" => ["A" => "Cálculo/Finanças", "B" => "Pensamento", "C" => "Simbólico/Linguístico", "D" => "Sentimento"],
      "pergunta090" => ["A" => "Comunicação/Persuasão", "B" => "Extroversão", "C" => "Físico/Químico", "D" => "Introversão"],
      "pergunta091" => ["A" => "Cálculo/Finanças", "B" => "Intuição", "C" => "Organizacional/Administrativo", "D" => "Sensação"],
      "pergunta092" => ["A" => "Físico/Matemático", "B" => "Pensamento", "C" => "Comunicação/Persuasão", "D" => "Sentimento"],
      "pergunta093" => ["A" => "Comportamental/Educacional", "B" => "Extroversão", "C" => "Manual/Artístico", "D" => "Introversão"],
      "pergunta094" => ["A" => "Físico/Químico", "B" => "Intuição", "C" => "Cálculo/Finanças", "D" => "Sensação"],
      "pergunta095" => ["A" => "Comportamental/Educacional", "B" => "Pensamento", "C" => "Simbólico/Linguístico", "D" => "Sentimento"],
      "pergunta096" => ["A" => "Manual/Artístico", "B" => "Extroversão", "C" => "Cálculo/Finanças", "D" => "Introversão"],
      "pergunta097" => ["A" => "Manual/Artístico", "B" => "Intuição", "C" => "Organizacional/Administrativo", "D" => "Sensação"],
      "pergunta098" => ["A" => "Jurídico/Social", "B" => "Pensamento", "C" => "Saúde", "D" => "Sentimento"],
      "pergunta099" => ["A" => "Organizacional/Administrativo", "B" => "Extroversão", "C" => "Físico/Químico", "D" => "Introversão"],
      "pergunta100" => ["A" => "Comunicação/Persuasão", "B" => "Intuição", "C" => "Organizacional/Administrativo", "D" => "Sensação"],
      "pergunta101" => ["A" => "Físico/Matemático", "B" => "Pensamento", "C" => "Comportamental/Educacional", "D" => "Sentimento"],
      "pergunta102" => ["A" => "Físico/Químico", "B" => "Extroversão", "C" => "Jurídico/Social", "D" => "Introversão"],
      "pergunta103" => ["A" => "Manual/Artístico", "B" => "Intuição", "C" => "Organizacional/Administrativo", "D" => "Sensação"],
      "pergunta104" => ["A" => "Jurídico/Social", "B" => "Pensamento", "C" => "Manual/Artístico", "D" => "Sentimento"],
      "pergunta105" => ["A" => "Simbólico/Linguístico", "B" => "Manual/Artístico"],
      "pergunta106" => ["A" => "Comportamental/Educacional", "B" => "Físico/Químico"],
      "pergunta107" => ["A" => "Comportamental/Educacional", "B" => "Físico/Químico"],
      "pergunta108" => ["A" => "Organizacional/Administrativo", "B" => "Saúde"],
      "pergunta109" => ["A" => "Cálculo/Finanças", "B" => "Jurídico/Social"],
      "pergunta110" => ["A" => "Comunicação/Persuasão", "B" => "Comportamental/Educacional"],
      "pergunta111" => ["A" => "Organizacional/Administrativo", "B" => "Simbólico/Linguístico"],
    ];

    // Inicializa as pontuações
    $pontuacoes = [
      "Extroversão" => 0,
      "Introversão" => 0,
      "Intuição" => 0,
      "Sensação" => 0,
      "Pensamento" => 0,
      "Sentimento" => 0,
      "Organizacional/Administrativo" => 0,
      "Comportamental/Educacional" => 0,
      "Físico/Matemático" => 0,
      "Físico/Químico" => 0,
      "Simbólico/Linguístico" => 0,
      "Manual/Artístico" => 0,
      "Jurídico/Social" => 0,
      "Saúde" => 0,
      "Cálculo/Finanças" => 0,
  ];

    // Itera sobre as respostas e calcula as pontuações
    foreach ($respostas as $pergunta => $resposta) {
        // Verifica se a resposta é diferente de null
        if ($resposta !== null) {
            // Obtém a pontuação correspondente à resposta
            $pontuacao = $pontuacao_respostas[$pergunta][$resposta] ?? null;
            // Se houver uma pontuação correspondente, incrementa a pontuação correspondente
            if ($pontuacao !== null) {
                $pontuacoes[$pontuacao]++;
            }
        }
    }

    // Imprime as pontuações
    foreach ($pontuacoes as $pontuacao => $pontuacao_valor) {
        echo "$pontuacao: $pontuacao_valor<br>";
    }
    echo "$respostas_json";
    ?>
  </body>
</html>
