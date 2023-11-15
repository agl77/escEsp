<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Questionário Vocacional de Especialidade Médica</title>
    <!-- Inclua os links para os arquivos CSS e JavaScript do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body>
    <div class="container">
      <h1>Questionário Vocacional de Especialidade Médica</h1>
      <p><b>Leia atentamente cada uma das situações propostas e tente, por alguns minutos, visualizar-se nelas. Responda quais seriam suas reais preferências em cada uma das situações propostas.</b></p>
    </div>
    <div id="pageContent">
      <!-- O conteúdo da página será carregado aqui -->
    </div>

    <!-- Botão "Anterior" -->
    <button id="prevPage" onclick="previousPage()" disabled>Anterior</button>

    <!-- Botão "Próxima" -->
    <button id="nextPage" onclick="nextPage()">Próxima</button>

    <button id="sendForm" onclick="getAnswers()">Enviar</button>
    <!-- <button onclick="resetAnswers()">Resets</button> -->

    <script>
      const pages = ["pagina1.html", "pagina2.html", "pagina3.html", "pagina4.html", "pagina5.html", "pagina6.html"];
      let currentPage = 0;
      let answers = JSON.parse(localStorage.getItem("answers")) || {};
      let allAnswers = {};

      const sendButton = document.getElementById("sendForm");
      sendButton.style.display = "none";

      function loadPage(pageIndex) {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
          if (this.readyState === 4 && this.status === 200) {
            document.getElementById("pageContent").innerHTML = this.responseText;
            fillAnswers(pageIndex);
          }
        };
        xhttp.open("GET", pages[pageIndex], true);
        xhttp.send();
      }

      function previousPage() {
        if (currentPage > 0) {
          saveAnswers(currentPage);
          currentPage--;
          loadPage(currentPage);
          document.getElementById("nextPage").disabled = false;
          if (currentPage === 0) {
            document.getElementById("prevPage").disabled = true;
          }
        }
      }

      function nextPage() {
        if (currentPage < pages.length - 1) {
          saveAnswers(currentPage);
          currentPage++;
          loadPage(currentPage);
          document.getElementById("prevPage").disabled = false;
          if (currentPage === pages.length - 1) {
            document.getElementById("nextPage").disabled = true;
            sendButton.style.display = "inline";
          }
        }
      }

      function saveAnswers(pageIndex) {
        const radios = document.querySelectorAll('input[type="radio"]');
        const pageAnswers = {};

        radios.forEach((radio) => {
          if (radio.checked) {
            const questionId = radio.name;
            const answerValue = radio.value;
            pageAnswers[questionId] = answerValue;
          }
        });

        answers[pageIndex] = pageAnswers;
        localStorage.setItem("answers", JSON.stringify(answers));
      }

      function fillAnswers(pageIndex) {
        const pageAnswers = answers[pageIndex];

        if (pageAnswers) {
          Object.keys(pageAnswers).forEach((questionId) => {
            const answerValue = pageAnswers[questionId];
            const radio = document.querySelector(`input[name="${questionId}"][value="${answerValue}"]`);
            if (radio) {
              radio.checked = true;
            }
          });
        }
      }

      // ...
      function getAnswers() {
          saveAnswers(pages.length - 1);

          // Combine todas as respostas em um único objeto
          const allAnswers = {};
          for (const key in answers) {
              Object.assign(allAnswers, answers[key]);
          }

          // Enviar as respostas para o arquivo PHP usando uma solicitação POST
          const xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function () {
              if (this.readyState === 4 && this.status === 200) {
                  // Aqui você pode lidar com a resposta do servidor, se necessário.
                  console.log(this.responseText);
                  // Redirecionar após o envio bem-sucedido
                  window.location.href = "savequest.php";
              }
          };
          xhttp.open("POST", "processa_perguntas.php", true);
          xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

          // Converter as respostas em uma string JSON e enviá-las
          const data = JSON.stringify(allAnswers);
          xhttp.send("data=" + data);
      }



      function resetAnswers() {
        localStorage.clear();
        location.reload();
      }

      loadPage(currentPage);
      document.getElementById("prevPage").disabled = true;
    </script>
  </body>
</html>
