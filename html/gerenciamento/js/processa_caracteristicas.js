// Função para verificar se a personalidade corresponde à especialidade
function verificarPersonalidadeEspecialidade(personalidadeString, especialidadePersonalidades) {
    const personalidadeArray = personalidadeString.split(" ");
    for (const personalidadeItem of personalidadeArray) {
        if (especialidadePersonalidades.includes(personalidadeItem)) {
            return true;
        }
    }
    return false;
}

// Função para verificar se os interesses profissionais correspondem
function verificarInteressesProfissionais(interessesEspecialidade, caracteristicasPrevalentes) {
    let totalPontuacao = 0;

    caracteristicasPrevalentes.forEach(caracteristicaPrevalente => {
        if (interessesEspecialidade.includes(caracteristicaPrevalente.caracteristica)) {
            totalPontuacao += caracteristicaPrevalente.percentual;
        }
    });

    return totalPontuacao >= 100; // Ajuste o valor conforme a necessidade para determinar a pontuação mínima
}

function processarEspecialidades() {
    const caracteristicasPrevalentes = JSON.parse(localStorage.getItem('caracteristicasPrevalentes'));
    let personalidadeString = localStorage.getItem("personalidade"); // Get 'personalidade' as a string

    if (!caracteristicasPrevalentes) {
        console.error("Dados de características prevalentes não presentes");
        return;
    }

    if (!personalidadeString) {
        console.error("Dados de personalidade não encontrados.");
        return;
    }

    const especialidadesProvaveis = [];

    for (const especialidade in dadosEspecialidades) {
        const especialidadeDados = dadosEspecialidades[especialidade];
        const especialidadePersonalidades = especialidadeDados["Personalidades"];
        const interessesProfissionais = especialidadeDados["Interesses Profissionais"];

        const personalidadeMatch = verificarPersonalidadeEspecialidade(personalidadeString, especialidadePersonalidades);
        const interessesMatch = verificarInteressesProfissionais(interessesProfissionais, caracteristicasPrevalentes);

        if (personalidadeMatch && interessesMatch) {
            especialidadesProvaveis.push(especialidade);
        }
    }

    localStorage.setItem("especialidadesprovaveis", JSON.stringify(especialidadesProvaveis));
    console.log("Especialidades prováveis:", especialidadesProvaveis);
}
  // Objeto contendo dados de cada especialidade (personalidades e interesses profissionais)
  const dadosEspecialidades = {
      "ACUPUNTURA": {
        "Personalidades": ["I St In", "I St Ss", "I In St"],
        "Interesses Profissionais": ["Comportamental/Educacional", "Manual/Artístico", "Simbólico/Linguístico"]
      },
      "ALERGO-IMUNOLOGIA": {
        "Personalidades": ["I St In", "I Ss Ps", "I In St", "I In Ps", "E St Ss", "E Ps Ss"],
        "Interesses Profissionais": ["Comportamental/Educacional", "Cálculo/Finanças", "Organizacional/Administrativo"]
      },
      "ANESTESIOLOGIA": {
        "Personalidades": ["I Ss Ps", "I Ps Ss", "I Ps In"],
        "Interesses Profissionais": ["Cálculo/Finanças", "Organizacional/Administrativo", "Comportamental/Educacional"]
      },
      "ANGIOLOGIA": {
        "Personalidades": ["I Ss Ps", "I In Ps", "E Ss Ps", "E Ss St", "E In Ps"],
        "Interesses Profissionais": ["Cálculo/Finanças", "Manual/Artístico", "Comportamental/Educacional"]
      },
      "CARDIOLOGIA": {
        "Personalidades": ["I Ss Ps", "I Ps Ss", "I In Ps", "E Ss Ps", "E Ss St", "E Ps In", "E In Ps"],
        "Interesses Profissionais": ["Cálculo/Finanças", "Manual/Artístico", "Comportamental/Educacional"]
      },
      "CIRURGIA CARDIOVASCULAR": {
        "Personalidades": ["I Ss Ps", "I Ps Ss", "I In Ps", "I Ps In"],
        "Interesses Profissionais": ["Manual/Artístico", "Cálculo/Finanças", "Organizacional/Administrativo", "Comportamental/Educacional"]
      },
      "CIRURGIA DE MÃO": {
        "Personalidades": ["I Ps Ss", "I In Ps", "I Ps In"],
        "Interesses Profissionais": ["Manual/Artístico", "Cálculo/Finanças", "Comportamental/Educacional"]
      },
      "CIRURGIA DE CABEÇA E PESCOÇO": {
        "Personalidades": ["I Ss Ps", "I In Ps", "I Ps In", "E In Ps"],
        "Interesses Profissionais": ["Manual/Artístico", "Cálculo/Finanças", "Comportamental/Educacional"]
      },
      "CIRURGIA DO APARELHO DIGESTIVO": {
        "Personalidades": ["I Ss Ps", "E Ss Ps", "E Ss St", "E Ps Ss"],
        "Interesses Profissionais": ["Manual/Artístico", "Cálculo/Finanças", "Comportamental/Educacional"]
      },
      "CIRURGIA GERAL": {
        "Personalidades": ["I In Ps", "E Ss Ps", "E Ss St", "E In St", "E Ps Ss"],
        "Interesses Profissionais": ["Manual/Artístico", "Cálculo/Finanças", "Comportamental/Educacional"]
      },
      "CIRURGIA ONCOLÓGICA": {
        "Personalidades": ["I Ss Ps", "I In Ps", "I Ps In", "E Ps In", "E In Ps", "E Ps Ss"],
        "Interesses Profissionais": ["Manual/Artístico", "Cálculo/Finanças", "Comportamental/Educacional"]
      },
      "CIRURGIA PEDIÁTRICA": {
        "Personalidades": ["E Ss Ps", "E St Ss", "E Ss St", "E St In", "E In St"],
        "Interesses Profissionais": ["Manual/Artístico", "Comportamental/Educacional", "Cálculo/Finanças"]
      },
      "CIRURGIA PLÁSTICA": {
        "Personalidades": ["I In Ps", "E Ss Ps", "E Ps In", "E In Ps"],
        "Interesses Profissionais": ["Manual/Artístico", "Comportamental/Educacional", "Cálculo/Finanças"]
      },
      "CIRURGIA TORÁCICA": {
        "Personalidades": ["I Ss St", "I Ss Ps", "I In Ps", "E In Ps"],
        "Interesses Profissionais": ["Manual/Artístico", "Cálculo/Finanças", "Comportamental/Educacional"]
      },
      "CIRURGIA VASCULAR": {
        "Personalidades": ["E Ss Ps", "E Ps In", "E In Ps", "E Ps Ss"],
        "Interesses Profissionais": ["Manual/Artístico", "Cálculo/Finanças", "Comportamental/Educacional"]
      },
      "CLÍNICA MÉDICA": {
        "Personalidades": ["I St In", "I St Ss", "I Ps Ss", "I In St", "E St Ss", "E St In", "E Ps In"],
        "Interesses Profissionais": ["Comportamental/Educacional", "Cálculo/Finanças", "Jurídico/Social"]
      },
      "COLOPROCTOLOGIA": {
        "Personalidades": ["I Ss Ps", "I In Ps", "E Ss Ps", "E Ps Ss"],
        "Interesses Profissionais": ["Manual/Artístico", "Cálculo/Finanças", "Comportamental/Educacional"]
      },
      "DERMATOLOGIA": {
        "Personalidades": ["I Ss St", "I St Ss", "I In St", "I Ps In", "E St In", "E Ps Ss"],
        "Interesses Profissionais": ["Manual/Artístico", "Comportamental/Educacional", "Cálculo/Finanças"]
      },
      "ENDOCRINOLOGIA E METABOLOGIA": {
        "Personalidades": ["I Ss St", "I Ps Ss", "I Ps In", "E St Ss", "E St In"],
        "Interesses Profissionais": ["Cálculo/Finanças", "Comportamental/Educacional", "Organizacional/Administrativo"]
      },
      "ENDOSCOPIA": {
        "Personalidades": ["I Ps Ss", "I In St", "I In Ps", "I Ps In"],
        "Interesses Profissionais": ["Manual/Artístico", "Cálculo/Finanças", "Comportamental/Educacional"]
      },
      "GASTROENTEROLOGIA": {
        "Personalidades": ["I St Ss", "I Ps Ss", "I In Ps", "E Ss Ps", "E St Ss", "E Ss St", "E Ps In", "E Ps Ss"],
        "Interesses Profissionais": ["Cálculo/Finanças", "Comportamental/Educacional", "Manual/Artístico"]
      },
      "GENÉTICA MÉDICA": {
        "Personalidades": ["I Ss St", "I St In", "I St Ss", "I In St", "I In Ps", "I Ps In"],
        "Interesses Profissionais": ["Cálculo/Finanças", "Comportamental/Educacional", "Simbólico/Linguístico"]
      },
      "GERIATRIA": {
        "Personalidades": ["E St Ss", "E Ss St", "E St In", "E In St"],
        "Interesses Profissionais": ["Comportamental/Educacional", "Organizacional/Administrativo", "Comunicação/Persuasão"]
      },
      "GINECOLOGIA E OBSTETRÍCIA": {
        "Personalidades": ["E St Ss", "E Ss St", "E St In", "E In St"],
        "Interesses Profissionais": ["Manual/Artístico", "Comportamental/Educacional", "Comunicação/Persuasão"]
      },
      "HEMATOLOGIA E HEMOTERAPIA": {
        "Personalidades": ["I Ss St", "I Ss Ps", "I Ps Ss", "I Ps In"],
        "Interesses Profissionais": ["Cálculo/Finanças", "Comportamental/Educacional", "Comunicação/Persuasão"]
      },
      "HOMEOPATIA": {
        "Personalidades": ["I St In", "I St Ss", "I In St"],
        "Interesses Profissionais": ["Comportamental/Educacional", "Comunicação/Persuasão", "Simbólico/Linguístico"]
      },
      "INFECTOLOGIA": {
        "Personalidades": ["I Ss Ps", "I Ps Ss", "I Ps In", "E St Ss", "E Ps In"],
        "Interesses Profissionais": ["Cálculo/Finanças", "Comportamental/Educacional", "Comunicação/Persuasão"]
      },
      "MASTOLOGIA": {
        "Personalidades": ["I Ss St", "I Ss Ps", "I Ps Ss", "I Ps In", "E St Ss", "E St In"],
        "Interesses Profissionais": ["Manual/Artístico", "Comportamental/Educacional", "Comunicação/Persuasão"]
      },
      "MEDICINA DE EMERGÊNCIA": {
        "Personalidades": ["E Ss Ps", "E Ps In", "E In Ps", "E Ps Ss"],
        "Interesses Profissionais": ["Cálculo/Finanças", "Comportamental/Educacional", "Comunicação/Persuasão"]
      },
      "MEDICINA DE FAMÍLIA E COMUNIDADE": {
        "Personalidades": ["I St In", "I St Ss", "I In St", "E St Ss", "E Ss St", "E St In"],
        "Interesses Profissionais": ["Comportamental/Educacional", "Comunicação/Persuasão", "Jurídico/Social"]
      },
      "MEDICINA DO TRABALHO": {
        "Personalidades": ["I Ss Ps", "E Ps In", "E In Ps", "E Ps Ss"],
        "Interesses Profissionais": ["Organizacional/Administrativo", "Comportamental/Educacional", "Jurídico/Social"]
      },
      "MEDICINA DO TRÁFEGO": {
        "Personalidades": ["E Ss Ps", "E Ps In", "E Ps Ss"],
        "Interesses Profissionais": ["Organizacional/Administrativo", "Comportamental/Educacional", "Jurídico/Social"]
      },
      "MEDICINA ESPORTIVA": {
        "Personalidades": ["E Ss Ps", "E Ps In", "E Ps Ss"],
        "Interesses Profissionais": ["Físico/Químico", "Comportamental/Educacional", "Comunicação/Persuasão"]
      },
      "MEDICINA FÍSICA E DE REABILITAÇÃO": {
        "Personalidades": ["I St In", "I St Ss", "I In St", "E St Ss", "E St In"],
        "Interesses Profissionais": ["Comportamental/Educacional", "Físico/Químico", "Comunicação/Persuasão"]
      },
      "MEDICINA INTENSIVA": {
        "Personalidades": ["I In Ps", "E Ss Ps", "E Ps In", "E In Ps", "E Ps Ss"],
        "Interesses Profissionais": ["Organizacional/Administrativo", "Comportamental/Educacional", "Comunicação/Persuasão"]
      },
      "MEDICINA LEGAL E PERÍCIA": {
        "Personalidades": ["I Ss Ps", "I Ps Ss", "I In Ps", "I Ps In"],
        "Interesses Profissionais": ["Jurídico/Social", "Comportamental/Educacional", "Comunicação/Persuasão"]
      },
      "MEDICINA NUCLEAR": {
        "Personalidades": ["I Ss Ps", "I Ps In", "E Ps In", "E In Ps"],
        "Interesses Profissionais": ["Físico/Químico", "Comunicação/Persuasão", "Organizacional/Administrativo"]
      },
      "MEDICINA PREVENTIVA E SOCIAL": {
        "Personalidades": ["I St In", "I St Ss", "I In St", "E St In", "E In St", "E Ps Ss"],
        "Interesses Profissionais": ["Jurídico/Social", "Comportamental/Educacional", "Organizacional/Administrativo"]
      },
      "NEFROLOGIA": {
        "Personalidades": ["I Ss Ps", "I Ps Ss", "I Ps In", "E Ps In", "E Ps Ss"],
        "Interesses Profissionais": ["Físico/Químico", "Comunicação/Persuasão", "Comportamental/Educacional"]
      },
      "NEUROCIRURGIA": {
        "Personalidades": ["E Ps In", "E In Ps", "E Ps Ss"],
        "Interesses Profissionais": ["Físico/Químico", "Manual/Artístico", "Comunicação/Persuasão"]
      },
      "NEUROLOGIA": {
        "Personalidades": [],
        "Interesses Profissionais": ["Físico/Químico", "Comportamental/Educacional", "Comunicação/Persuasão"]
      },
      "NUTROLOGIA": {
        "Personalidades": ["I Ss Ps", "I Ps Ss", "I In Ps", "I Ps In", "E Ps In", "E Ps Ss"],
        "Interesses Profissionais": ["Físico/Químico", "Comportamental/Educacional", "Comunicação/Persuasão"]
      },
      "OFTALMOLOGIA": {
        "Personalidades": ["I Ps Ss", "I Ps In", "E Ps In", "E Ps Ss"],
        "Interesses Profissionais": ["Físico/Químico", "Manual/Artístico", "Comunicação/Persuasão"]
      },
      "ONCOLOGIA CLÍNICA": {
        "Personalidades": ["E St In", "E Ps In", "E In St"],
        "Interesses Profissionais": ["Físico/Químico", "Comportamental/Educacional", "Comunicação/Persuasão"]
      },
      "ORTOPEDIA": {
        "Personalidades": ["E Ss Ps", "E Ps In", "E Ps Ss"],
        "Interesses Profissionais": ["Físico/Químico", "Manual/Artístico", "Comportamental/Educacional", "Comunicação/Persuasão"]
      },
      "OTORRINOLARINGOLOGIA": {
        "Personalidades": ["E Ss Ps", "E Ps In", "E In Ps", "E Ps Ss"],
        "Interesses Profissionais": ["Físico/Químico", "Manual/Artístico", "Comportamental/Educacional", "Comunicação/Persuasão"]
      },
      "PATOLOGIA/ PATOLOGIA CLÍNICA E MEDICINA LABORATORIAL": {
        "Personalidades": ["I Ss Ps", "I Ps Ss", "I In Ps", "I Ps In"],
        "Interesses Profissionais": ["Físico/Químico", "Cálculo/Finanças", "Comportamental/Educacional", "Comunicação/Persuasão"]
      },
      "PEDIATRIA": {
        "Personalidades": ["E St Ss", "E Ss St", "E St In", "E In St"],
        "Interesses Profissionais": ["Comportamental/Educacional", "Comunicação/Persuasão", "Manual/Artístico", "Organizacional/Administrativo"]
      },
      "PNEUMOLOGIA": {
        "Personalidades": ["I Ss Ps", "I Ps Ss", "I In Ps", "I Ps In", "E Ss Ps", "E Ps In", "E In Ps", "E Ps Ss"],
        "Interesses Profissionais": ["Físico/Químico", "Comportamental/Educacional", "Comunicação/Persuasão", "Cálculo/Finanças"]
      },
      "PSIQUIATRIA": {
        "Personalidades": ["I Ss St", "I St In", "I St Ss", "I In St", "E St Ss", "E St In"],
        "Interesses Profissionais": ["Comportamental/Educacional", "Comunicação/Persuasão", "Simbólico/Linguístico", "Organizacional/Administrativo"]
      },
      "RADIOLOGIA E DIAGNÓSTICO POR IMAGEM": {
        "Personalidades": ["I Ss Ps", "I Ps Ss", "I In Ps", "I Ps In"],
        "Interesses Profissionais": ["Físico/Químico", "Cálculo/Finanças", "Comunicação/Persuasão", "Organizacional/Administrativo"]
      },
      "RADIOTERAPIA": {
        "Personalidades": ["E Ss Ps", "E Ps In", "E In Ps", "E Ps Ss"],
        "Interesses Profissionais": ["Físico/Químico", "Cálculo/Finanças", "Comunicação/Persuasão", "Organizacional/Administrativo"]
      },
      "REUMATOLOGIA": {
        "Personalidades": ["I Ss Ps", "I Ps Ss", "I In Ps", "I Ps In"],
        "Interesses Profissionais": ["Comportamental/Educacional", "Comunicação/Persuasão", "Organizacional/Administrativo"]
      },
      "UROLOGIA": {
        "Personalidades": ["E Ss Ps", "E Ps In", "E In Ps", "E Ps Ss"],
        "Interesses Profissionais": ["Físico/Químico", "Manual/Artístico", "Comunicação/Persuasão"]
      }
  };
  
  // Executar a função principal
 // processarEspecialidades();