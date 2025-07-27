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
      <form action="<?= base_url('logatividades') ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-floating mb-3 position-relative input-with-copy">
          <input type="text" class="form-control" id="nome_usuario" name="nome_usuario" placeholder="Usuário" value="<?= old('nome_usuario') ?>" required>
          <label for="nome_usuario">Usuário</label>
          <button class="btn btn-sm btn-light copy-button-textarea" type="button"
            data-clipboard-target="#nome_usuario"
            title="Copiar">
            <i class="bi bi-clipboard"></i>
          </button>
          <span class="copy-feedback-message-external"></span>
          <?php if (session('errors.nome_usuario')) : ?>
            <div class="invalid-feedback d-block">
              <?= session('errors.nome_usuario') ?>
            </div>
          <?php endif ?>
        </div>
        <div class="form-floating mb-3 position-relative input-with-copy">
          <input type="text" class="form-control" id="atividade" name="atividade" placeholder="Atividade" value="<?= old('atividade') ?>" required>
          <label for="atividade">Atividade</label>
          <button class="btn btn-sm btn-light copy-button-textarea" type="button"
            data-clipboard-target="#atividade"
            title="Copiar">
            <i class="bi bi-clipboard"></i>
          </button>
          <span class="copy-feedback-message-external"></span>
          <?php if (session('errors.atividade')) : ?>
            <div class="invalid-feedback d-block">
              <?= session('errors.atividade') ?>
            </div>
          <?php endif ?>
        </div>
        <div class="d-flex justify-content-start mt-3">
          <?php if (service('Carol')->pode('LOGATIVIDADES.NOVO')) : ?>
            <button type="submit" class="btn btn-primary ms-1">
              <span class="icon text-white-50">
                <i class="bi bi-save"></i>
              </span>
              <span class="text">Salvar</span>
            </button>
          <?php endif; ?>
          <a href="/logatividades" class="btn btn-secondary ms-1">
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