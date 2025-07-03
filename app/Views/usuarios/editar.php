<?= $this->extend('layout/main') ?>
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
      <h6 class="m-0 font-weight-bold text-primary"><?= $titulo ?></h6>
    </div>
    <div class="card-body">
      <form action="<?= base_url('usuarios/update/' . $usuario->id) ?>" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">
        <div class="mb-3">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" class="form-control" id="nome" name="nome"
            value="<?= old('nome', $usuario->nome ?? '') ?>" required autofocus>
        </div>

        <div class="mb-3">
          <label for="grupo_usuario_nome_display" class="form-label">Grupo do Usuário</label>
          <div class="input-group">
            <input type="hidden" name="grupo_usuario_id" id="grupo_usuario_id_input"
              value="<?= old('grupo_usuario_id', $usuario->grupo_usuario_id ?? '') ?>" required>

            <input type="text" class="form-control" id="grupo_usuario_nome_display"
              value="<?= old('grupo_usuario_nome_display', $usuario->grupo->nome ?? '') ?>" readonly
              placeholder="Selecione ou crie um grupo">

            <button class="btn btn-outline-secondary" type="button" id="btnBuscarGrupo" data-bs-toggle="tooltip" title="Buscar Grupo">
              <i class="bi bi-search"></i> </button>

            <button class="btn btn-outline-success" type="button" id="btnNovoGrupo" data-bs-toggle="tooltip" title="Novo Grupo">
              <i class="bi bi-plus-lg"></i> </button>
          </div>
          <?php if (session('errors.grupo_usuario_id')) : ?>
            <div class="invalid-feedback d-block">
              <?= session('errors.grupo_usuario_id') ?>
            </div>
          <?php endif ?>
        </div>

        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-control" id="status" name="status">
            <option value="">Selecione...</option>
            <?php foreach ($opcoesStatus as $opcao) : ?>
              <option value="<?= esc($opcao) ?>"
                <?= old('status', $usuario->status ?? '') === $opcao ? 'selected' : '' ?>>
                <?= esc($opcao) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="mensagem_status" class="form-label">Mensagem Status</label>
          <textarea class="form-control" id="mensagem_status" name="mensagem_status" rows="3"><?= old('mensagem_status', $usuario->mensagem_status ?? '') ?></textarea>
        </div>


        <div class="mb-3">
          <label class="form-label" for="ativoSwitch">Ativo</label>
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="ativoSwitch" name="ativo" value="Sim" role="switch"
              <?= (old('ativo', $usuario->ativo ?? 'Não') === 'Sim') ? 'checked' : '' ?>>
            <label class="form-check-label ativo-switch-label" for="ativoSwitch"
              data-label-on="Sim" data-label-off="Não">
              <?= (old('ativo', $usuario->ativo ?? 'Não') === 'Sim') ? 'Sim' : 'Não' ?>
            </label>
          </div>
        </div>


        <button type="submit" class="btn btn-primary">Atualizar Usuário</button>
        <a href="<?= base_url('usuarios') ?>" class="btn btn-secondary">Voltar</a>
      </form>
    </div>
  </div>
</div>

<?= $this->include('usuarios/_grupo_selecao_modal') ?>
<?= $this->include('usuarios/_novo_grupo_modal') ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('js/usuarios.js') ?>"></script>
<?= $this->endSection() ?>