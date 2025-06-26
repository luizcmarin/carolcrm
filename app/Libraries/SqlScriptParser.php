<?php

namespace App\Libraries;

/**
 * This class solves the problem of converting an SQL script file into an array of SQL strings. PDO does not
 * generally support SQL strings with multiple statements, e.g. it seems to work with MySQL but not PostgreSQL.
 *
 * The reason this class exists is to deal with the permutations of line comments, block comments and quoted strings
 * that make it tricky to find the semicolons that separate the SQL statements in a script file.
 *
 * There are two main functions:
 *
 * 1. parse($sqlContent) will take the SQL content string and split it into parts demarcated by semicolons.
 * The return array will contain unprocessed SQL fragments that could be just whitespace and/or comments.
 *
 * 2. removeComments($sql) takes an SQL fragment (probably obtained via the parse function) and trims it after
 * removing all comments. If there is no actual SQL in the fragment, the return value will be an empty string.
 *
 * @package App\Libraries
 * @author Dion Truter <dion@truter.org>
 * @author Converted by Gemini AI
 * @author Corrected by Gemini AI for content parsing
 */
class SqlScriptParser
{
  /**
   * Parses SQL statements from a given SQL content string, demarcated by semicolons.
   * The return array will contain unprocessed SQL fragments that could be just whitespace and/or comments.
   *
   * @param string $sqlContent The full content of the SQL script as a string.
   * @return string[] An array of SQL statements
   */
  public function parse(string $sqlContent): array // <--- AGORA ESPERA O CONTEÚDO (STRING)
  {
    $seekPos = 0;
    $return = [];
    // A lógica de parsing original é mantida, mas agora opera sobre $sqlContent
    // e não tenta ler um arquivo.
    while (true) {
      $nextPos = $this->getSemiColonPos($sqlContent, $seekPos); // Usa $sqlContent
      if ($nextPos === false) {
        $fragment = substr($sqlContent, $seekPos); // Usa $sqlContent
        if (trim($fragment) !== '') { // Adicionado para não adicionar fragmentos vazios no final
          $return[] = $fragment;
        }
        break;
      } else {
        $return[] = substr($sqlContent, $seekPos, $nextPos - $seekPos); // Usa $sqlContent
        $seekPos = $nextPos + 1;
      }
    }
    return $return;
  }

  /**
   * Takes an SQL fragment (probably obtained via the parse function) and trims it after removing all comments.
   * If there is no actual SQL in the fragment, the return value will be an empty string.
   *
   * @param string $sql An SQL fragment to distill
   * @return string The distilled SQL fragment
   */
  public function removeComments(string $sql): string
  {
    // ... (este método permanece EXATAMENTE igual)
    $seekPos = 0;
    while (true) {
      $quoteStart = strpos($sql, '\'', $seekPos);
      $lineStart = strpos($sql, '--', $seekPos);
      $blockStart = strpos($sql, '/*', $seekPos);
      if ($quoteStart === false && $lineStart === false && $blockStart === false) {
        break;
      }
      if ($this->foundFirst($lineStart, $quoteStart, $blockStart)) {
        $nextPos = $this->skipPastMarker($sql, "\n", $lineStart + 2);
        $sql = substr($sql, 0, $lineStart) . substr($sql, $nextPos);
      } elseif ($this->foundFirst($quoteStart, $lineStart, $blockStart)) {
        $seekPos = $this->skipPastQuote($sql, $quoteStart + 1);
        if ($seekPos === false) {
          $seekPos = strlen($sql);
        }
      } elseif ($this->foundFirst($blockStart, $quoteStart, $lineStart)) {
        $nextPos = $this->skipPastMarker($sql, '*/', $blockStart + 2);
        $sql = substr($sql, 0, $blockStart) . substr($sql, $nextPos);
      }
    }
    return trim($sql);
  }

  /**
   * Gets the next semicolon separator in an SQL string, while dealing with the permutations of line comments,
   * block comments and quoted strings that could contain semicolons.
   *
   * @param string $sql The SQL string
   * @param int $offset Where to start looking for semicolons
   * @return bool|int The offset found, or false if no semicolon was found
   */
  private function getSemiColonPos(string &$sql, int $offset)
  {
    // ... (este método permanece EXATAMENTE igual)
    $seekPos = $offset;
    while (true) {
      $semiColonPos = strpos($sql, ';', $seekPos);
      $quoteStart = strpos($sql, '\'', $seekPos);
      $lineStart = strpos($sql, '--', $seekPos);
      $blockStart = strpos($sql, '/*', $seekPos);
      if ($semiColonPos === false && $quoteStart === false && $lineStart === false && $blockStart === false) {
        return false;
      }
      if ($this->foundFirst($semiColonPos, $quoteStart, $lineStart, $blockStart)) {
        return $semiColonPos;
      } elseif ($this->foundFirst($lineStart, $semiColonPos, $quoteStart, $blockStart)) {
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

  // --- REMOVA ESTE MÉTODO INTEIRO! Não é mais necessário. ---
  // private function getNormalizedContent(string $sqlFile): string
  // {
  //     $content = '';
  //     if (($handle = fopen($sqlFile, 'r')) !== false) {
  //         while (($line = fgets($handle)) !== false) {
  //             $content .= "$line\n";
  //         }
  //         fclose($handle);
  //     }
  //     return $content;
  // }
  // --- FIM DA REMOÇÃO ---

  /**
   * Tests Whether var1 is smaller than the other var parameters, knowing that "false" means "not found"
   * - If var1 is false it is not smaller
   * - If any other var is false it cannot be bigger
   *
   * @param int|bool $var1
   * @param int|bool $var2
   * @param int|bool $var3
   * @param int|bool $var4
   * @return bool True if var1 is smaller, and false otherwise
   */
  private function foundFirst($var1, $var2, $var3 = false, $var4 = false): bool
  {
    // ... (este método permanece EXATAMENTE igual)
    return $var1 !== false
      && ($var1 < $var2 || $var2 === false)
      && ($var1 < $var3 || $var3 === false)
      && ($var1 < $var4 || $var4 === false);
  }

  /**
   * @param string $haystack The string being analysed
   * @param string $needle The marker to look for
   * @param int $offset Start looking at the offset position
   * @return bool|int The position to skip to (including the marker length) or false if the marker was not found
   */
  private function skipPastMarker(string &$haystack, string $needle, int $offset)
  {
    // ... (este método permanece EXATAMENTE igual)
    $endPos = strpos($haystack, $needle, $offset);
    if ($endPos === false) {
      return false;
    }
    return $endPos + strlen($needle);
  }

  /**
   * Find the next quote character and move past it. Skip all escaped quote characters to do so.
   *
   * @param string $haystack The string being analysed
   * @param int $offset Start looking at the offset position
   * @return bool|int The position to skip to (including the marker length) or false if the marker was not found
   */
  private function skipPastQuote(string &$haystack, int $offset)
  {
    // ... (este método permanece EXATAMENTE igual)
    while (true) {
      $quoteEnd = strpos($haystack, '\'', $offset);
      $doubledQuoteEnd = strpos($haystack, '\'\'', $offset);
      $escapedQuoteEnd = strpos($haystack, '\\\'', $offset);
      if ($quoteEnd === false) {
        return false;
      } elseif ($doubledQuoteEnd == $quoteEnd) {
        $offset = $doubledQuoteEnd + 2;
      } elseif ($escapedQuoteEnd == $quoteEnd - 1) {
        $offset = $quoteEnd + 1;
      } else {
        return $quoteEnd + 1;
      }
    }
    return false;
  }
}
