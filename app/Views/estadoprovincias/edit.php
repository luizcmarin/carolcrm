<?= $this->extend('layout/principal') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h5 class="mb-0 text-primary-emphasis"><?= $titulo ?></h5>
  </div>

  <?php if (session()->has('errors')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <ul class="mb-0">
        <?php foreach (session('errors') as $error) : ?>
          <li><?= $error ?></li>
        <?php endforeach; ?>
      </ul>
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
      <h6 class="m-0 text-primary-emphasis">Editar</h6>
    </div>
    <div class="card-body">
      <form action="<?= base_url('estadoprovincias/' . $registros->id) ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="PUT">
                            <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?= old('nome', esc($registros->nome ?? '')) ?>" required>
                  <label for="nome">Nome</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#nome" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.nome')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.nome') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="abreviatura" name="abreviatura" placeholder="Abreviatura" value="<?= old('abreviatura', esc($registros->abreviatura ?? '')) ?>" >
                  <label for="abreviatura">Abreviatura</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#abreviatura" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.abreviatura')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.abreviatura') ?>
                        </div>
                    <?php endif ?>
                </div>                        <div class="form-floating mb-3">
                          <select class="form-select choices-select" id="pais_id" name="pais_id" required>
                              <option value="" disabled selected><?= esc("Selecione um Pais Id") ?></option>
                              <?php
                              $selectedValue = old('pais_id', $estadoprovincias->pais_id ?? '');
                              if (isset($pais_options) && is_array($pais_options)) {
                                  foreach ($pais_options as $optionValue => $optionLabel) {
                                      $selected = ($optionValue == $selectedValue) ? 'selected' : '';
                                      echo "<option value=\"{$optionValue}\" {$selected}>" . esc($optionLabel) . "</option>";
                                  }
                              }
                              ?>
                          </select>
                          <label for="pais_id" class="form-label choices-label"><?= esc('Pais Id') ?></label>
                          <?php if (session('errors.pais_id')) : ?>
                              <div class="invalid-feedback d-block">
                                  <?= session('errors.pais_id') ?>
                              </div>
                          <?php endif ?>
                      </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="criado_em" name="criado_em" placeholder="Criado Em" value="<?= old('criado_em', esc($registros->criado_em ?? '')) ?>" >
                  <label for="criado_em">Criado Em</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#criado_em" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.criado_em')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.criado_em') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="editado_em" name="editado_em" placeholder="Editado Em" value="<?= old('editado_em', esc($registros->editado_em ?? '')) ?>" >
                  <label for="editado_em">Editado Em</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#editado_em" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.editado_em')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.editado_em') ?>
                        </div>
                    <?php endif ?>
                </div>
          <div class="d-flex justify-content-start mt-3">
              <?php if (service('Carol')->pode('ESTADOPROVINCIAS.EDITAR')) : ?>
              <button type="submit" class="btn btn-primary ms-1">
                  <span class="icon text-white-50">
                      <i class="bi bi-save"></i>
                  </span>
                  <span class="text">Atualizar</span>
              </button>
              <?php endif; ?>
              <a href="/estadoprovincias" class="btn btn-secondary ms-1">
                  <span class="icon text-white-50">
                      <i class="bi bi-arrow-left"></i>
                  </span>
                  <span class="text">Voltar</span>
              </a>
          </div>
      </form>
    </div>
    <div class="card-footer text-body-secondary texto-pequeno">
      <p class="mb-0">Criado em: <?= $registros->criado_em ?></p>
      <p class="mb-0">Editado em: <?= $registros->editado_em ?></p>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>