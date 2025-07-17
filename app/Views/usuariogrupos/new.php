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
      <form action="<?= base_url('usuariogrupos') ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-floating mb-3 position-relative input-with-copy">
          <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?= old('nome') ?>" required>
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
        </div>
        <div class="d-flex justify-content-start mt-3">
          <?php if (service('Carol')->pode('USUARIOGRUPOS.NOVO')) : ?>
            <button type="submit" class="btn btn-primary ms-1">
              <span class="icon text-white-50">
                <i class="bi bi-save"></i>
              </span>
              <span class="text">Salvar</span>
            </button>
          <?php endif; ?>
          <a href="/UsuarioGrupos" class="btn btn-secondary ms-1">
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