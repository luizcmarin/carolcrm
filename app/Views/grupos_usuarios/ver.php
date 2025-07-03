<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4">
  <h2 class="mt-4 mb-4"><?= esc($titulo) ?></h2>

  <div class="card mb-4">
    <div class="card-header">
      <i class="bi bi-eye me-1"></i>
      Detalhes do Grupo: <?= esc($grupo->nome) ?>
    </div>
    <div class="card-body">
      <div class="mb-3">
        <strong>ID:</strong> <?= esc($grupo->id) ?>
      </div>
      <div class="mb-3">
        <strong>Nome:</strong> <?= esc($grupo->nome) ?>
      </div>
      <div class="mb-3">
        <strong>Criado Em:</strong> <?= esc($grupo->criado_em) ?>
      </div>
      <div class="mb-3">
        <strong>Atualizado Em:</strong> <?= esc($grupo->atualizado_em) ?>
      </div>

      <hr>

      <a href="<?= site_url('gruposusuarios/editar/' . $grupo->id) ?>" class="btn btn-warning me-2">
        <i class="bi bi-pencil-square me-2"></i>Editar
      </a>
      <a href="<?= site_url('gruposusuarios') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left-circle me-2"></i>Voltar para a Lista
      </a>
    </div>
  </div>
</div>

<?= $this->endSection() ?>