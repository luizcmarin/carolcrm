<div class="modal fade" id="modalGrupoSelecao" tabindex="-1" aria-labelledby="modalGrupoSelecaoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalGrupoSelecaoLabel">Selecionar Grupo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="inputBuscarGrupo" placeholder="Buscar grupo por nome...">
          <button class="btn btn-outline-secondary" type="button" id="btnPesquisarGruposModal">
            <i class="bi bi-search"></i> Buscar
          </button>
        </div>

        <div style="max-height: 350px; overflow-y: auto;">
          <div id="modalGrupoContent">
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>