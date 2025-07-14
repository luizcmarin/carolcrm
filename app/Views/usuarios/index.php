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
                <?php if (service('Carol')->pode('USUARIOS.NOVO')) : ?>
                <a href="<?= base_url('usuarios/new') ?>" class="btn btn-primary shadow-sm">
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
                            <th>Nome</th>
                                    <th>Usuario Grupo Id</th>
                                    <th>Celular</th>
                                    <th>Telefone</th>
                                    <th>Email</th>
                                    <th>Imagem Perfil</th>
                                    <th>Sobre</th>
                                    <th>Endereco</th>
                                    <th>Bairro</th>
                                    <th>Cidade Id</th>
                                    <th>Cep</th>
                                    <th>Complemento</th>
                                    <th>Redes Sociais</th>
                                    <th>Genero</th>
                                    <th>Cpf</th>
                                    <th>Documentos</th>
                                    <th>Cargo Id</th>
                                    <th>Profissao Id</th>
                                    <th>Nacionalidade Id</th>
                                    <th>Assinatura Email</th>
                                    <th>Senha</th>
                                    <th>Ultimo Ip</th>
                                    <th>Data Ultimo Login</th>
                                    <th>Sn Administrador</th>
                                    <th>Sn Ativo</th>
                                    <th>Criado Em</th>
                                    <th>Editado Em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php if (!empty($registros)): ?>
                            <?php foreach ($registros as $registro): ?>
                                <tr>
                                    <td><?= $registro->nome ?></td>
                                    <td><?= $registro->usuario_grupo_id ?></td>
                                    <td><?= $registro->celular ?></td>
                                    <td><?= $registro->telefone ?></td>
                                    <td><?= $registro->email ?></td>
                                    <td><?= $registro->imagem_perfil ?></td>
                                    <td><?= $registro->sobre ?></td>
                                    <td><?= $registro->endereco ?></td>
                                    <td><?= $registro->bairro ?></td>
                                    <td><?= $registro->cidade_id ?></td>
                                    <td><?= $registro->cep ?></td>
                                    <td><?= $registro->complemento ?></td>
                                    <td><?= $registro->redes_sociais ?></td>
                                    <td><?= $registro->genero ?></td>
                                    <td><?= $registro->cpf ?></td>
                                    <td><?= $registro->documentos ?></td>
                                    <td><?= $registro->cargo_id ?></td>
                                    <td><?= $registro->profissao_id ?></td>
                                    <td><?= $registro->nacionalidade_id ?></td>
                                    <td><?= $registro->assinatura_email ?></td>
                                    <td><?= $registro->senha ?></td>
                                    <td><?= $registro->ultimo_ip ?></td>
                                    <td><?= $registro->data_ultimo_login ?></td>
                                    <td><?= $registro->sn_administrador ?></td>
                                    <td><?= $registro->sn_ativo ?></td>
                                    <td><?= $registro->criado_em ?></td>
                                    <td><?= $registro->editado_em ?></td>
                                    <td>
                                      <?php if (service('Carol')->pode('USUARIOS.VER')) : ?>
                                        <a href="<?= base_url('usuarios/' . $registro->id) . '/show' ?>" class="btn btn-info btn-sm" title="Detalhes">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                      <?php endif; ?>

                                      <?php if (service('Carol')->pode('USUARIOS.EDITAR')) : ?>
                                      <a href="<?= base_url('usuarios/' . $registro->id . '/edit') ?>" class="btn btn-warning btn-sm" title="Editar">
                                          <i class="bi bi-pencil"></i>
                                      </a>
                                      <?php endif; ?>

                                      <?php if (service('Carol')->pode('USUARIOS.EXCLUIR')) : ?>
                                      <form action="<?= base_url('usuarios/' . $registro->id) ?>" method="POST" class="d-inline form-delete">
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