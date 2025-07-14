<?= $this->extend('layout/principal') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h5 class="mb-0 text-primary-emphasis"><?= $titulo ?></h5>
        
        <div class="d-sm-flex align-items-center">
            <div class="col-md-auto me-3"> 
              <form action="<?= current_url() ?>" method="GET" class="d-flex">
                  <div class="input-group">
                      <input type="search" class="form-control" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= esc($search ?? '') ?>">
                      <button class="btn btn-secondary" type="submit" title="Pesquisar">
                          <i class="bi bi-search"></i>
                      </button>
                      <?php if (!empty($search)) : ?>
                          <a href="<?= current_url() ?>" class="btn btn-danger" title="Limpar pesquisa">
                              <i class="bi bi-x-lg"></i>
                          </a>
                      <?php endif; ?>
                  </div>
              </form>
            </div>
            <div class="col-md-auto">
                <?php if (service('Carol')->pode('FIDELIZES.NOVO')) : ?>
                <a href="<?= base_url('fidelizes/new') ?>" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-lg text-white-50"></i> Novo
                </a>
                <?php endif; ?>
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
            <h6 class="m-0 text-primary-emphasis">Lista</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nivel Fidelidade1</th>
                                    <th>Pontos De1</th>
                                    <th>Pontos Ate1</th>
                                    <th>Nivel Fidelidade2</th>
                                    <th>Pontos De2</th>
                                    <th>Pontos Ate2</th>
                                    <th>Nivel Fidelidade3</th>
                                    <th>Pontos De3</th>
                                    <th>Pontos Ate3</th>
                                    <th>Nivel Fidelidade4</th>
                                    <th>Pontos De4</th>
                                    <th>Pontos Ate4</th>
                                    <th>Faturamento Pontos1</th>
                                    <th>Valor Faturamento De1</th>
                                    <th>Valor Faturamento Ate1</th>
                                    <th>Faturamento Pontos2</th>
                                    <th>Valor Faturamento De2</th>
                                    <th>Valor Faturamento Ate2</th>
                                    <th>Faturamento Pontos3</th>
                                    <th>Valor Faturamento De3</th>
                                    <th>Valor Faturamento Ate3</th>
                                    <th>Faturamento Pontos4</th>
                                    <th>Valor Faturamento De4</th>
                                    <th>Valor Faturamento Ate4</th>
                                    <th>Faturamento Pontos5</th>
                                    <th>Valor Faturamento De5</th>
                                    <th>Valor Faturamento Ate5</th>
                                    <th>Frequencia Pontos1</th>
                                    <th>Frequencia De1</th>
                                    <th>Frequencia Ate1</th>
                                    <th>Frequencia Pontos2</th>
                                    <th>Frequencia De2</th>
                                    <th>Frequencia Ate2</th>
                                    <th>Frequencia Pontos3</th>
                                    <th>Frequencia De3</th>
                                    <th>Frequencia Ate3</th>
                                    <th>Frequencia Pontos4</th>
                                    <th>Frequencia De4</th>
                                    <th>Frequencia Ate4</th>
                                    <th>Frequencia Pontos5</th>
                                    <th>Frequencia De5</th>
                                    <th>Frequencia Ate5</th>
                                    <th>Permanencia Pontos1</th>
                                    <th>Permanencia De1</th>
                                    <th>Permanencia Ate1</th>
                                    <th>Permanencia Pontos2</th>
                                    <th>Permanencia De2</th>
                                    <th>Permanencia Ate2</th>
                                    <th>Permanencia Pontos3</th>
                                    <th>Permanencia De3</th>
                                    <th>Permanencia Ate3</th>
                                    <th>Permanencia Pontos4</th>
                                    <th>Permanencia De4</th>
                                    <th>Permanencia Ate4</th>
                                    <th>Permanencia Pontos5</th>
                                    <th>Permanencia De5</th>
                                    <th>Permanencia Ate5</th>
                                    <th>Criado Em</th>
                                    <th>Editado Em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php if (!empty($registros)): ?>
                            <?php foreach ($registros as $registro): ?>
                                <tr>
                                    <td><?= $registro->nivel_fidelidade1 ?></td>
                                    <td><?= $registro->pontos_de1 ?></td>
                                    <td><?= $registro->pontos_ate1 ?></td>
                                    <td><?= $registro->nivel_fidelidade2 ?></td>
                                    <td><?= $registro->pontos_de2 ?></td>
                                    <td><?= $registro->pontos_ate2 ?></td>
                                    <td><?= $registro->nivel_fidelidade3 ?></td>
                                    <td><?= $registro->pontos_de3 ?></td>
                                    <td><?= $registro->pontos_ate3 ?></td>
                                    <td><?= $registro->nivel_fidelidade4 ?></td>
                                    <td><?= $registro->pontos_de4 ?></td>
                                    <td><?= $registro->pontos_ate4 ?></td>
                                    <td><?= $registro->faturamento_pontos1 ?></td>
                                    <td><?= $registro->valor_faturamento_de1 ?></td>
                                    <td><?= $registro->valor_faturamento_ate1 ?></td>
                                    <td><?= $registro->faturamento_pontos2 ?></td>
                                    <td><?= $registro->valor_faturamento_de2 ?></td>
                                    <td><?= $registro->valor_faturamento_ate2 ?></td>
                                    <td><?= $registro->faturamento_pontos3 ?></td>
                                    <td><?= $registro->valor_faturamento_de3 ?></td>
                                    <td><?= $registro->valor_faturamento_ate3 ?></td>
                                    <td><?= $registro->faturamento_pontos4 ?></td>
                                    <td><?= $registro->valor_faturamento_de4 ?></td>
                                    <td><?= $registro->valor_faturamento_ate4 ?></td>
                                    <td><?= $registro->faturamento_pontos5 ?></td>
                                    <td><?= $registro->valor_faturamento_de5 ?></td>
                                    <td><?= $registro->valor_faturamento_ate5 ?></td>
                                    <td><?= $registro->frequencia_pontos1 ?></td>
                                    <td><?= $registro->frequencia_de1 ?></td>
                                    <td><?= $registro->frequencia_ate1 ?></td>
                                    <td><?= $registro->frequencia_pontos2 ?></td>
                                    <td><?= $registro->frequencia_de2 ?></td>
                                    <td><?= $registro->frequencia_ate2 ?></td>
                                    <td><?= $registro->frequencia_pontos3 ?></td>
                                    <td><?= $registro->frequencia_de3 ?></td>
                                    <td><?= $registro->frequencia_ate3 ?></td>
                                    <td><?= $registro->frequencia_pontos4 ?></td>
                                    <td><?= $registro->frequencia_de4 ?></td>
                                    <td><?= $registro->frequencia_ate4 ?></td>
                                    <td><?= $registro->frequencia_pontos5 ?></td>
                                    <td><?= $registro->frequencia_de5 ?></td>
                                    <td><?= $registro->frequencia_ate5 ?></td>
                                    <td><?= $registro->permanencia_pontos1 ?></td>
                                    <td><?= $registro->permanencia_de1 ?></td>
                                    <td><?= $registro->permanencia_ate1 ?></td>
                                    <td><?= $registro->permanencia_pontos2 ?></td>
                                    <td><?= $registro->permanencia_de2 ?></td>
                                    <td><?= $registro->permanencia_ate2 ?></td>
                                    <td><?= $registro->permanencia_pontos3 ?></td>
                                    <td><?= $registro->permanencia_de3 ?></td>
                                    <td><?= $registro->permanencia_ate3 ?></td>
                                    <td><?= $registro->permanencia_pontos4 ?></td>
                                    <td><?= $registro->permanencia_de4 ?></td>
                                    <td><?= $registro->permanencia_ate4 ?></td>
                                    <td><?= $registro->permanencia_pontos5 ?></td>
                                    <td><?= $registro->permanencia_de5 ?></td>
                                    <td><?= $registro->permanencia_ate5 ?></td>
                                    <td><?= $registro->criado_em ?></td>
                                    <td><?= $registro->editado_em ?></td>
                                    <td>
                                      <?php if (service('Carol')->pode('FIDELIZES.VER')) : ?>
                                        <a href="<?= base_url('fidelizes/' . $registro->id) . '/show' ?>" class="btn btn-info btn-sm" title="Detalhes">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                      <?php endif; ?>

                                      <?php if (service('Carol')->pode('FIDELIZES.EDITAR')) : ?>
                                      <a href="<?= base_url('fidelizes/' . $registro->id . '/edit') ?>" class="btn btn-warning btn-sm" title="Editar">
                                          <i class="bi bi-pencil"></i>
                                      </a>
                                      <?php endif; ?>

                                      <?php if (service('Carol')->pode('FIDELIZES.EXCLUIR')) : ?>
                                      <form action="<?= base_url('fidelizes/' . $registro->id) ?>" method="POST" class="d-inline form-delete">
                                        <?= csrf_field() ?>
                                          <input type="hidden" name="_method" value="DELETE">
                                          <button type="submit" class="btn btn-danger btn-sm" title="Excluir">
                                              <i class="bi bi-trash"></i>
                                          </button>
                                      </form>
                                      <?php endif; ?>
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
        <div class="card-footer text-body-secondary texto-pequeno">
        </div>
    </div>
</div>
<?= $this->endSection() ?>