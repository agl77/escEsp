<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ordenar Especialidades</title>
    <meta charset="UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>

        @media (min-width: 1120px) and (max-width: 1499px) {
            .container {
                display: flex;
                justify-content: space-between;
                margin: 0 10%;
            }
        }

        @media (min-width: 1500px) {
            .container {
                margin: 0 15%;
            }
        }

        .container {
            display: flex;
            justify-content: space-between;
            min-width: 900px;
        }


        .especialidades {
            width: auto;
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
        .umacinco {
           margin: 4px;
           border: 0px; 
           line-height: 13px;

        }
        div {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
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
            <div class="original" draggable="true" columnId="original">Acupuntura</div>
            <div class="original" draggable="true" columnId="original">Alergia e Imunologia</div>
            <div class="original" draggable="true" columnId="original">Anestesiologia</div>
            <div class="original" draggable="true" columnId="original">Angiologia</div>
            <div class="original" draggable="true" columnId="original">Cardiologia</div>
            <div class="original" draggable="true" columnId="original">Cirurgia Cardíaca</div>
            <div class="original" draggable="true" columnId="original">Cirurgia da Mão</div>
            <div class="original" draggable="true" columnId="original">Cirurgia de Cabeça e Pescoço</div>
            <div class="original" draggable="true" columnId="original">Cirurgia do Aparelho Digestivo</div>
            <div class="original" draggable="true" columnId="original">Cirurgia Geral</div>
            <div class="original" draggable="true" columnId="original">Cirurgia Oncológica</div>
            <div class="original" draggable="true" columnId="original">Cirurgia Pediátrica</div>
            <div class="original" draggable="true" columnId="original">Cirurgia Plástica</div>
            <div class="original" draggable="true" columnId="original">Cirurgia Torácica</div>
            <div class="original" draggable="true" columnId="original">Cirurgia Vascular</div>
            <div class="original" draggable="true" columnId="original">Clínica Médica</div>
            <div class="original" draggable="true" columnId="original">Coloproctologia</div>
            <div class="original" draggable="true" columnId="original">Dermatologia</div>
            <div class="original" draggable="true" columnId="original">Endocrinologia</div>
            <div class="original" draggable="true" columnId="original">Endoscopia</div>
            <div class="original" draggable="true" columnId="original">Fisiatria e Reabilitação</div>
            <div class="original" draggable="true" columnId="original">Gastroenterologia</div>
            <div class="original" draggable="true" columnId="original">Genética</div>
            <div class="original" draggable="true" columnId="original">Geriatria</div>
            <div class="original" draggable="true" columnId="original">Ginecologia e Obstetrícia</div>
            <div class="original" draggable="true" columnId="original">Hematologia</div>
            <div class="original" draggable="true" columnId="original">Homeopatia</div>
            <div class="original" draggable="true" columnId="original">Infectologia</div>
            <div class="original" draggable="true" columnId="original">Medicina da Família e Comunidade</div>
            <div class="original" draggable="true" columnId="original">Medicina de Emergência</div>
            <div class="original" draggable="true" columnId="original">Medicina do Trabalho</div>
            <div class="original" draggable="true" columnId="original">Medicina do Tráfego</div>
            <div class="original" draggable="true" columnId="original">Medicina Esportiva</div>
            <div class="original" draggable="true" columnId="original">Medicina Intensiva</div>
            <div class="original" draggable="true" columnId="original">Medicina Legal e Perícia</div>
            <div class="original" draggable="true" columnId="original">Medicina Nuclear</div>
            <div class="original" draggable="true" columnId="original">Medicina Preventiva</div>
            <div class="original" draggable="true" columnId="original">Nefrologia</div>
            <div class="original" draggable="true" columnId="original">Neurocirurgia</div>
            <div class="original" draggable="true" columnId="original">Neurologia</div>
            <div class="original" draggable="true" columnId="original">Nutrologia</div>
            <div class="original" draggable="true" columnId="original">Oftalmologia</div>
            <div class="original" draggable="true" columnId="original">Oncologia Clínica</div>
            <div class="original" draggable="true" columnId="original">Ortopedia</div>
            <div class="original" draggable="true" columnId="original">Otorrinolaringologia</div>
            <div class="original" draggable="true" columnId="original">Patologia Clínica</div>
            <div class="original" draggable="true" columnId="original">Patologia</div>
            <div class="original" draggable="true" columnId="original">Pediatria</div>
            <div class="original" draggable="true" columnId="original">Pneumologia</div>
            <div class="original" draggable="true" columnId="original">Psiquiatria</div>
            <div class="original" draggable="true" columnId="original">Radiologia e Imagem</div>
            <div class="original" draggable="true" columnId="original">Radioterapia</div>
            <div class="original" draggable="true" columnId="original">Reumatologia</div>
            <div class="original" draggable="true" columnId="original">Urologia</div>

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
            location.href = "valores.php";
        };



        // Chama a função inicialmente e sempre que houver alterações nas colunas
        checkEspecialidades();

        [moreLiked, lessLiked].forEach(caixa => {
            caixa.addEventListener('drop', () => {
                checkEspecialidades();0
            });
        });


    </script>
</body>
</html>