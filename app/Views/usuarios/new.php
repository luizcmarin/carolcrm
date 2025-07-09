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
      <h6 class="m-0 font-weight-bold text-primary">Criar <?= $titulo ?></h6>
    </div>
    <div class="card-body">
      <form action="/usuarios/create" method="post">
          <?= csrf_field() ?>
                <div class="form-floating mb-3">
        <select class="form-select choices-select" id="grupo_usuario_id" name="grupo_usuario_id" required>
            <option value="" disabled selected><?= esc("Selecione um Grupo Usuario Id") ?></option>
            <?php
            $selectedValue = old('grupo_usuario_id', $usuarios->grupo_usuario_id ?? '');

            // Itera sobre as opções que foram passadas do Controller
            if (isset($grupo_usuario_options) && is_array($grupo_usuario_options)) {
                foreach ($grupo_usuario_options as $optionValue => $optionLabel) {
                    $selected = ($optionValue == $selectedValue) ? 'selected' : '';
                    echo "<option value=\"{$optionValue}\" {$selected}>" . esc($optionLabel) . "</option>";
                }
            }
            ?>
        </select>
        <label for="grupo_usuario_id" class="form-label choices-label"><?= esc('Grupo Usuario Id') ?></label>
        <?php if (session('errors.grupo_usuario_id')) : ?>
            <div class="invalid-feedback d-block">
                <?= session('errors.grupo_usuario_id') ?>
            </div>
        <?php endif ?>
    </div>                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?= old('nome') ?>" required>
                    <label for="nome">Nome</label>
                    <?php if (session('errors.nome')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.nome') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative"> 
                    <textarea class="form-control" id="status" name="status" placeholder="Status" style="height: 100px" >
                    </textarea>
                    <label for="status">Status</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#status" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <?php if (session('errors.status')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.status') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative"> 
                    <textarea class="form-control" id="mensagem_status" name="mensagem_status" placeholder="Mensagem Status" style="height: 100px" >
                    </textarea>
                    <label for="mensagem_status">Mensagem Status</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#mensagem_status" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <?php if (session('errors.mensagem_status')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.mensagem_status') ?>
                        </div>
                    <?php endif ?>
                </div>        <div class="mb-3 form-check form-switch">
            <input type="hidden" name="ativo" value="Não"> 
            
            <input class="form-check-input" type="checkbox" role="switch" 
                   id="ativo" 
                   name="ativo" 
                   value="Não" 
                   >
            <label class="form-check-label" for="ativo">Ativo</label>
            
            <?php if (session('errors.ativo')) : ?>
                <div class="invalid-feedback d-block">
                    <?= session('errors.ativo') ?>
                </div>
            <?php endif ?>
        </div>                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="ultimo_acesso" name="ultimo_acesso" placeholder="Ultimo Acesso" value="<?= old('ultimo_acesso') ?>" >
                    <label for="ultimo_acesso">Ultimo Acesso</label>
                    <?php if (session('errors.ultimo_acesso')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.ultimo_acesso') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="criado_em" name="criado_em" placeholder="Criado Em" value="<?= old('criado_em') ?>" >
                    <label for="criado_em">Criado Em</label>
                    <?php if (session('errors.criado_em')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.criado_em') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="atualizado_em" name="atualizado_em" placeholder="Atualizado Em" value="<?= old('atualizado_em') ?>" >
                    <label for="atualizado_em">Atualizado Em</label>
                    <?php if (session('errors.atualizado_em')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.atualizado_em') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="deletado_em" name="deletado_em" placeholder="Deletado Em" value="<?= old('deletado_em') ?>" >
                    <label for="deletado_em">Deletado Em</label>
                    <?php if (session('errors.deletado_em')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.deletado_em') ?>
                        </div>
                    <?php endif ?>
                </div>                  <div class="form-floating mb-3 position-relative"> 
                    <textarea class="form-control" id="expira_em" name="expira_em" placeholder="Expira Em" style="height: 100px" >
                    </textarea>
                    <label for="expira_em">Expira Em</label>
                    <button class="btn btn-sm btn-light copy-button-textarea" type="button" 
                            data-clipboard-target="#expira_em" 
                            title="Copiar">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <?php if (session('errors.expira_em')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.expira_em') ?>
                        </div>
                    <?php endif ?>
                </div>                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="senha" name="senha" placeholder="Senha" value="<?= old('senha') ?>" >
                    <label for="senha">Senha</label>
                    <?php if (session('errors.senha')) : ?>
                        <div class="invalid-feedback d-block">
                            <?= session('errors.senha') ?>
                        </div>
                    <?php endif ?>
                </div>
          <div class="d-flex justify-content-start mt-3">
              <button type="submit" class="btn btn-primary btn-icon-split mr-2">
                  <span class="icon text-white-50">
                      <i class="fas fa-save"></i>
                  </span>
                  <span class="text">Salvar</span>
              </button>
              <a href="/usuarios" class="btn btn-secondary btn-icon-split">
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