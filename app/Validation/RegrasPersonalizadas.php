<?php

namespace App\Validation;

class RegrasPersonalizadas
{
  /**
   * Valida um número de CPF.
   * Remove caracteres não numéricos e aplica o algoritmo de validação.
   *
   * @param string|null $cpf O valor do CPF a ser validado.
   * @return bool Retorna true se o CPF for válido, false caso contrário.
   */
  public function valid_cpf(?string $cpf): bool
  {
    if (empty($cpf)) {
      return true; // Considera vazio como válido se não for 'required'
    }

    $cpf = preg_replace('/[^0-9]/', '', $cpf); // Remove caracteres não numéricos

    // Verifica se o CPF tem 11 dígitos
    if (strlen($cpf) != 11) {
      return false;
    }

    // Verifica se todos os dígitos são iguais (ex: 111.111.111-11)
    if (preg_match('/^(\d)\1{10}$/', $cpf)) {
      return false;
    }

    // Calcula o primeiro dígito verificador
    for ($i = 0, $sum = 0; $i < 9; $i++) {
      $sum += (int)$cpf[$i] * (10 - $i);
    }
    $remainder = $sum % 11;
    $digit1 = ($remainder < 2) ? 0 : 11 - $remainder;

    // Calcula o segundo dígito verificador
    for ($i = 0, $sum = 0; $i < 10; $i++) {
      $sum += (int)$cpf[$i] * (11 - $i);
    }
    $remainder = $sum % 11;
    $digit2 = ($remainder < 2) ? 0 : 11 - $remainder;

    // Verifica se os dígitos calculados coincidem com os dígitos do CPF
    return ((int)$cpf[9] == $digit1) && ((int)$cpf[10] == $digit2);
  }
}
