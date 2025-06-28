<?php

namespace App\Libraries;

/**
 * Esta classe contem funções aleatórias.
 */
class Carol
{

  /**
   * Verifica se um arquivo ou diretório é realmente gravável,
   * lidando com problemas de sistemas de arquivos em rede ou chroot.
   *
   * @param string $file O caminho para o arquivo ou diretório.
   * @return bool Verdadeiro se for gravável, falso caso contrário.
   */
  function eh_gravavel($file)
  {
    // Se estamos em um sistema tipo Unix e temos funções Posix, use-as para diretórios
    if (DIRECTORY_SEPARATOR === '/' && function_exists('posix_getpwuid') && function_exists('fileowner')) {
      $owner = posix_getpwuid(fileowner($file));
      if ($owner && $owner['name'] === get_current_user()) {
        return is_writable($file);
      }
    }

    // Para sistemas não-Posix, ou se o proprietário não corresponder, ou para arquivos
    if (is_file($file)) {
      // VFS ou outros sistemas de arquivos não-padrão podem precisar de uma verificação de arquivo temporário
      if (($fp = @fopen($file, 'ab')) === false) {
        return false;
      }
      fclose($fp);
      return true;
    } elseif (is_dir($file)) {
      $temp_file = rtrim($file, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . uniqid(mt_rand()) . '.tmp';
      if (($fp = @fopen($temp_file, 'ab')) === false) {
        return false;
      }
      fclose($fp);
      @unlink($temp_file);
      return true;
    }

    return false;
  }
}
