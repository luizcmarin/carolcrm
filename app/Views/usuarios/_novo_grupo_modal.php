<div class="modal fade" id="modalNovoGrupo" tabindex="-1" aria-labelledby="modalNovoGrupoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalNovoGrupoLabel">Criar Novo Grupo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formNovoGrupo">
          <?= csrf_field() ?>
          <div class="mb-3">
            <label for="novo_grupo_nome" class="form-label">Nome do Grupo</label>
            <input type="text" class="form-control" id="novo_grupo_nome" name="nome" required>
            <div class="invalid-feedback" id="novo_grupo_nome_error"></div>
          </div>
          <div class="alert alert-danger d-none" id="formNovoGrupoErrors"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSalvarNovoGrupo">Salvar Grupo</button>
      </div>
    </div>
  </div>
</div>