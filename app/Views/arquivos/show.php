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
          <p>
            <?php if (str_starts_with($registro->tipo_arquivo, 'image/')) : ?>
              <img src="<?= base_url('arquivos/thumbnail/' . $registro->id) ?>"
                alt="<?= esc($registro->nome_original) ?>" style="max-width: 100px; max-height: 100px; object-fit: contain;"
                onerror="this.onerror=null;this.src='/img/sem-imagem.png';">
            <?php else : ?>
              <!-- Ícone para outros tipos de arquivo -->
              <i class="bi bi-file-earmark-text" style="font-size: 50px;"></i>
            <?php endif; ?>
          </p>
          <p><strong>Descrição:</strong> <?= $registro->descricao ?></p>
          <p><strong>Nome Arquivo:</strong> <?= $registro->nome_arquivo ?></p>
          <p><strong>Nome Original:</strong> <?= $registro->nome_original ?></p>
          <p><strong>Tipo Arquivo:</strong> <?= $registro->tipo_arquivo ?></p>
          <p><strong>Tamanho:</strong> <?= number_format($registro->tamanho_bytes / 1024, 2) ?> KB</p>
          <p><strong>Caminho Servidor:</strong> <?= $registro->caminho_servidor ?></p>
          <p><strong>Url Publica:</strong> <?= $registro->url_publica ?></p>
          <p><strong>Entidade:</strong> <?= $registro->entidade_tipo . ' (' . ($registro->entidade_nome ?? 'N/A') . ')' ?></p>
          <p><strong>Visível para o cliente:</strong> <?= $registro->sn_visivel_cliente ?></p>
          <div class="d-flex justify-content-start mt-4">
            <?php if (service('Carol')->pode('ARQUIVOS.DOWNLOAD') && $registro->file_exists) : ?>
              <a href="<?= base_url('arquivos/download/' . $registro->id) ?>" class="btn btn-primary ms-1" title="Download">
                <span class="icon text-white-50">
                  <i class="bi bi-cloud-download"></i>
                </span>
                <span class="text">Download</span>
              </a>
            <?php endif; ?>
            <?php if (service('Carol')->pode('ARQUIVOS.EDITAR')) : ?>
              <a href="/arquivos/<?= $registro->id ?>/edit ?>" class="btn btn-warning ms-1">
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
          <p class="mb-0">Criado em: <?= $registro->criado_em ?></p>
          <p class="mb-0">Editado em: <?= $registro->editado_em ?></p>
        </div>
      </div>
    </div>

    <?= $this->endSection() ?>