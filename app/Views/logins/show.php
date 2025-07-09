    <?= $this->extend('layout/principal') ?>
    <?= $this->section('content') ?>

    <div class="container-fluid">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $titulo ?></h1>
      </div>

      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Detalhes de <?= $titulo ?></h6>
        </div>
        <div class="card-body">
              <p><strong>Endereco Ip:</strong> <?= $logins->endereco_ip ?></p>    <p><strong>User Agent:</strong> <?= $logins->user_agent ?></p>    <p><strong>Usuario:</strong> <?= $logins->usuario ?></p>    <p><strong>Data Tentativa:</strong> <?= $logins->data_tentativa ?></p>    <p><strong>Sucesso:</strong> <?= $logins->sucesso ?></p>    <p><strong>Criado Em:</strong> <?= $logins->criado_em ?></p>    <p><strong>Atualizado Em:</strong> <?= $logins->atualizado_em ?></p>    <p><strong>Deletado Em:</strong> <?= $logins->deletado_em ?></p>
        </div>
        <div class="card-footer d-flex justify-content-start">
            <a href="/logins/edit/<?= $logins->id ?>" class="btn btn-warning btn-icon-split mr-2">
                <span class="icon text-white-50">
                    <i class="fas fa-pencil-alt"></i>
                </span>
                <span class="text">Editar</span>
            </a>
            <a href="/logins" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Voltar</span>
            </a>
        </div>
      </div>
    </div>

    <?= $this->endSection() ?>