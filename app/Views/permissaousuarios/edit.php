<?= $this->extend('layout/principal') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $titulo ?></h1>
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
      <h6 class="m-0 font-weight-bold text-primary">Editar <?= $titulo ?></h6>
    </div>
    <div class="card-body">
      <form action="/permissaousuarios/update/<?= $permissaousuarios->id ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="PUT">
                                  <div class="form-floating mb-3">
                          <select class="form-select choices-select" id="usuario_id" name="usuario_id" required>
                              <option value="" disabled selected><?= esc("Selecione um Usuario Id") ?></option>
                              <?php
                              $selectedValue = old('usuario_id', $permissaousuarios->usuario_id ?? '');

                              // Itera sobre as opções que foram passadas do Controller
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
                      </div>                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="permissao" name="permissao" placeholder="Permissao" value="<?= old('permissao', $permissaousuarios->permissao) ?>" required>
                    <label for="permissao">Permissao</label>
                    <?php if (session('errors.permissao')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.permissao') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="criado_em" name="criado_em" placeholder="Criado Em" value="<?= old('criado_em', $permissaousuarios->criado_em) ?>" >
                    <label for="criado_em">Criado Em</label>
                    <?php if (session('errors.criado_em')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.criado_em') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="atualizado_em" name="atualizado_em" placeholder="Atualizado Em" value="<?= old('atualizado_em', $permissaousuarios->atualizado_em) ?>" >
                    <label for="atualizado_em">Atualizado Em</label>
                    <?php if (session('errors.atualizado_em')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.atualizado_em') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="deletado_em" name="deletado_em" placeholder="Deletado Em" value="<?= old('deletado_em', $permissaousuarios->deletado_em) ?>" >
                    <label for="deletado_em">Deletado Em</label>
                    <?php if (session('errors.deletado_em')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.deletado_em') ?>
                        </div>
                    <?php endif ?>
                </div>
          <div class="d-flex justify-content-start mt-3">
              <button type="submit" class="btn btn-primary btn-icon-split mr-2">
                  <span class="icon text-white-50">
                      <i class="fas fa-save"></i>
                  </span>
                  <span class="text">Atualizar</span>
              </button>
              <a href="/permissaousuarios" class="btn btn-secondary btn-icon-split">
                  <span class="icon text-white-50">
                      <i class="fas fa-arrow-left"></i>
                  </span>
                  <span class="text">Voltar</span>
              </a>
          </div>
      </form>
    </div>
    <div class="card-footer text-body-secondary">
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>