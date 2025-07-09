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
              <p><strong>Grupo Usuario Id:</strong> <?= $usuarios->grupo_usuario_nome ?? 'N/A' ?></p>    <p><strong>Nome:</strong> <?= $usuarios->nome ?></p>    <p><strong>Status:</strong> <?= $usuarios->status ?></p>    <p><strong>Mensagem Status:</strong> <?= $usuarios->mensagem_status ?></p>    <p><strong>Ativo:</strong> <?= $usuarios->ativo ?></p>    <p><strong>Ultimo Acesso:</strong> <?= $usuarios->ultimo_acesso ?></p>    <p><strong>Criado Em:</strong> <?= $usuarios->criado_em ?></p>    <p><strong>Atualizado Em:</strong> <?= $usuarios->atualizado_em ?></p>    <p><strong>Deletado Em:</strong> <?= $usuarios->deletado_em ?></p>    <p><strong>Expira Em:</strong> <?= $usuarios->expira_em ?></p>    <p><strong>Senha:</strong> <?= $usuarios->senha ?></p>
        </div>
        <div class="card-footer d-flex justify-content-start">
            <a href="/usuarios/edit/<?= $usuarios->id ?>" class="btn btn-warning btn-icon-split mr-2">
                <span class="icon text-white-50">
                    <i class="fas fa-pencil-alt"></i>
                </span>
                <span class="text">Editar</span>
            </a>
            <a href="/usuarios" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Voltar</span>
            </a>
        </div>
      </div>
    </div>

    <?= $this->endSection() ?>