<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $titulo ?></h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><?= $titulo ?></h6>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <p><strong>ID:</strong> <?= esc($usuario->id) ?></p>
          <p><strong>Nome:</strong> <?= esc($usuario->nome) ?></p>
          <p><strong>Grupo:</strong> <?= esc($usuario->grupo->nome ?? 'N/A') ?></p>
          <p><strong>Status:</strong> <?= esc($usuario->status) ?></p>
          <p><strong>Ativo:</strong> <?= esc($usuario->ativo) ?></p>
        </div>
        <div class="col-md-6">
          <p><strong>Mensagem Status:</strong> <?= esc($usuario->mensagem_status) ?></p>
          <p><strong>Último Acesso:</strong> <?= esc($usuario->ultimo_acesso ? date('d/m/Y H:i:s', strtotime($usuario->ultimo_acesso)) : 'N/A') ?></p>
          <p><strong>Criado em:</strong> <?= esc($usuario->criado_em ? date('d/m/Y H:i:s', strtotime($usuario->criado_em)) : 'N/A') ?></p>
          <p><strong>Atualizado em:</strong> <?= esc($usuario->atualizado_em ? date('d/m/Y H:i:s', strtotime($usuario->atualizado_em)) : 'N/A') ?></p>
        </div>
      </div>

      <hr>
      <a href="<?= base_url('usuarios/edit/' . $usuario->id) ?>" class="btn btn-warning">Editar</a>
      <a href="<?= base_url('usuarios') ?>" class="btn btn-secondary">Voltar à Lista</a>
    </div>
  </div>
</div>

<?= $this->endSection() ?>