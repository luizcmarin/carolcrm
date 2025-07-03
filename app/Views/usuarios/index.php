<?= $this->extend('layout/main') ?><?= $this->section('content') ?>

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $titulo ?></h1>
    <a href="<?= base_url('usuarios/new') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="bi bi-plus-lg text-white-50"></i> Novo Usuário </a>
  </div>

  <?php if (session()->has('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= session('success') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
  <?php if (session()->has('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?= session('error') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista de Usuários</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Grupo</th>
              <th>Status</th>
              <th>Ativo</th>
              <th>Último Acesso</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php if (!empty($usuarios)) : ?>
              <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                  <td><?= $usuario->id ?></td>
                  <td><?= esc($usuario->nome) ?></td>
                  <td><?= esc($usuario->nome_grupo ?? 'N/A') ?></td>
                  <td><?= esc($usuario->status) ?></td>
                  <td>
                    <?php if ($usuario->ativo === 'Sim') : ?>
                      <span class="badge bg-success text-white">Sim</span>
                    <?php else : ?>
                      <span class="badge bg-danger text-white">Não</span>
                    <?php endif; ?>
                  </td>
                  <td><?= esc($usuario->ultimo_acesso ? date('d/m/Y H:i', strtotime($usuario->ultimo_acesso)) : 'N/A') ?></td>
                  <td>
                    <a href="<?= base_url('usuarios/show/' . $usuario->id) ?>" class="btn btn-info btn-sm" title="Ver Detalhes">
                      <i class="bi bi-eye"></i> </a>
                    <a href="<?= base_url('usuarios/edit/' . $usuario->id) ?>" class="btn btn-warning btn-sm" title="Editar Usuário">
                      <i class="bi bi-pencil"></i> </a>
                    <form action="<?= base_url('usuarios/delete/' . $usuario->id) ?>" method="POST" class="d-inline form-delete">
                      <?= csrf_field() ?>
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-danger btn-sm" title="Excluir Usuário">
                        <i class="bi bi-trash"></i> </button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="7" class="text-center">Nenhum usuário encontrado.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <?= $this->include('partes/paginacao') ?>

    </div>
  </div>
</div>

<?= $this->endSection() ?>