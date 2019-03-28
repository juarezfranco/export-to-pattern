# Export to Pattern

Utilitário para exportar dados para um arquivo à partir de um layout/padrão específico.

### Requisitos

    PHP >= 5.3.0

### Instalar

    composer require juarezfranco/export-to-pattern

### Como utilizar

Exemplo de definição do [layout](https://github.com/juarezfranco/export-to-pattern/blob/master/layout-exemplo.pdf)

````
    $layout = [
        0   => ['nome' => 'NU_LOTE',            'tamanho' => 8,     'preenchimento' => '0'],
        1   => ['nome' => 'QT_LOTE',            'tamanho' => 3,     'preenchimento' => '0'],
        3   => ['nome' => 'APRES_LOTE',         'tamanho' => 6],
        4   => ['nome' => 'SEQ_LOTE',           'tamanho' => 3,     'preenchimento' => '0'],
        5   => ['nome' => 'ORG_EMIS_AIH',       'tamanho' => 10],
        6   => ['nome' => 'CNES_HOSP',          'tamanho' => 7],
        7   => ['nome' => 'MUN_HOSP',           'tamanho' => 6],
        8   => ['nome' => 'NU_AIH',             'tamanho' => 13],
        9   => ['nome' => 'IDENT_AIH',          'tamanho' => 2,     'validos' => ['01', '03', '05']],
        10  => ['nome' => 'ESPEC_AIH',          'tamanho' => 2],
        11  => ['nome' => 'FILLER',             'tamanho' => 45,    'preenchimento' => '0'],
        12  => ['nome' => 'MOD_INTERN',         'tamanho' => 2,     'preenchimento' => '0', 'validos' => ['02', '03', '04']],
        13  => ['nome' => 'SEQ_AIH5',           'tamanho' => 3,     'padrao' => '000'],
        14  => ['nome' => 'AIH_PROX',           'tamanho' => 13,    'padrao' => '0000000000000'],
        15  => ['nome' => 'AIH_ANT',            'tamanho' => 13,    'padrao' => '0000000000000'],
        16  => ['nome' => 'DT_EMISSAO',         'tamanho' => 8],
        17  => ['nome' => 'DT_INTERN',          'tamanho' => 8],
        18  => ['nome' => 'DT_SAIDA',           'tamanho' => 8],
        19  => ['nome' => 'PROC_SOLICITADO',    'tamanho' => 10],
        20  => ['nome' => 'ST_MUDAPROC',        'tamanho' => 1,     'validos' => ['1', '2']],
        21  => ['nome' => 'PROC_REALIZADO',     'tamanho' => 10],
        22  => ['nome' => 'CAR_INTERN',         'tamanho' => 2],
        23  => ['nome' => 'MOT_SAIDA',          'tamanho' => 2],
        24  => ['nome' => 'IDENT_MED_SOL',      'tamanho' => 1,     'validos' => ['1', '2']],
        25  => ['nome' => 'DOC_MED_SOL',        'tamanho' => 15,    'preenchimento' => ' ', 'str_pad_type' => STR_PAD_RIGHT],
        26  => ['nome' => 'IDENT_MED_RESPO',    'tamanho' => 1,     'validos' => ['1', '2']],
        27  => ['nome' => 'DOC_MED_RESP',       'tamanho' => 15,    'preenchimento' => ' ', 'str_pad_type' => STR_PAD_RIGHT],
        28  => ['nome' => 'IDENT_DIRCLINICO',   'tamanho' => 1,     'validos' => ['1', '2']],
        29  => ['nome' => 'DOC_DIRCLINICO',     'tamanho' => 15,    'preenchimento' => ' ', 'str_pad_type' => STR_PAD_RIGHT],
        30  => ['nome' => 'IDENT_AUTORIZ',      'tamanho' => 1,     'validos' => ['1', '2']],
        31  => ['nome' => 'DOC_AUTORIZ',        'tamanho' => 15],
        32  => ['nome' => 'DIAG_PRIN',          'tamanho' => 4],
        33  => ['nome' => 'FILLER',             'tamanho' => 4,     'preenchimento' => '0'],
        34  => ['nome' => 'FILLER',             'tamanho' => 4,     'preenchimento' => '0'],
        35  => ['nome' => 'FILLER',             'tamanho' => 4,     'preenchimento' => '0'],
        36  => ['nome' => 'FILLER',             'tamanho' => 3,     'preenchimento' => '0'],
        37  => ['nome' => 'NM_PACIENTE',        'tamanho' => 70,    'function' => 'remover_caracteres_especiais', 'str_pad_type' => STR_PAD_RIGHT],
        38  => ['nome' => 'DT_NASC_PAC',        'tamanho' => 8],
        39  => ['nome' => 'SEXO_PAC',           'tamanho' => 1],
        40  => ['nome' => 'RACA/COR',           'tamanho' => 2,     'validos' => ['01', '02', '03', '04', '05', '99'], 'padrao' => '99'],
        41  => ['nome' => 'NM_MAE_PAC',         'tamanho' => 70,    'function' => 'remover_caracteres_especiais', 'str_pad_type' => STR_PAD_RIGHT],
        42  => ['nome' => 'NM_RESP_PAC',        'tamanho' => 70,    'function' => 'remover_caracteres_especiais', 'str_pad_type' => STR_PAD_RIGHT],
        43  => ['nome' => 'TP_DOC_PAC',         'tamanho' => 1,     'validos' => ['1', '2', '3', '4', '5', '6']],
        44  => ['nome' => 'ETNIA_INDIGENA',     'tamanho' => 4,     'preenchimento' => '0'],
        45  => ['nome' => 'COD_SOL_LIB',        'tamanho' => 5],
        46  => ['nome' => 'FILLER',             'tamanho' => 2,     'preenchimento' => '0'],
        47  => ['nome' => 'NU_CNS',             'tamanho' => 15],
        48  => ['nome' => 'NAC_PAC',            'tamanho' => 3,     'padrao' => '010'],
        49  => ['nome' => 'TP_LOGRADOURO',      'tamanho' => 3],
        50  => ['nome' => 'LOGR_PAC',           'tamanho' => 50,    'function' => 'remover_caracteres_especiais', 'str_pad_type' => STR_PAD_RIGHT],
        51  => ['nome' => 'NU_END_PAC',         'tamanho' => 7],
        52  => ['nome' => 'COMPL_END_PAC',      'tamanho' => 15,    'function' => 'remover_caracteres_especiais', 'str_pad_type' => STR_PAD_RIGHT],
        53  => ['nome' => 'BAIRRO_PAC',         'tamanho' => 30,    'function' => 'remover_caracteres_especiais', 'str_pad_type' => STR_PAD_RIGHT],
        54  => ['nome' => 'COD_MUN_END_PAC',    'tamanho' => 6],
        55  => ['nome' => 'UF_PAC',             'tamanho' => 2],
        56  => ['nome' => 'CEP_PAC',            'tamanho' => 8],
        57  => ['nome' => 'NU_PRONTUARIO',      'tamanho' => 15,    'preenchimento' => '0'],
        58  => ['nome' => 'NU_ENFERMARIA',      'tamanho' => 4],
        59  => ['nome' => 'NU_LEITO',           'tamanho' => 4],

        // Procedimento secundários/especiais
        60  => ['nome' => 'PROCEDIMENTOS', 'loop' => true, 'range' => 9, 'layout' =>
                [
                    61  => ['nome' => 'IN_PROF',            'tamanho' => 1,     'validos' => ['0', '1', '2'], 'padrao' => '0', 'preenchimento' => '0'],
                    62  => ['nome' => 'IDENT_PROF',         'tamanho' => 15,    'preenchimento' => '0'],
                    63  => ['nome' => 'CBO_PROF',           'tamanho' => 6,     'preenchimento' => '0'],
                    64  => ['nome' => 'IN_EQUIPE',          'tamanho' => 1,     'validos' => ['0', '1', '2', '3', '4', '5', '6'], 'padrao' => '0'],
                    65  => ['nome' => 'IN_SERVICO',         'tamanho' => 1,     'validos' => ['0', '3', '5'], 'padrao' => '0'],
                    66  => ['nome' => 'IDENT_SERVICO',      'tamanho' => 14], // ?
                    67  => ['nome' => 'IN_EXECUTOR',        'tamanho' => 1,     'validos' => ['1', '2', '3', '4', '5']],
                    68  => ['nome' => 'IDENT_EXECUTOR',     'tamanho' => 15,    'preenchimento' => ' ', 'str_pad_type' => STR_PAD_RIGHT],
                    69  => ['nome' => 'COD_PROCED',         'tamanho' => 10],
                    70  => ['nome' => 'QTD_PROCED',         'tamanho' => 3,     'preenchimento' => '0', 'str_pad_type' => STR_PAD_LEFT],
                    71  => ['nome' => 'CMPT',               'tamanho' => 6], // ?
                    72  => ['nome' => 'SERVICO',            'tamanho' => 3,     'padrao' => '000'],
                    73  => ['nome' => 'CLASSIFICACAO',      'tamanho' => 3,     'padrao' => '000'],
                ]
        ],
        74  => ['nome' => 'FILLER',             'tamanho' => 19,    'preenchimento' => '0'],
        75  => ['nome' => 'SAIDA_UTINEO',       'tamanho' => 1,     'validos' => ['0', '1', '2', '3']],
        76  => ['nome' => 'PESO_UTINEO',        'tamanho' => 4],
        77  => ['nome' => 'MESGEST_UTINEO',     'tamanho' => 1],
        78  => ['nome' => 'CNPJ_EMPREG',        'tamanho' => 14,    'regex' => '/[^0-9]/'],
        79  => ['nome' => 'CBOR',               'tamanho' => 6],
        80  => ['nome' => 'CNAER',              'tamanho' => 3],
        81  => ['nome' => 'TP_VINCPREV',        'tamanho' => 1,     'validos' => ['1', '2', '3', '4', '5', '6']],
        82  => ['nome' => 'QT_VIVOS',           'tamanho' => 1],
        83  => ['nome' => 'QT_MORTOS',          'tamanho' => 1],
        84  => ['nome' => 'QT_ALTA',            'tamanho' => 1],
        85  => ['nome' => 'QT_TRANSF',          'tamanho' => 1],
        86  => ['nome' => 'QT_OBITO',           'tamanho' => 1],
        87  => ['nome' => 'FILLER',             'tamanho' => 10,    'preenchimento' => '0'],
        88  => ['nome' => 'QT_FILHOS',          'tamanho' => 2],
        89  => ['nome' => 'GRAU_INSTRU',        'tamanho' => 1,     'validos' => ['1', '2', '3', '4']],
        90  => ['nome' => 'CID_INDICACAO',      'tamanho' => 4],
        91  => ['nome' => 'TP_CONTRACEP1',      'tamanho' => 2,     'validos' => ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']],
        92  => ['nome' => 'TP_CONTRACEP2',      'tamanho' => 2,     'validos' => ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']],
        93  => ['nome' => 'ST_GESTRISCO',       'tamanho' => 1,     'validos' => ['0', '1']],
        94  => ['nome' => 'RESERVADO',          'tamanho' => 35,    'preenchimento' => '0'],
        95  => ['nome' => 'NU_PRENATAL',        'tamanho' => 12,    'preenchimento' => '0'],
        96  => ['nome' => 'NU_DOC_PAC',         'tamanho' => 32,    'preenchimento' => ' ', 'str_pad_type' => STR_PAD_RIGHT],
        97  => ['nome' => 'PACIENTE_TEL_DDD',   'tamanho' => 2,     'preenchimento' => '0', 'regex' => '/[^0-9]/'],
        98  => ['nome' => 'PACIENTE_TEL_NUM',   'tamanho' => 9,     'preenchimento' => '0', 'str_pad_type' => STR_PAD_LEFT, 'regex' => '/[^0-9]/'],
        99  => ['nome' => 'JUSTIFICATINA_CNS',  'tamanho' => 50,    'function' => 'remover_caracteres_especiais'],
        100 => ['nome' => 'DIAG_SEC_1',         'tamanho' => 4],
        101 => ['nome' => 'DIAG_SEC_1_CLASS',   'tamanho' => 1,     'padrao' => '0', 'validos' => ['0', '1', '2']],
        102 => ['nome' => 'DIAG_SEC_2',         'tamanho' => 4],
        103 => ['nome' => 'DIAG_SEC_2_CLASS',   'tamanho' => 1,     'padrao' => '0', 'validos' => ['0', '1', '2']],
        104 => ['nome' => 'DIAG_SEC_3',         'tamanho' => 4],
        105 => ['nome' => 'DIAG_SEC_3_CLASS',   'tamanho' => 1,     'padrao' => '0', 'validos' => ['0', '1', '2']],
        106 => ['nome' => 'DIAG_SEC_4',         'tamanho' => 4],
        107 => ['nome' => 'DIAG_SEC_4_CLASS',   'tamanho' => 1,     'padrao' => '0', 'validos' => ['0', '1', '2']],
        108 => ['nome' => 'DIAG_SEC_5',         'tamanho' => 4],
        109 => ['nome' => 'DIAG_SEC_5_CLASS',   'tamanho' => 1,     'padrao' => '0', 'validos' => ['0', '1', '2']],
        110 => ['nome' => 'DIAG_SEC_6',         'tamanho' => 4],
        111 => ['nome' => 'DIAG_SEC_6_CLASS',   'tamanho' => 1,     'padrao' => '0', 'validos' => ['0', '1', '2']],
        112 => ['nome' => 'DIAG_SEC_7',         'tamanho' => 4],
        113 => ['nome' => 'DIAG_SEC_7_CLASS',   'tamanho' => 1,     'padrao' => '0', 'validos' => ['0', '1', '2']],
        114 => ['nome' => 'DIAG_SEC_8',         'tamanho' => 4],
        115 => ['nome' => 'DIAG_SEC_8_CLASS',   'tamanho' => 1,     'padrao' => '0', 'validos' => ['0', '1', '2']],
        116 => ['nome' => 'DIAG_SEC_9',         'tamanho' => 4],
        117 => ['nome' => 'DIAG_SEC_9_CLASS',   'tamanho' => 1,     'padrao' => '0', 'validos' => ['0', '1', '2']],
        118 => ['nome' => 'FILLER',             'tamanho' => 165,   'preenchimento' => '0']
    ];
````

Exemplo de uso

````
    $exportador = new \JuarezFranco\ExportToPattern\Exportador();

    $exportador->fopen('arquivo.txt');

    $exportador->gerarLinhas($layout, $dados); // array de dados deve implementar \JuarezFranco\ExportToPattern\GetAtributoParaExportacaoContract

    $exportador->fclose();

    return $exportador->getCaminhoDoArquivo();

````

### License

The MIT License (MIT)
