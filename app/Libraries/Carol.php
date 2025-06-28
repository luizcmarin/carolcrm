<?php

namespace App\Libraries;

/**
 * Esta classe contem funções aleatórias.
 */
class Carol
{
  /**
   * Verifica se um arquivo ou diretório é realmente gravável.
   * Tenta escrever um byte ou criar um arquivo temporário para maior robustez.
   *
   * @param string $file O caminho para o arquivo ou diretório.
   * @return bool Verdadeiro se for gravável, falso caso contrário.
   */
  function eh_gravavel($file)
  {
    // Primeiro, use a verificação padrão do PHP
    if (is_writable($file)) {
      return true;
    }

    // Se is_writable falhou, tente uma verificação mais robusta abrindo o arquivo/diretório
    // Isso pode pegar casos onde is_writable é enganoso (e.g., alguns sistemas de arquivos em rede)
    if (is_file($file)) {
      // Tente abrir o arquivo para anexar (ab)
      if (($fp = @fopen($file, 'ab')) === false) {
        return false;
      }
      fclose($fp);
      return true;
    } elseif (is_dir($file)) {
      // Tente criar um arquivo temporário no diretório
      $temp_file = rtrim($file, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . uniqid(mt_rand()) . '.tmp';
      if (($fp = @fopen($temp_file, 'ab')) === false) {
        return false;
      }
      fclose($fp);
      @unlink($temp_file); // Remova o arquivo temporário
      return true;
    }

    return false;
  }
}
