    <?= $this->extend('layout/principal') ?>
    <?= $this->section('content') ?>

    <div class="container-fluid">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h5 class="mb-0 text-primary-emphasis"><?= $titulo ?></h5>
      </div>

      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 text-primary-emphasis">Detalhes</h6>
        </div>
        <div class="card-body">
              <p><strong>Nome Arquivo:</strong> <?= $registros->nome_arquivo ?></p>    <p><strong>Tipo Arquivo:</strong> <?= $registros->tipo_arquivo ?></p>    <p><strong>Sn Visivel Cliente:</strong> <?= $registros->sn_visivel_cliente ?></p>    <p><strong>Chave Anexo:</strong> <?= $registros->chave_anexo ?></p>    <p><strong>Pessoa Id:</strong> <?= $registros->pessoa_nome ?? 'N/A' ?></p>    <p><strong>Comentario Tarefa Id:</strong> <?= $registros->comentario_tarefa_nome ?? 'N/A' ?></p>    <p><strong>Criado Em:</strong> <?= $registros->criado_em ?></p>    <p><strong>Editado Em:</strong> <?= $registros->editado_em ?></p>
          <div class="d-flex justify-content-start mt-4">
              <?php if (service('Carol')->pode('ARQUIVOS.EDITAR')) : ?>
              <a href="/arquivos/<?= $registros->id ?>/edit ?>" class="btn btn-warning ms-1">
                  <span class="icon text-white-50">
                      <i class="bi bi-pencil"></i>
                  </span>
                  <span class="text">Editar</span>
              </a>
              <?php endif; ?>
              <a href="/arquivos" class="btn btn-secondary ms-1">
                  <span class="icon text-white-50">
                      <i class="bi bi-arrow-left"></i>
                  </span>
                  <span class="text">Voltar</span>
              </a>
          </div>
        </div>
        <div class="card-footer text-body-secondary texto-pequeno">
          <p class="mb-0">Criado em: <?= $registros->criado_em ?></p>
          <p class="mb-0">Editado em: <?= $registros->editado_em ?></p>
        </div>
      </div>
    </div>

    <?= $this->endSection() ?>