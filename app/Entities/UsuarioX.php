<?php

namespace App\Entities\Admin;

use Config\Services;
use CodeIgniter\I18n\Time;
use CodeIgniter\Entity\Entity;

/**
 * Entidade que representa um Usuário (tbl_usuarios).
 * @property int|null    $id
 * @property string|null $nome
 * @property string|null $status
 * @property string|null $mensagem_status
 * @property string      $ativo
 * @property string|null $ultimo_acesso
 * @property string|null $criado_em
 * @property string|null $atualizado_em
 * @property string|null $deletado_em
 *
 * Propriedades Virtuais:
 * @property string|null $email // O email do usuário, obtido da identidade principal
 * @property string|null $senha // A senha em texto plano (apenas para definir, não para ler)
 * @property string|null $hash_senha // O hash da senha (para casos específicos de leitura/escrita)
 */
class Usuario extends Entity
{
  protected $attributes = [
    'id'              => null,
    'nome'            => null,
    'status'          => null,
    'mensagem_status' => null,
    'ativo'           => 'Não',
    'ultimo_acesso'   => null,
    'criado_em'       => null,
    'atualizado_em'   => null,
    'deletado_em'     => null,
  ];

  // Os campos 'dates' são para o CodeIgniter saber quais campos são datas
  // para tentar converter, mesmo com cast como string, ajuda o CI a entender.
  protected $dates = ['ultimo_acesso', 'criado_em', 'atualizado_em', 'deletado_em'];

  protected $casts = [
    'id'              => '?int',
    'ativo'           => '?string',
    'ultimo_acesso'   => '?string',
    'criado_em'       => '?string',
    'atualizado_em'   => '?string',
    'deletado_em'     => '?string',
  ];

  protected $datamap = [
    'email' => null,
    'senha' => null,
    'hash_senha' => null,
  ];

  public function __construct(array $data)
  {
    parent::__construct($data);


    $this->Carol->preencheCamposAuditoria($this->attributes['id'], $this->attributes);
    // Preenche campos APENAS se a entidade é nova (sem ID) ou se o campo ainda não foi definido.
    if ($this->attributes['id'] === null) {
      if (!isset($this->attributes['ativo']) || $this->attributes['ativo'] === null) {
        $this->attributes['ativo'] = 'Não';
      }
    }
  }

  public function setEmail(string $email)
  {
    $this->attributes['email'] = $email;
    return $this;
  }

  protected function getEmail(): ?string
  {
    if (isset($this->attributes['email']) && $this->attributes['email'] !== null) {
      return $this->attributes['email'];
    }

    if ($this->id !== null) {
      $identidadeModel = new IdentidadeAutenticacaoModel();
      $identidade = $identidadeModel->where('usuario_id', $this->id)
        ->where('tipo', IdentidadeAutenticacaoModel::TIPO_EMAIL_SENHA)
        ->first();
      if ($identidade) {
        return $identidade->secreto;
      }
    }
    return null;
  }

  public function setSenha(string $senha_texto_claro)
  {
    $this->attributes['senha'] = $senha_texto_claro;
    $this->attributes['hash_senha'] = password_hash($senha_texto_claro, PASSWORD_DEFAULT);
    return $this;
  }

  public function setHashSenha(string $hash_da_senha)
  {
    $this->attributes['hash_senha'] = $hash_da_senha;
    return $this;
  }

  public function setUltimoAcesso(string $dataHora, string $usuarioInfo, string $ip, string $userAgent): Usuario
  {
    $this->attributes['ultimo_acesso'] = "{$dataHora} | {$usuarioInfo} | {$ip} | {$userAgent}";
    return $this;
  }

  public function getIdentidade(string $tipo): ?IdentidadeAutenticacao
  {
    if ($this->id === null) {
      return null;
    }
    $identidadeModel = new IdentidadeAutenticacaoModel();
    return $identidadeModel->where('usuario_id', $this->id)
      ->where('tipo', $tipo)
      ->first();
  }

  public function salvarIdentidadePrincipal(IdentidadeAutenticacaoModel $identidadeAutenticacaoModel): bool
  {
    if ($this->id === null) {
      log_message('error', 'Tentativa de salvar identidade principal sem ID de usuário (entidade).');
      return false;
    }

    $identidade = $this->getIdentidade(IdentidadeAutenticacaoModel::TIPO_EMAIL_SENHA);

    if ($identidade === null) {
      $identidade = new IdentidadeAutenticacao();
      $identidade->usuario_id = $this->id;
      $identidade->tipo = IdentidadeAutenticacaoModel::TIPO_EMAIL_SENHA;
      $identidade->forcar_reset = false;
    }

    if (!isset($this->attributes['email']) || $this->attributes['email'] === null) {
      log_message('error', 'Email não definido na entidade Usuário para salvar identidade principal.');
      return false;
    }

    $identidade->secreto = $this->attributes['email'];
    $identidade->secreto2 = $this->attributes['hash_senha'] ?? $identidade->secreto2;

    $this->Carol->preencheCamposAuditoria($identidade->id, $this->attributes);

    try {
      $result = $identidadeAutenticacaoModel->save($identidade);
      if (!$result) {
        log_message('error', 'IdentidadeAutenticacaoModel->save() retornou false sem erros visíveis do model.');
      }
      return $result;
    } catch (\Exception $e) {
      // Capture qualquer exceção de banco de dados ou outra que o save() possa lançar
      log_message('critical', 'Exceção ao salvar identidade: ' . $e->getMessage());
      return false;
    }
  }
}
