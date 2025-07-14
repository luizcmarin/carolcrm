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
      <form action="<?= base_url('arquivos/' . $registros->id) ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="PUT">
                            <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="nome_arquivo" name="nome_arquivo" placeholder="Nome Arquivo" value="<?= old('nome_arquivo', esc($registros->nome_arquivo ?? '')) ?>" required>
                  <label for="nome_arquivo">Nome Arquivo</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#nome_arquivo" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.nome_arquivo')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.nome_arquivo') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="tipo_arquivo" name="tipo_arquivo" placeholder="Tipo Arquivo" value="<?= old('tipo_arquivo', esc($registros->tipo_arquivo ?? '')) ?>" >
                  <label for="tipo_arquivo">Tipo Arquivo</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#tipo_arquivo" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.tipo_arquivo')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.tipo_arquivo') ?>
                        </div>
                    <?php endif ?>
                </div>       <div class="mb-3 form-check form-switch">
                    <input type="hidden" name="sn_visivel_cliente" value="Não"> 
                    
                    <input class="form-check-input" type="checkbox" role="switch" 
                           id="sn_visivel_cliente" 
                           name="sn_visivel_cliente" 
                           value="Sim" 
                           <?php 
                               $currentValue = old('sn_visivel_cliente', esc($registros->sn_visivel_cliente ?? ''));
                               if ($currentValue === 'Sim') {
                                   echo 'checked';
                               }
                           ?> >
                    <label class="form-check-label" for="sn_visivel_cliente">Sn Visivel Cliente</label>
                    
                    <?php if (session('errors.sn_visivel_cliente')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.sn_visivel_cliente') ?>
                        </div>
                    <?php endif ?>
                </div>
                <?php if (session('errors.sn_visivel_cliente')) : ?>
                <div class="invalid-feedback d-block">
                    <?= session('errors.sn_visivel_cliente') ?>
                </div>
            <?php endif ?>
        </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="chave_anexo" name="chave_anexo" placeholder="Chave Anexo" value="<?= old('chave_anexo', esc($registros->chave_anexo ?? '')) ?>" >
                  <label for="chave_anexo">Chave Anexo</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#chave_anexo" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.chave_anexo')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.chave_anexo') ?>
                        </div>
                    <?php endif ?>
                </div>                        <div class="form-floating mb-3">
                          <select class="form-select choices-select" id="pessoa_id" name="pessoa_id" required>
                              <option value="" disabled selected><?= esc("Selecione um Pessoa Id") ?></option>
                              <?php
                              $selectedValue = old('pessoa_id', $arquivos->pessoa_id ?? '');
                              if (isset($pessoa_options) && is_array($pessoa_options)) {
                                  foreach ($pessoa_options as $optionValue => $optionLabel) {
                                      $selected = ($optionValue == $selectedValue) ? 'selected' : '';
                                      echo "<option value=\"{$optionValue}\" {$selected}>" . esc($optionLabel) . "</option>";
                                  }
                              }
                              ?>
                          </select>
                          <label for="pessoa_id" class="form-label choices-label"><?= esc('Pessoa Id') ?></label>
                          <?php if (session('errors.pessoa_id')) : ?>
                              <div class="invalid-feedback d-block">
                                  <?= session('errors.pessoa_id') ?>
                              </div>
                          <?php endif ?>
                      </div>                        <div class="form-floating mb-3">
                          <select class="form-select choices-select" id="comentario_tarefa_id" name="comentario_tarefa_id" required>
                              <option value="" disabled selected><?= esc("Selecione um Comentario Tarefa Id") ?></option>
                              <?php
                              $selectedValue = old('comentario_tarefa_id', $arquivos->comentario_tarefa_id ?? '');
                              if (isset($comentario_tarefa_options) && is_array($comentario_tarefa_options)) {
                                  foreach ($comentario_tarefa_options as $optionValue => $optionLabel) {
                                      $selected = ($optionValue == $selectedValue) ? 'selected' : '';
                                      echo "<option value=\"{$optionValue}\" {$selected}>" . esc($optionLabel) . "</option>";
                                  }
                              }
                              ?>
                          </select>
                          <label for="comentario_tarefa_id" class="form-label choices-label"><?= esc('Comentario Tarefa Id') ?></label>
                          <?php if (session('errors.comentario_tarefa_id')) : ?>
                              <div class="invalid-feedback d-block">
                                  <?= session('errors.comentario_tarefa_id') ?>
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
              <?php if (service('Carol')->pode('ARQUIVOS.EDITAR')) : ?>
              <button type="submit" class="btn btn-primary ms-1">
                  <span class="icon text-white-50">
                      <i class="bi bi-save"></i>
                  </span>
                  <span class="text">Atualizar</span>
              </button>
              <?php endif; ?>
              <a href="/arquivos" class="btn btn-secondary ms-1">
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