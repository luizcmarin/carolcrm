<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4">
  <h2 class="mt-4 mb-4"><?= esc($titulo) ?></h2>

  <?php if (session()->getFlashdata('sucesso')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= esc(session()->getFlashdata('sucesso')) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <?php if (session()->getFlashdata('erro')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?= esc(session()->getFlashdata('erro')) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <p class="mb-4">
    <a href="<?= site_url('gruposusuarios/incluir') ?>" class="btn btn-primary">
      <i class="bi bi-plus-circle me-2"></i>Adicionar Novo Grupo
    </a>
  </p>

  <?php if (empty($grupos)): ?>
    <div class="alert alert-info text-center" role="alert">
      Nenhum grupo de usuário encontrado.
    </div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Criado Em</th>
            <th scope="col">Atualizado Em</th>
            <th scope="col" class="text-center">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($grupos as $grupo): ?>
            <tr>
              <td><?= esc($grupo->id) ?></td>
              <td><?= esc($grupo->nome) ?></td>
              <td><?= esc($grupo->criado_em) ?></td>
              <td><?= esc($grupo->atualizado_em) ?></td>
              <td class="text-center">
                <a href="<?= site_url('gruposusuarios/ver/' . $grupo->id) ?>" class="btn btn-info btn-sm me-1" title="Ver Detalhes">
                  <i class="bi bi-eye"></i>
                </a>
                <a href="<?= site_url('gruposusuarios/editar/' . $grupo->id) ?>" class="btn btn-warning btn-sm me-1" title="Editar">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <form action="<?= site_url('gruposusuarios/excluir/' . $grupo->id) ?>" method="post" class="d-inline form-delete">
                  <?= csrf_field() ?>
                  <button type="submit" class="btn btn-danger btn-sm" title="Excluir">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?= $this->include('partes/paginacao') ?>

  <?php endif; ?>
</div>
<?= $this->endSection() ?>