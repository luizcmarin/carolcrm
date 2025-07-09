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
      <form action="/logins/update/<?= $logins->id ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="PUT">
                         <div class="form-floating mb-3 position-relative"> 
                <textarea class="form-control" id="endereco_ip" name="endereco_ip" placeholder="Endereco Ip" style="height: 100px" >
                    <?= old('endereco_ip', (isset($value) && $value !== null) ? esc($value) : '') ?>
                </textarea>
                <label for="endereco_ip">Endereco Ip</label>
                <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                        data-clipboard-target="#endereco_ip" 
                        title="Copiar">
                    <i class="bi bi-clipboard"></i> </button>
                <?php if (session('errors.endereco_ip')) : ?>
                    <div class="invalid-feedback d-block">
                        <?= session('errors.endereco_ip') ?>
                    </div>
                <?php endif ?>
            </div>               <div class="form-floating mb-3 position-relative"> 
                <textarea class="form-control" id="user_agent" name="user_agent" placeholder="User Agent" style="height: 100px" >
                    <?= old('user_agent', (isset($value) && $value !== null) ? esc($value) : '') ?>
                </textarea>
                <label for="user_agent">User Agent</label>
                <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                        data-clipboard-target="#user_agent" 
                        title="Copiar">
                    <i class="bi bi-clipboard"></i> </button>
                <?php if (session('errors.user_agent')) : ?>
                    <div class="invalid-feedback d-block">
                        <?= session('errors.user_agent') ?>
                    </div>
                <?php endif ?>
            </div>               <div class="form-floating mb-3 position-relative"> 
                <textarea class="form-control" id="usuario" name="usuario" placeholder="Usuario" style="height: 100px" >
                    <?= old('usuario', (isset($value) && $value !== null) ? esc($value) : '') ?>
                </textarea>
                <label for="usuario">Usuario</label>
                <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                        data-clipboard-target="#usuario" 
                        title="Copiar">
                    <i class="bi bi-clipboard"></i> </button>
                <?php if (session('errors.usuario')) : ?>
                    <div class="invalid-feedback d-block">
                        <?= session('errors.usuario') ?>
                    </div>
                <?php endif ?>
            </div>                <div class="form-floating mb-3">
                    <input type="date" class="form-control datepicker-input" id="data_tentativa" name="data_tentativa" placeholder="Data Tentativa" 
                        value="<?= old('data_tentativa', $value ?? '') ?>" 
                        >
                    <label for="data_tentativa">Data Tentativa</label>
                    <?php if (session('errors.data_tentativa')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.data_tentativa') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="sucesso" name="sucesso" placeholder="Sucesso" value="<?= old('sucesso', $logins->sucesso) ?>" >
                    <label for="sucesso">Sucesso</label>
                    <?php if (session('errors.sucesso')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.sucesso') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="criado_em" name="criado_em" placeholder="Criado Em" value="<?= old('criado_em', $logins->criado_em) ?>" >
                    <label for="criado_em">Criado Em</label>
                    <?php if (session('errors.criado_em')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.criado_em') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="atualizado_em" name="atualizado_em" placeholder="Atualizado Em" value="<?= old('atualizado_em', $logins->atualizado_em) ?>" >
                    <label for="atualizado_em">Atualizado Em</label>
                    <?php if (session('errors.atualizado_em')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.atualizado_em') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="deletado_em" name="deletado_em" placeholder="Deletado Em" value="<?= old('deletado_em', $logins->deletado_em) ?>" >
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
              <a href="/logins" class="btn btn-secondary btn-icon-split">
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