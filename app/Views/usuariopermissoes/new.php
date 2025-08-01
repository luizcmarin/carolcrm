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
      <h6 class="m-0 text-primary-emphasis">Novo</h6>
    </div>
    <div class="card-body">
      <form action="<?= base_url('usuariopermissoes') ?>" method="post">
          <?= csrf_field() ?>
                <div class="form-floating mb-3">
        <select class="form-select choices-select" id="usuario_id" name="usuario_id" required>
            <option value="" disabled selected><?= esc("Selecione um Usuario Id") ?></option>
            <?php
            $selectedValue = old('usuario_id', $usuariopermissoes->usuario_id ?? '');
            if (isset($usuario_options) && is_array($usuario_options)) {
                foreach ($usuario_options as $optionValue => $optionLabel) {
                    $selected = ($optionValue == $selectedValue) ? 'selected' : '';
                    echo "<option value=\"{$optionValue}\" {$selected}>" . esc($optionLabel) . "</option>";
                }
            }
            ?>
        </select>
        <label for="usuario_id" class="form-label choices-label"><?= esc('Usuario Id') ?></label>
        <?php if (session('errors.usuario_id')) : ?>
            <div class="invalid-feedback d-block">
                <?= session('errors.usuario_id') ?>
            </div>
        <?php endif ?>
    </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Categoria" value="<?= old('categoria') ?>" required>
                  <label for="categoria">Categoria</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#categoria" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.categoria')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.categoria') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="chave" name="chave" placeholder="Chave" value="<?= old('chave') ?>" required>
                  <label for="chave">Chave</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#chave" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span class="copy-feedback-message-external"></span>
                    <?php if (session('errors.chave')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.chave') ?>
                        </div>
                    <?php endif ?>
                </div>        <div class="mb-3 form-check form-switch">
            <input type="hidden" name="sn_ativo" value="Não"> 
            
            <input class="form-check-input" type="checkbox" role="switch" 
                   id="sn_ativo" 
                   name="sn_ativo" 
                   value="Não" 
                   >
            <label class="form-check-label" for="sn_ativo">Sn Ativo</label>
            
            <?php if (session('errors.sn_ativo')) : ?>
                <div class="invalid-feedback d-block">
                    <?= session('errors.sn_ativo') ?>
                </div>
            <?php endif ?>
        </div>                  <div class="form-floating mb-3 position-relative input-with-copy"> 
                  <input type="text" class="form-control" id="criado_em" name="criado_em" placeholder="Criado Em" value="<?= old('criado_em') ?>" >
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
                  <input type="text" class="form-control" id="editado_em" name="editado_em" placeholder="Editado Em" value="<?= old('editado_em') ?>" >
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
              <?php if (service('Carol')->pode('USUARIOPERMISSOES.NOVO')) : ?>
              <button type="submit" class="btn btn-primary ms-1">
                  <span class="icon text-white-50">
                      <i class="bi bi-save"></i>
                  </span>
                  <span class="text">Salvar</span>
              </button>
              <?php endif; ?>
              <a href="/usuariopermissoes" class="btn btn-secondary ms-1">
                  <span class="icon text-white-50">
                      <i class="bi bi-arrow-left"></i>
                  </span>
                  <span class="text">Voltar</span>
              </a>
          </div>
      </form>
    </div>
    <div class="card-footer text-body-secondary texto-pequeno">
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>