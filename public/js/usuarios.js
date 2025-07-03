// public/assets/js/usuarios.js

// BASE_URL deve ser definida globalmente, por exemplo, no seu layout principal
// Ex: <script>const BASE_URL = "<?= base_url(); ?>";</script>

// ============================================================================
// FUNÇÕES GLOBAIS - Acessíveis de qualquer lugar
// ============================================================================

/**
 * Função para carregar grupos no modal de seleção, com busca (sem paginação).
 * @param {string} search Termo de busca.
 */
window.carregarGruposNoModal = function (search = '') {
  const modalGrupoContent = document.getElementById('modalGrupoContent');
  if (!modalGrupoContent) {
    console.error("Elemento '#modalGrupoContent' não encontrado. Não é possível carregar grupos.");
    return;
  }

  const url = `${BASE_URL}usuarios/buscarGrupoModal?search=${encodeURIComponent(search)}`;

  modalGrupoContent.innerHTML = '<div class="text-center p-4"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Carregando...</span></div></div>';

  fetch(url, {
    method: 'GET',
    headers: {
      'X-Requested-With': 'XMLHttpRequest' // Cabeçalho crucial para o isAJAX() do CodeIgniter
    }
  })
    .then(response => {
      if (!response.ok) {
        if (response.status === 403) {
          throw new Error('Acesso negado (403): O servidor não permitiu a requisição. Verifique o cabeçalho X-Requested-With.');
        }
        throw new Error('Erro na requisição: ' + response.statusText);
      }
      return response.text();
    })
    .then(html => {
      modalGrupoContent.innerHTML = html; // Insere o HTML completo (tabela)
      // Os listeners de "Selecionar" e "Excluir" estão agora no DOMContentLoaded,
      // usando delegação, então não precisamos de script aqui.
    })
    .catch(error => {
      console.error('Erro ao carregar grupos:', error);
      modalGrupoContent.innerHTML = `<div class="alert alert-danger text-center mt-3">${error.message || 'Erro ao carregar grupos. Tente novamente.'}</div>`;
    });
};


