<?php

namespace JuarezFranco\ExportToPattern;

class Exportador
{
    private $arquivo = null;
    private $caminhoDoArquivo = null;

    public function gerarLinhas($layout, $dados)
    {
        $linhas = $this->processarDados($layout, $dados);
        fwrite($this->arquivo, implode("\n", $linhas));
    }

    /**
     * Realiza processamento dos dados, para cada dado no loop é aplicado as regras do layout.
     * Obs.: Um dado pode ser uma coleção de dados, nesse casso é aplicado recursivamente este método processarDados
     * aplicando para cada dado da coleção as regras do layout especificado.
     *
     * @param Collection $layout uma coleção de atributos do dado com regras que serão aplicadas
     * @param Collection $dados uma coleção de dados que cada um deve implementar GetAtributoParaExportacaoContract
     * @return Collection
     */
    private function processarDados($layout, $dados)
    {
        return $this->arrayMap($dados, function (GetAtributoParaExportacaoContract $contract) use ($layout) {

            $colunas = $this->arrayMap($layout, function ($campo) use ($contract) {

                $atributo = $contract->getAtributoParaExportacao($campo['nome']);
                $atributo = $atributo ?: '';

                // Caso atributo for uma coleção, então aplica recursivamente o processarDados para tratar o layout dessa coleção
                if (array_key_exists('loop', $campo)) {
                    $dados = $atributo;

                    // Limita os dados de acordo com o range do loop
                    array_splice($dados, $campo['range'] - 1);

                    // Adiciona objetos vazios para forçar coleção ter a qtde do range
                    foreach (range(0, $campo['range'] - 1 - count($dados)) as $index) {
                        $dados[] = new Suporte();
                    }

                    $colunas = $this->processarDados($campo['layout'], $dados);
                    return implode('',$colunas);
                }

                // Preenche com texto padrão
                if (!$atributo && array_key_exists('padrao', $campo)) {
                    $atributo = $campo['padrao'];
                }

                // Aplica regex no conteudo.
                if ($atributo && array_key_exists('regex', $campo)) {
                    $atributo = preg_replace($campo['regex'], '', $atributo);
                }

                // Chama função atribuida ao campo
                if ($atributo && array_key_exists('function', $campo)) {
                    $atributo = $campo['function']($atributo);
                }

                // Corrige comprimento de caracteres
                if (mb_strlen($atributo) > $campo['tamanho']) {
                    $atributo = mb_substr($atributo, 0, $campo['tamanho']);
                }

                // Valida dados
                if ($atributo && array_key_exists('validos', $campo) && !in_array($atributo, $campo['validos'])) {
                    $msg = 'Campo '. $campo['nome'].' possui um valor inválido, seu valor é ' . $atributo . ', deve ser ['. implode(',', $campo['validos']) .']';
                    throw new \Exception($msg);
                }

                // Preenche atributo
                $strPadType = array_key_exists('str_pad_type', $campo) ?  $campo['str_pad_type'] : STR_PAD_LEFT;
                if (array_key_exists('preenchimento', $campo)) {
                    $atributo = mb_str_pad($atributo, $campo['tamanho'], $campo['preenchimento'] . '', $strPadType);
                } else {
                    $atributo = mb_str_pad($atributo, $campo['tamanho'], ' ', $strPadType);
                }

                return $atributo;

            });

            return implode('', $colunas);
        });
    }

    public function getCaminhoDoArquivo()
    {
        return $this->caminhoDoArquivo;
    }

    public function fopen($nomeDoArquivo)
    {
        $respositorio = '/tmp/exportador/'. md5(uniqid() . rand()) .'/';
        $this->caminhoDoArquivo = $respositorio . $nomeDoArquivo;
        mkdir($respositorio, 0777, true);
        $this->arquivo = fopen($this->caminhoDoArquivo, 'a');
    }

    public function fclose()
    {
        fclose($this->arquivo);
    }

    // alias array_map
    private function arrayMap($dados, $closure)
    {
        return array_map($closure, $dados);
    }
}