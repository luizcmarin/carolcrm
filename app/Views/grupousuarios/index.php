<?= $this->extend('layout/principal') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $titulo ?></h1>
        
        <div class="d-sm-flex align-items-center">
            <div class="col-md-auto me-3"> 
              <form action="<?= current_url() ?>" method="GET" class="d-flex">
                  <div class="input-group">
                      <input type="search" class="form-control" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= esc($search ?? '') ?>">
                      <button class="btn btn-outline-secondary" type="submit" title="Pesquisar">
                          <i class="bi bi-search"></i> Pesquisar
                      </button>
                      <?php if (!empty($search)) : ?>
                          <a href="<?= current_url() ?>" class="btn btn-outline-danger" title="Limpar pesquisa">
                              <i class="bi bi-x-lg"></i> Limpar
                          </a>
                      <?php endif; ?>
                  </div>
              </form>
            </div>
            <div class="col-md-auto">
                <a href="<?= base_url('grupousuarios/new') ?>" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-lg text-white-50"></i> Novo
                </a>
            </div>
        </div>
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
            <h6 class="m-0 font-weight-bold text-primary">Lista</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nome</th>
                                    <th>Criado Em</th>
                                    <th>Atualizado Em</th>
                                    <th>Deletado Em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php if (!empty($grupousuarios)): ?>
                            <?php foreach ($grupousuarios as $grupousuarios): ?>
                                <tr>
                                    <td><?= $grupousuarios->nome ?></td>
                                    <td><?= $grupousuarios->criado_em ?></td>
                                    <td><?= $grupousuarios->atualizado_em ?></td>
                                    <td><?= $grupousuarios->deletado_em ?></td>
                                    <td>
                                        <a href="<?= base_url('grupousuarios/show/' . $grupousuarios->id) ?>" class="btn btn-info btn-sm" title="Detalhes">
                                            <i class="bi bi-eye"></i> </a>
                                        <a href="<?= base_url('grupousuarios/edit/' . $grupousuarios->id) ?>" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="bi bi-pencil"></i> </a>
                                        <form action="<?= base_url('grupousuarios/delete/' . $grupousuarios->id) ?>" method="POST" class="d-inline form-delete">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-sm" title="Excluir">
                                                <i class="bi bi-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <?= $this->include('partes/paginacao') ?>
        </div>
        <div class="card-footer text-body-secondary">
        </div>
    </div>
</div>
<?= $this->endSection() ?>