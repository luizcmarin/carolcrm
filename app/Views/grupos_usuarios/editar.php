<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4">
  <h2 class="mt-4 mb-4"><?= esc($titulo) ?></h2>

  <?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <h4 class="alert-heading">Erro de Validação!</h4>
      <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
          <li><?= esc($error) ?></li>
        <?php endforeach; ?>
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <div class="card mb-4">
    <div class="card-header">
      <i class="bi bi-pencil-square me-1"></i>
      Editando Grupo: <?= esc($grupo->nome) ?>
    </div>
    <div class="card-body">
      <?= form_open(site_url('gruposusuarios/atualizar/' . $grupo->id)) ?>
      <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= esc($grupo->id) ?>">

      <div class="mb-3">
        <label for="nome" class="form-label">Nome do Grupo</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?= old('nome', $grupo->nome ?? '') ?>" required>
      </div>

      <button type="submit" class="btn btn-primary me-2">
        <i class="bi bi-save me-2"></i>Atualizar
      </button>
      <a href="<?= site_url('gruposusuarios') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left-circle me-2"></i>Voltar
      </a>
      <?= form_close() ?>
    </div>
  </div>
</div>

<?= $this->endSection() ?>