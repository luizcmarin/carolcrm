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
              <p><strong>Iso2:</strong> <?= $registros->iso2 ?></p>    <p><strong>Nome Curto:</strong> <?= $registros->nome_curto ?></p>    <p><strong>Nome Longo:</strong> <?= $registros->nome_longo ?></p>    <p><strong>Iso3:</strong> <?= $registros->iso3 ?></p>    <p><strong>Codigo Numerico:</strong> <?= $registros->codigo_numerico ?></p>    <p><strong>Codigo Chamada:</strong> <?= $registros->codigo_chamada ?></p>    <p><strong>Cctld:</strong> <?= $registros->cctld ?></p>    <p><strong>Criado Em:</strong> <?= $registros->criado_em ?></p>    <p><strong>Editado Em:</strong> <?= $registros->editado_em ?></p>
          <div class="d-flex justify-content-start mt-4">
              <?php if (service('Carol')->pode('PAISES.EDITAR')) : ?>
              <a href="/paises/<?= $registros->id ?>/edit ?>" class="btn btn-warning ms-1">
                  <span class="icon text-white-50">
                      <i class="bi bi-pencil"></i>
                  </span>
                  <span class="text">Editar</span>
              </a>
              <?php endif; ?>
              <a href="/paises" class="btn btn-secondary ms-1">
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