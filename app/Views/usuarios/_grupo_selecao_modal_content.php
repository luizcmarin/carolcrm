<?php if (!empty($grupos)) : ?>
  <div class="table-responsive">
    <table class="table table-bordered table-striped" id="tabelaGruposModal">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($grupos as $grupo) : ?>
          <tr>
            <td><?= esc($grupo->id) ?></td>
            <td><?= esc($grupo->nome) ?></td>
            <td>
              <button class="btn btn-primary btn-sm btn-selecionar-grupo"
                data-id="<?= esc($grupo->id) ?>"
                data-nome="<?= esc($grupo->nome) ?>">
                <i class="bi bi-check-lg"></i> Selecionar
              </button>
              <button class="btn btn-danger btn-sm btn-excluir-grupo ms-2"
                data-id="<?= esc($grupo->id) ?>"
                data-nome="<?= esc($grupo->nome) ?>">
                <i class="bi bi-trash"></i> Excluir
              </button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div id="noGroupsFound" class="alert alert-info text-center mt-3 d-none">
    Nenhum grupo encontrado.
  </div>

<?php else : ?>
  <div id="noGroupsFound" class="alert alert-info text-center mt-3">
    Nenhum grupo encontrado.
  </div>
<?php endif; ?>