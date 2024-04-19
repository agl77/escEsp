<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenar Especialidades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* Estilos comuns mantidos aqui */
        .container {
            display: flex;
            min-width: 900px;
        }
        .especialidades {
            width: 33.33%; /* Alterado para dividir igualmente em 3 colunas */
            border: 1px solid #ccc;
            padding: 10px;
        }
        .mais-identifica {
            background-color: #ffffc3; /* Amarelo Claro */
            text-align: left;
        }
        .menos-identifica {
            background-color: #fced98; /* Alaranjado Claro */
        }
        .original, .liked, .disliked {
            cursor: pointer;
            margin: 5px;
            padding: 5px;
            border: 1px solid #333;
            background-color: #f9f9f9;
        }
        div {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Estilos específicos para dispositivos móveis */
        @media (max-width: 767px) {
            .container {
                flex-wrap: wrap;
            }
            .especialidades {
                width: 33%; /* Alterado para ocupar toda a largura em dispositivos móveis */
                margin-bottom: 10px; /* Espaçamento entre as colunas */
            }
        }
    </style>
</head>
<body>
    <h1>Escolha de Especialidades</h1>
    <p> Arraste da coluna da esquerda para a coluna do meio, de maneira que fiquem ordenadas as 5 especialidades que mais se identifica e para a coluna da direita as 5 que menos se identifica.</p>
    <button id="enviarEspecialidades" disabled>Próxima página</button>
    
    <div class="container">
        <div class="especialidades lista-principal" columnId="original">
            <h2>Especialidades</h2>
            <div id="Acupuntura" class="item" draggable="true" ondragstart="drag(event)">Acupuntura</div>
            <div id="Alergia e Imunologia" class="item" draggable="true" ondragstart="drag(event)">Alergia e Imunologia</div>
            <div id="Anestesiologia" class="item" draggable="true" ondragstart="drag(event)">Anestesiologia</div>
            <div id="Angiologia" class="item" draggable="true" ondragstart="drag(event)">Angiologia</div>
            <div id="Cardiologia" class="item" draggable="true" ondragstart="drag(event)">Cardiologia</div>
            <div id="Cirurgia Cardíaca" class="item" draggable="true" ondragstart="drag(event)">Cirurgia Cardíaca</div>
            <div id="Cirurgia da Mão" class="item" draggable="true" ondragstart="drag(event)">Cirurgia da Mão</div>
            <div id="Cirurgia de Cabeça e Pescoço" class="item" draggable="true" ondragstart="drag(event)">Cirurgia de Cabeça e Pescoço</div>
            <div id="Cirurgia do Aparelho Digestivo" class="item" draggable="true" ondragstart="drag(event)">Cirurgia do Aparelho Digestivo</div>
            <div id="Cirurgia Geral" class="item" draggable="true" ondragstart="drag(event)">Cirurgia Geral</div>
            <div id="Cirurgia Oncológica" class="item" draggable="true" ondragstart="drag(event)">Cirurgia Oncológica</div>
            <div id="Cirurgia Pediátrica" class="item" draggable="true" ondragstart="drag(event)">Cirurgia Pediátrica</div>
            <div id="Cirurgia Plástica" class="item" draggable="true" ondragstart="drag(event)">Cirurgia Plástica</div>
            <div id="Cirurgia Torácica" class="item" draggable="true" ondragstart="drag(event)">Cirurgia Torácica</div>
            <div id="Cirurgia Vascular" class="item" draggable="true" ondragstart="drag(event)">Cirurgia Vascular</div>
            <div id="Clínica Médica" class="item" draggable="true" ondragstart="drag(event)">Clínica Médica</div>
            <div id="Coloproctologia" class="item" draggable="true" ondragstart="drag(event)">Coloproctologia</div>
            <div id="Dermatologia" class="item" draggable="true" ondragstart="drag(event)">Dermatologia</div>
            <div id="Endocrinologia" class="item" draggable="true" ondragstart="drag(event)">Endocrinologia</div>
            <div id="Endoscopia" class="item" draggable="true" ondragstart="drag(event)">Endoscopia</div>
            <div id="Fisiatria e Reabilitação" class="item" draggable="true" ondragstart="drag(event)">Fisiatria e Reabilitação</div>
            <div id="Gastroenterologia" class="item" draggable="true" ondragstart="drag(event)">Gastroenterologia</div>
            <div id="Genética" class="item" draggable="true" ondragstart="drag(event)">Genética</div>
            <div id="Geriatria" class="item" draggable="true" ondragstart="drag(event)">Geriatria</div>
            <div id="Ginecologia e Obstetrícia" class="item" draggable="true" ondragstart="drag(event)">Ginecologia e Obstetrícia</div>
            <div id="Hematologia" class="item" draggable="true" ondragstart="drag(event)">Hematologia</div>
            <div id="Homeopatia" class="item" draggable="true" ondragstart="drag(event)">Homeopatia</div>
            <div id="Infectologia" class="item" draggable="true" ondragstart="drag(event)">Infectologia</div>
            <div id="Medicina da Família e Comunidade" class="item" draggable="true" ondragstart="drag(event)">Medicina da Família e Comunidade</div>
            <div id="Medicina de Emergência" class="item" draggable="true" ondragstart="drag(event)">Medicina de Emergência</div>
            <div id="Medicina do Trabalho" class="item" draggable="true" ondragstart="drag(event)">Medicina do Trabalho</div>
            <div id="Medicina do Tráfego" class="item" draggable="true" ondragstart="drag(event)">Medicina do Tráfego</div>
            <div id="Medicina Esportiva" class="item" draggable="true" ondragstart="drag(event)">Medicina Esportiva</div>
            <div id="Medicina Intensiva" class="item" draggable="true" ondragstart="drag(event)">Medicina Intensiva</div>
            <div id="Medicina Legal e Perícia" class="item" draggable="true" ondragstart="drag(event)">Medicina Legal e Perícia</div>
            <div id="Medicina Nuclear" class="item" draggable="true" ondragstart="drag(event)">Medicina Nuclear</div>
            <div id="Medicina Preventiva" class="item" draggable="true" ondragstart="drag(event)">Medicina Preventiva</div>
            <div id="Nefrologia" class="item" draggable="true" ondragstart="drag(event)">Nefrologia</div>
            <div id="Neurocirurgia" class="item" draggable="true" ondragstart="drag(event)">Neurocirurgia</div>
            <div id="Neurologia" class="item" draggable="true" ondragstart="drag(event)">Neurologia</div>
            <div id="Nutrologia" class="item" draggable="true" ondragstart="drag(event)">Nutrologia</div>
            <div id="Oftalmologia" class="item" draggable="true" ondragstart="drag(event)">Oftalmologia</div>
            <div id="Oncologia Clínica" class="item" draggable="true" ondragstart="drag(event)">Oncologia Clínica</div>
            <div id="Ortopedia" class="item" draggable="true" ondragstart="drag(event)">Ortopedia</div>
            <div id="Otorrinolaringologia" class="item" draggable="true" ondragstart="drag(event)">Otorrinolaringologia</div>
            <div id="Patologia Clínica" class="item" draggable="true" ondragstart="drag(event)">Patologia Clínica</div>
            <div id="Patologia" class="item" draggable="true" ondragstart="drag(event)">Patologia</div>
            <div id="Pediatria" class="item" draggable="true" ondragstart="drag(event)">Pediatria</div>
            <div id="Pneumologia" class="item" draggable="true" ondragstart="drag(event)">Pneumologia</div>
            <div id="Psiquiatria" class="item" draggable="true" ondragstart="drag(event)">Psiquiatria</div>
            <div id="Radiologia e Imagem" class="item" draggable="true" ondragstart="drag(event)">Radiologia e Imagem</div>
            <div id="Radioterapia" class="item" draggable="true" ondragstart="drag(event)">Radioterapia</div>
            <div id="Reumatologia" class="item" draggable="true" ondragstart="drag(event)">Reumatologia</div>
            <div id="Urologia" class="item" draggable="true" ondragstart="drag(event)">Urologia</div>
        </div>
        <div class="especialidades mais-identifica" columnId="liked">
            <h2>Mais se Identifica</h2>
        </div>
        <div class="especialidades menos-identifica" columnId="disliked">
            <h2>Menos se Identifica</h2>
        </div>
    </div>

    <script>
        function getListFrom(list) {
            return document.querySelectorAll("." + list)
        }

        function cleanseString(str) {
            const newString = str.replace(/[0-9]/g, '');
            return newString.trim();
        }

        function findIndex(originalArr, targetDiv){
            for (let index = 0; index < originalArr.length; index++) {
                const targetText = cleanseString(targetDiv.textContent)
                const originalText = cleanseString(originalArr[index].textContent);

                if (originalText === targetText) return index;
            }
        }

        function delegateDragAndDrop(parent, columnId) {
            parent.addEventListener('dragstart', (e) => {
                const listArr = getListFrom(columnId);

                e.dataTransfer.setData('index', findIndex(listArr, e.target))
                e.dataTransfer.setData('columnId', e.target.getAttribute('columnId'));
                e.dataTransfer.setData('text/plain', e.target.textContent);
            })

            parent.addEventListener('touchstart', (e) => {
                const listArr = getListFrom(columnId);
                const target = e.target;
                const index = findIndex(listArr, target);

                e.dataTransfer.setData('index', index);
                e.dataTransfer.setData('columnId', target.getAttribute('columnId'));
                e.dataTransfer.setData('text/plain', target.textContent);
            })
        }

        const moreLiked = document.querySelector('.mais-identifica');
        const lessLiked = document.querySelector('.menos-identifica');
        const originalList = document.querySelector('.lista-principal');

        delegateDragAndDrop(moreLiked, moreLiked.getAttribute('columnId'));
        delegateDragAndDrop(lessLiked, lessLiked.getAttribute('columnId'));
        delegateDragAndDrop(originalList, originalList.getAttribute('columnId'));

        function reorder(list) {
            for (let i = 0, j = 1; i < list.length; i++, j++) {
                const text = list[i].textContent;
                const newText = text.replace(/[0-9]/g, '');
                list[i].textContent = ([j] + " " + newText);
            }
        }

        [moreLiked, lessLiked, originalList].forEach(caixa => {
            caixa.addEventListener('dragover', (e) => {
                e.preventDefault();
            });

            caixa.addEventListener('drop', (e) => {
                e.preventDefault();
                const name = cleanseString(e.dataTransfer.getData('text/plain'));
                const origin = e.dataTransfer.getData('columnId');
                const index = e.dataTransfer.getData('index');
                const destination = caixa.getAttribute('columnId');

                if (origin === destination) return;

                if (caixa.children.length < 6 || destination === "original") {
                    const htmlTemplate = `
                        <div class="${destination}" draggable="true" columnid="${destination}">
                            ${name}
                        </div>
                        `;
                    caixa.innerHTML += htmlTemplate;

                    getListFrom(origin)[index].remove();
                }

                reorder(getListFrom(origin));
                reorder(getListFrom(destination));
            });
        });

        // Função para verificar o número de especialidades nas colunas "Mais se Identifica" e "Menos se Identifica"
        function checkEspecialidades() {
            const maisIdentificaCount = getListFrom('liked').length;
            const menosIdentificaCount = getListFrom('disliked').length;
            
            if (maisIdentificaCount === 5 && menosIdentificaCount === 5) {
                document.getElementById('enviarEspecialidades').removeAttribute('disabled');
            } else {
                document.getElementById('enviarEspecialidades').setAttribute('disabled', 'true');
            }
        }

        document.getElementById("enviarEspecialidades").onclick = function () {
            saveAnswers();
            location.href = "valores.html";
        };

        // Chama a função inicialmente e sempre que houver alterações nas colunas
        checkEspecialidades();

        [moreLiked, lessLiked].forEach(caixa => {
            caixa.addEventListener('drop', () => {
                checkEspecialidades();
            });
        });

        function saveAnswers() {
            const likedEspecialidades = getListFrom('liked');
            const dislikedEspecialidades = getListFrom('disliked');

            const answers = {
                liked: [],
                disliked: []
            };

            // Preencha as respostas para as especialidades "Mais se Identifica"
            likedEspecialidades.forEach(especialidade => {
                answers.liked.push(especialidade.textContent.trim());
            });

            // Preencha as respostas para as especialidades "Menos se Identifica"
            dislikedEspecialidades.forEach(especialidade => {
                answers.disliked.push(especialidade.textContent.trim());
            });

            // Salve as respostas no localStorage
            localStorage.setItem('especialidades', JSON.stringify(answers));
        }
    </script>
</body>
</html>