// ============================================================================
// LISTENERS PRINCIPAIS - Executados uma vez quando o DOM é carregado
// ============================================================================
document.addEventListener('DOMContentLoaded', function () {
  const btnBuscarGrupo = document.getElementById('btnBuscarGrupo');
  const btnNovoGrupo = document.getElementById('btnNovoGrupo');
  const modalGrupoSelecao = new bootstrap.Modal(document.getElementById('modalGrupoSelecao'));
  const modalNovoGrupo = new bootstrap.Modal(document.getElementById('modalNovoGrupo'));

  const grupoUsuarioIdInput = document.getElementById('grupo_usuario_id_input');
  const grupoUsuarioNomeDisplay = document.getElementById('grupo_usuario_nome_display');

  const inputBuscarGrupoModal = document.getElementById('inputBuscarGrupo');
  const btnPesquisarGruposModal = document.getElementById('btnPesquisarGruposModal');
  const modalGrupoContent = document.getElementById('modalGrupoContent'); // Elemento pai para delegação

  const formNovoGrupo = document.getElementById('formNovoGrupo');
  const btnSalvarNovoGrupo = document.getElementById('btnSalvarNovoGrupo');
  const novoGrupoNomeInput = document.getElementById('novo_grupo_nome');
  const novoGrupoNomeErrorDiv = document.getElementById('novo_grupo_nome_error');
  const formNovoGrupoErrorsDiv = document.getElementById('formNovoGrupoErrors');

  // Evento para abrir o modal de seleção de grupo
  if (btnBuscarGrupo) {
    btnBuscarGrupo.addEventListener('click', function () {
      inputBuscarGrupoModal.value = '';
      window.carregarGruposNoModal();
      modalGrupoSelecao.show();
    });
  }

  // Evento para pesquisar grupos no modal (ao clicar no botão ou pressionar Enter)
  if (btnPesquisarGruposModal) {
    btnPesquisarGruposModal.addEventListener('click', function () {
      window.carregarGruposNoModal(inputBuscarGrupoModal.value);
    });
    inputBuscarGrupoModal.addEventListener('keypress', function (e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        window.carregarGruposNoModal(inputBuscarGrupoModal.value);
      }
    });
  }

  // Evento para abrir o modal de novo grupo
  if (btnNovoGrupo) {
    btnNovoGrupo.addEventListener('click', function () {
      formNovoGrupo.reset();
      novoGrupoNomeInput.classList.remove('is-invalid');
      novoGrupoNomeErrorDiv.innerHTML = '';
      formNovoGrupoErrorsDiv.classList.add('d-none');
      formNovoGrupoErrorsDiv.innerHTML = '';

      modalNovoGrupo.show();
    });
  }

  // Evento para salvar novo grupo via AJAX
  if (btnSalvarNovoGrupo) {
    btnSalvarNovoGrupo.addEventListener('click', function () {
      const formData = new FormData(formNovoGrupo);
      const csrfToken = formData.get('csrf_test_name');

      formNovoGrupoErrorsDiv.classList.add('d-none');
      formNovoGrupoErrorsDiv.innerHTML = '';
      novoGrupoNomeInput.classList.remove('is-invalid');
      novoGrupoNomeErrorDiv.innerHTML = '';

      fetch(`${BASE_URL}usuarios/salvarNovoGrupoAjax`, {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': csrfToken
        },
        body: formData
      })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            Swal.fire('Sucesso!', data.message, 'success');
            grupoUsuarioIdInput.value = data.grupo.id;
            grupoUsuarioNomeDisplay.value = data.grupo.nome;
            modalNovoGrupo.hide();
            window.carregarGruposNoModal('');
          } else {
            if (data.errors) {
              for (const field in data.errors) {
                const errorElement = document.getElementById(`novo_grupo_${field}`);
                const errorDiv = document.getElementById(`novo_grupo_${field}_error`);
                if (errorElement && errorDiv) {
                  errorElement.classList.add('is-invalid');
                  errorDiv.innerHTML = data.errors[field];
                } else {
                  formNovoGrupoErrorsDiv.classList.remove('d-none');
                  formNovoGrupoErrorsDiv.innerHTML = `<li>${data.errors[field]}</li>`;
                }
              }
            } else {
              formNovoGrupoErrorsDiv.classList.remove('d-none');
              formNovoGrupoErrorsDiv.innerHTML = `<li>${data.message || 'Ocorreu um erro desconhecido.'}</li>`;
            }
          }
        })
        .catch(error => {
          console.error('Erro ao salvar novo grupo:', error);
          formNovoGrupoErrorsDiv.classList.remove('d-none');
          formNovoGrupoErrorsDiv.innerHTML = '<li>Erro de rede ou servidor. Tente novamente.</li>';
        });
    });
  }

  // ============================================================================
  // DELEGAÇÃO DE EVENTOS PARA BOTÕES DENTRO DO MODAL GRUPO SELEÇÃO
  // ============================================================================
  // Anexa um único listener ao elemento pai 'modalGrupoContent'
  if (modalGrupoContent) {
    modalGrupoContent.addEventListener('click', function (event) {
      // Verifica se o elemento clicado (ou um de seus pais) é um botão "Selecionar"
      const btnSelecionar = event.target.closest('.btn-selecionar-grupo');
      if (btnSelecionar) {
        const id = btnSelecionar.dataset.id;
        const nome = btnSelecionar.dataset.nome;

        grupoUsuarioIdInput.value = id;
        grupoUsuarioNomeDisplay.value = nome;

        modalGrupoSelecao.hide();
        return; // Importante para parar a execução após o tratamento do evento
      }

      // Verifica se o elemento clicado (ou um de seus pais) é um botão "Excluir"
      const btnExcluir = event.target.closest('.btn-excluir-grupo');
      if (btnExcluir) {
        // --- CONSOLE.LOG DE VERIFICAÇÃO ---
        console.log('Botão Excluir clicado via delegação! ID:', btnExcluir.dataset.id, 'Nome:', btnExcluir.dataset.nome);
        // ---------------------------------

        const id = btnExcluir.dataset.id;
        const nome = btnExcluir.dataset.nome;

        Swal.fire({
          title: 'Tem certeza?',
          text: `Você realmente deseja excluir o grupo "${nome}"?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Sim, excluir!',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            fetch(`${BASE_URL}usuarios/excluirGrupoAjax/${id}`, {
              method: 'POST',
              headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : ''
              }
            })
              .then(response => response.json())
              .then(data => {
                if (data.status === 'success') {
                  Swal.fire('Excluído!', data.message, 'success');
                  window.carregarGruposNoModal(inputBuscarGrupoModal.value); // Recarrega a lista
                } else {
                  Swal.fire('Erro!', data.message || 'Não foi possível excluir o grupo.', 'error');
                }
              })
              .catch(error => {
                console.error('Erro ao excluir grupo:', error);
                Swal.fire('Erro!', 'Ocorreu um erro ao tentar excluir o grupo.', 'error');
              });
          }
        });
      }
    });
  }

  // Lógica para o switch "Ativo"
  const ativoSwitch = document.getElementById('ativoSwitch');
  const ativoSwitchLabel = document.querySelector('.ativo-switch-label');

  if (ativoSwitch && ativoSwitchLabel) {
    // Função para atualizar o texto da label
    function updateAtivoSwitchLabel() {
      if (ativoSwitch.checked) {
        ativoSwitchLabel.textContent = ativoSwitchLabel.dataset.labelOn;
      } else {
        ativoSwitchLabel.textContent = ativoSwitchLabel.dataset.labelOff;
      }
    }

    // Adiciona listener para quando o estado do switch muda
    ativoSwitch.addEventListener('change', updateAtivoSwitchLabel);

    // Chama a função uma vez para garantir que o estado inicial esteja correto
    updateAtivoSwitchLabel();
  }
});