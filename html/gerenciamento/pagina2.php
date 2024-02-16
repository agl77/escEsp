<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Questionário Vocacional de Especialidade Médica</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <h1 id="pontuacoes_titulo">Pontuações do Questionário Vocacional:</h1>
  <div id="pontuacoes"></div>

  <script>
    const urlParams = new URLSearchParams(window.location.search);
    const dadosCadastro = urlParams.get('dadosCadastro');
    const respostas = JSON.parse(dadosCadastro || '[]');

    const pontuacaoRespostas = {
      "pergunta001": { "A": "Extroversão", "B": "Intuição" },
      "pergunta002": { "A": "Intuição", "B": "Sensação" },
      // Adicione aqui os demais mapeamentos
    };

    const pontuacoes = {
      "Extroversão": 0,
      "Introversão": 0,
      "Intuição": 0,
      "Sensação": 0,
      "Pensamento": 0,
      "Sentimento": 0,
      // Adicione aqui as demais pontuações
    };

    for (const pergunta in respostas) {
      const resposta = respostas[pergunta];
      if (resposta !== null) {
        const pontuacao = pontuacaoRespostas[pergunta][resposta];
        if (pontuacao !== null) {
          pontuacoes[pontuacao]++;
        }
      }
    }

    const pontuacoesDiv = document.getElementById('pontuacoes');
    for (const pontuacao in pontuacoes) {
      const pontuacaoValor = pontuacoes[pontuacao];
      const pontuacaoElement = document.createElement('p');
      pontuacaoElement.textContent = `${pontuacao}: ${pontuacaoValor}`;
      pontuacoesDiv.appendChild(pontuacaoElement);
    }
  </script>
</body>
</html>