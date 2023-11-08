<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Questionário Vocacional de Especialidade Médica</title>
    <!-- Inclua os links para os arquivos CSS e JavaScript do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="range-script.js"></script>

  </head>
  <body>
    <div class="container">
      <h1>Questionário Vocacional de Especialidade Médica</h1>
      <p><b>Responda as perguntas a seguir numa escala de “0” a “10”, sendo que “0” significa NUNCA,    “10” significa SEMPRE e “5” significa NEUTRO</b></p>
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
      const pages = ["range1.html", "range2.html", "range3.html", "range4.html", "range5.html", "range6.html"];
      let currentPage = 0;
      let answers = JSON.parse(localStorage.getItem("answers")) || {};
      let allAnswers = {};

      const sendButton = document.getElementById("sendForm");
      sendButton.style.display = "none";


      function loadPage(pageIndex) {
        return new Promise((resolve, reject) => {
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("pageContent").innerHTML = this.responseText;
                    fillAnswers(pageIndex);
                    resolve();
                }
            };
            xhttp.open("GET", pages[pageIndex], true);
            xhttp.send();
        });
      }

      async function renderPage(pageIndex) {
          try {
              await loadPage(pageIndex);
              
              const values = document.getElementsByTagName("span");
              const inputs = document.getElementsByTagName("input");
              for (let i = 0; i < values.length; i++) {
                inputs[i].addEventListener("input", (event) => {
                    values[i].textContent = event.target.value;
                });
              }
            } catch (error) {
              console.error(error);
            }
            
            if (localStorage.getItem("answers")) {
              const allAnswers = JSON.parse(localStorage.getItem("answers"));
              const answers = allAnswers[currentPage];

              for (const key in answers) {
                const slider = document.getElementById(key);
                const span = slider.nextElementSibling;
                slider.value = answers[key];
                span.textContent = slider.value;
              }
            } else {
              console.log("There is nothing saved on local storage");
            }
      }

      function previousPage() {
        if (currentPage > 0) {
          saveAnswers(currentPage);
          currentPage--;
          renderPage(currentPage);
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
          renderPage(currentPage);
          document.getElementById("prevPage").disabled = false;
          if (currentPage === pages.length - 1) {
            document.getElementById("nextPage").disabled = true;
            sendButton.style.display = "inline";
          }
        }
      }

      function saveAnswers(pageIndex) {
        const ranges = document.querySelectorAll('input[type="range"]');
        
        const pageAnswers = {};

        ranges.forEach((range) => {
            const question = range.name;
            const value = range.value;
            pageAnswers[question] = value;
        });

        answers[pageIndex] = pageAnswers;
        localStorage.setItem("answers", JSON.stringify(answers));
        }
      function fillAnswers() {
        for (const key in answers) {
            const pageAnswers = answers[key];
            if (pageAnswers) {
            Object.keys(pageAnswers).forEach((questionId) => {
                const answerValue = pageAnswers[questionId];
                const range = document.querySelector(`input[name="${questionId}"][value="${answerValue}"]`);
                if (range) {
                range.value = answerValue;
                const valueSpan = document.getElementById(`value${questionId}`);
                if (valueSpan) {
                    valueSpan.textContent = answerValue;
                }
                }
            });
            }
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
          xhttp.open("POST", "savequest.php", true);
          xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

          // Converter as respostas em uma string JSON e enviá-las
          const data = JSON.stringify(allAnswers);
          xhttp.send("data=" + data);
      }

      function resetAnswers() {
        localStorage.clear();
        location.reload();
      }

      
      renderPage(currentPage);
      document.getElementById("prevPage").disabled = true;
    </script>
  </body>
</html>
