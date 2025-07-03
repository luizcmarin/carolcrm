<?php

namespace App\Libraries;

/**
 * Esta classe resolve o problema de converter um arquivo de script SQL em um array de strings SQL. O PDO geralmente não
 * suporta strings SQL com múltiplas instruções; por exemplo, parece funcionar com MySQL, mas não com PostgreSQL.
 *
 * A razão pela qual esta classe existe é para lidar com as permutações de comentários de linha, comentários de bloco e strings entre aspas
 * que tornam complicado encontrar os pontos e vírgulas que separam as instruções SQL em um arquivo de script.
 *
 * Existem duas funções principais:
 *
 * 1. parse($sqlContent) pegará a string de conteúdo SQL e a dividirá em partes demarcadas por pontos e vírgulas.
 * O array de retorno conterá fragmentos SQL não processados que podem ser apenas espaços em branco e/ou comentários.
 *
 * 2. removeComments($sql) pega um fragmento SQL (provavelmente obtido através da função parse) e o trima após
 * remover todos os comentários. Se não houver SQL real no fragmento, o valor de retorno será uma string vazia.
 */
class SqlScriptParser
{
    /**
     * Analisa as instruções SQL de uma dada string de conteúdo SQL, demarcadas por pontos e vírgulas.
     * O array de retorno conterá fragmentos SQL não processados que podem ser apenas espaços em branco e/ou comentários.
     *
     * @param string $sqlContent O conteúdo completo do script SQL como uma string.
     *
     * @return list<string> Um array de instruções SQL
     */
    public function parse(string $sqlContent): array
    {
        $seekPos = 0;
        $return  = [];

        while (true) {
            $nextPos = $this->getSemiColonPos($sqlContent, $seekPos);
            if ($nextPos === false) {
                $fragment = substr($sqlContent, $seekPos);
                if (trim($fragment) !== '') {
                    $return[] = $fragment;
                }
                break;
            }
            $return[] = substr($sqlContent, $seekPos, $nextPos - $seekPos);
            $seekPos  = $nextPos + 1;
        }

        return $return;
    }

    /**
     * Pega um fragmento SQL (provavelmente obtido através da função parse) e o trima após remover todos os comentários.
     * Se não houver SQL real no fragmento, o valor de retorno será uma string vazia.
     *
     * @param string $sql Um fragmento SQL para destilar
     *
     * @return string O fragmento SQL destilado
     */
    public function removeComments(string $sql): string
    {
        $seekPos = 0;

        while (true) {
            $quoteStart = strpos($sql, '\'', $seekPos);
            $lineStart  = strpos($sql, '--', $seekPos);
            $blockStart = strpos($sql, '/*', $seekPos);
            if ($quoteStart === false && $lineStart === false && $blockStart === false) {
                break;
            }
            if ($this->foundFirst($lineStart, $quoteStart, $blockStart)) {
                $nextPos = $this->skipPastMarker($sql, "\n", $lineStart + 2);
                $sql     = substr($sql, 0, $lineStart) . substr($sql, $nextPos);
            } elseif ($this->foundFirst($quoteStart, $lineStart, $blockStart)) {
                $seekPos = $this->skipPastQuote($sql, $quoteStart + 1);
                if ($seekPos === false) {
                    $seekPos = strlen($sql);
                }
            } elseif ($this->foundFirst($blockStart, $quoteStart, $lineStart)) {
                $nextPos = $this->skipPastMarker($sql, '*/', $blockStart + 2);
                $sql     = substr($sql, 0, $blockStart) . substr($sql, $nextPos);
            }
        }

        return trim($sql);
    }

    /**
     * Obtém a próxima posição de ponto e vírgula em uma string SQL, enquanto lida com as permutações de comentários de linha,
     * comentários de bloco e strings entre aspas que podem conter pontos e vírgulas.
     *
     * @param string $sql    A string SQL
     * @param int    $offset Onde começar a procurar por pontos e vírgulas
     *
     * @return bool|int O offset encontrado, ou false se nenhum ponto e vírgula foi encontrado
     */
    private function getSemiColonPos(string &$sql, int $offset)
    {
        $seekPos = $offset;

        while (true) {
            $semiColonPos = strpos($sql, ';', $seekPos);
            $quoteStart   = strpos($sql, '\'', $seekPos);
            $lineStart    = strpos($sql, '--', $seekPos);
            $blockStart   = strpos($sql, '/*', $seekPos);
            if ($semiColonPos === false && $quoteStart === false && $lineStart === false && $blockStart === false) {
                return false;
            }
            if ($this->foundFirst($semiColonPos, $quoteStart, $lineStart, $blockStart)) {
                return $semiColonPos;
            }
            if ($this->foundFirst($lineStart, $semiColonPos, $quoteStart, $blockStart)) {
                $seekPos = $this->skipPastMarker($sql, "\n", $lineStart + 2);
            } elseif ($this->foundFirst($quoteStart, $semiColonPos, $lineStart, $blockStart)) {
                $seekPos = $this->skipPastQuote($sql, $quoteStart + 1);
            } elseif ($this->foundFirst($blockStart, $semiColonPos, $quoteStart, $lineStart)) {
                $seekPos = $this->skipPastMarker($sql, '*/', $blockStart + 2);
            }
            if ($seekPos === false) {
                return false;
            }
        }

        return false;
    }

    /**
     * Testa se var1 é menor que os outros parâmetros de var, sabendo que "false" significa "não encontrado".
     * - Se var1 for false, não é menor.
     * - Se qualquer outra var for false, não pode ser maior.
     *
     * @param bool|int $var1
     * @param bool|int $var2
     * @param bool|int $var3
     * @param bool|int $var4
     *
     * @return bool Verdadeiro se var1 for menor, e falso caso contrário
     */
    private function foundFirst($var1, $var2, $var3 = false, $var4 = false): bool
    {
        return $var1 !== false
          && ($var1 < $var2 || $var2 === false)
          && ($var1 < $var3 || $var3 === false)
          && ($var1 < $var4 || $var4 === false);
    }

    /**
     * @param string $haystack A string sendo analisada
     * @param string $needle   O marcador a procurar
     * @param int    $offset   Posição para iniciar a busca
     *
     * @return bool|int A posição para pular (incluindo o comprimento do marcador) ou false se o marcador não foi encontrado
     */
    private function skipPastMarker(string &$haystack, string $needle, int $offset)
    {
        $endPos = strpos($haystack, $needle, $offset);
        if ($endPos === false) {
            return false;
        }

        return $endPos + strlen($needle);
    }

    /**
     * Encontra o próximo caractere de aspas e o pula. Pula todos os caracteres de aspas escapados para fazer isso.
     *
     * @param string $haystack A string sendo analisada
     * @param int    $offset   Posição para iniciar a busca
     *
     * @return bool|int A posição para pular (incluindo o comprimento do marcador) ou false se o marcador não foi encontrado
     */
    private function skipPastQuote(string &$haystack, int $offset)
    {
        while (true) {
            $quoteEnd        = strpos($haystack, '\'', $offset);
            $doubledQuoteEnd = strpos($haystack, '\'\'', $offset);
            $escapedQuoteEnd = strpos($haystack, '\\\'', $offset);
            if ($quoteEnd === false) {
                return false;
            }
            if ($doubledQuoteEnd === $quoteEnd) {
                $offset = $doubledQuoteEnd + 2;
            } elseif ($escapedQuoteEnd === $quoteEnd - 1) {
                $offset = $quoteEnd + 1;
            } else {
                return $quoteEnd + 1;
            }
        }

        return false;
    }
}
