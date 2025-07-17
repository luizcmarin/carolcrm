document.addEventListener('DOMContentLoaded', function () {
  const imageInput = document.getElementById('imageInput');
  const imagePreview = document.getElementById('imagePreview');
  const uploadButton = document.getElementById('uploadButton');
  const clearButton = document.getElementById('clearButton');
  const removeCurrentImageButton = document.getElementById('removeCurrentImageButton');
  const cancelNewUserUploadButton = document.getElementById('cancelNewUserUploadButton');
  const messageDiv = document.getElementById('message');
  const dropArea = document.getElementById('dropArea');
  const toggleViewButton = document.getElementById('toggleViewButton');
  const listView = document.getElementById('listView');
  const albumView = document.getElementById('albumView');

  let selectedFile = null;
  let uploadedTemporaryImageId = null;

  function showMessage(msg, type = 'info') {
    messageDiv.textContent = msg;
    messageDiv.className = `mt-4 text-center small w-100`;
    if (type === 'success') {
      messageDiv.classList.add('text-success');
    } else if (type === 'error') {
      messageDiv.classList.add('text-danger');
    } else {
      messageDiv.classList.add('text-muted');
    }
  }

  function processFile(file) {
    selectedFile = file;
    imagePreview.classList.add('d-none');
    uploadButton.disabled = true;
    clearButton.disabled = true;
    removeCurrentImageButton.disabled = true;
    cancelNewUserUploadButton.disabled = true;
    showMessage('');

    if (selectedFile) {
      if (!ALLOWED_TYPES_IMAGES.includes(selectedFile.type)) {
        showMessage('Tipo de arquivo não permitido. Verifique os formatos aceitos.', 'error');
        selectedFile = null;
        return;
      }

      if (selectedFile.size > MAX_FILE_SIZE) {
        showMessage('Arquivo muito grande. Máximo de 10MB.', 'error');
        selectedFile = null;
        return;
      }

      if (selectedFile.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (e) {
          imagePreview.src = e.target.result;
          imagePreview.classList.remove('d-none');
        };
        reader.readAsDataURL(selectedFile);
      } else {
        imagePreview.src = SEM_IMAGEM;
        imagePreview.classList.remove('d-none');
      }

      uploadButton.disabled = false;
      clearButton.disabled = false;
    }
  }

  function initializeImagePreview() {
    if (CURRENT_IMAGE_URL && CURRENT_IMAGE_URL !== SEM_IMAGEM) {
      imagePreview.src = CURRENT_IMAGE_URL;
      imagePreview.classList.remove('d-none');
      removeCurrentImageButton.disabled = false;
    } else {
      imagePreview.src = SEM_IMAGEM;
      imagePreview.classList.remove('d-none');
      removeCurrentImageButton.disabled = true;
    }
    uploadButton.disabled = true;
    clearButton.disabled = true;
    cancelNewUserUploadButton.disabled = true;
    uploadedTemporaryImageId = null;
  }

  const VIEW_MODE_KEY = 'fileServerViewMode';

  function setViewMode(mode) {
    if (mode === 'list') {
      listView.classList.remove('d-none');
      albumView.classList.add('d-none');
      if (toggleViewButton) {
        toggleViewButton.innerHTML = '<i class="bi bi-grid-3x3-gap-fill me-2"></i> Alternar Visualização';
      }
    } else if (mode === 'album') {
      listView.classList.add('d-none');
      albumView.classList.remove('d-none');
      if (toggleViewButton) {
        toggleViewButton.innerHTML = '<i class="bi bi-list-ul me-2"></i> Alternar Visualização';
      }
    }
    localStorage.setItem(VIEW_MODE_KEY, mode);
  }

  if (toggleViewButton && listView && albumView) {
    const savedViewMode = localStorage.getItem(VIEW_MODE_KEY);
    if (savedViewMode) {
      setViewMode(savedViewMode);
    } else {
      setViewMode('list');
    }

    toggleViewButton.addEventListener('click', function () {
      if (listView.classList.contains('d-none')) {
        setViewMode('list');
      } else {
        setViewMode('album');
      }
    });
  }

  initializeImagePreview();

  if (imageInput) {
    imageInput.addEventListener('change', function (event) {
      if (event.target.files.length > 0) {
        processFile(event.target.files[0]);
      }
    });
  }

  if (dropArea) {
    dropArea.addEventListener('dragover', (event) => {
      event.preventDefault();
      dropArea.classList.add('drag-over');
    });

    dropArea.addEventListener('dragleave', () => {
      dropArea.classList.remove('drag-over');
    });

    dropArea.addEventListener('drop', (event) => {
      event.preventDefault();
      dropArea.classList.remove('drag-over');

      const files = event.dataTransfer.files;
      if (files.length > 0) {
        processFile(files[0]);
      }
    });
  }

  // REMOVIDO: Listener de submit para imageUploadForm

  if (uploadButton) {
    uploadButton.addEventListener('click', async function (event) {
      // console.log('Botão de upload clicado. Prevenindo default...'); // Removido para manter sem comentários
      // console.trace(); // Removido para manter sem comentários
      event.preventDefault();

      if (!selectedFile) {
        showMessage('Nenhum arquivo selecionado para upload.', 'error');
        return;
      }

      showMessage('Enviando arquivo... Por favor, aguarde.', 'info');
      uploadButton.disabled = true;
      clearButton.disabled = true;
      removeCurrentImageButton.disabled = true;
      cancelNewUserUploadButton.disabled = true;

      const formData = new FormData();
      formData.append('image', selectedFile);
      formData.append('entidade_tipo', 'usuarios');
      if (USER_ID) {
        formData.append('entidade_id', USER_ID);
      }

      try {
        const response = await fetch(UPLOAD_URL, {
          method: 'POST',
          body: formData,
        });

        const result = await response.json();

        if (response.ok) {
          showMessage('Upload realizado com sucesso! Perfil atualizado.', 'success');
          uploadedTemporaryImageId = result.data.id;
          cancelNewUserUploadButton.disabled = false;
          // window.location.reload();
        } else {
          let errorMessage = 'Erro no upload.';
          if (result.messages && typeof result.messages === 'object') {
            errorMessage += ' Detalhes: ' + Object.values(result.messages).join(', ');
          } else if (result.message) {
            errorMessage += ' Detalhes: ' + result.message;
          }
          showMessage(errorMessage, 'error');
        }
      } catch (error) {
        showMessage('Erro de conexão ou rede: ' + error.message, 'error');
      } finally {
        uploadButton.disabled = false;
        clearButton.disabled = false;
      }
    });
  }

  if (clearButton) {
    clearButton.addEventListener('click', function () {
      imageInput.value = '';
      selectedFile = null;
      showMessage('');
      initializeImagePreview();
      uploadedTemporaryImageId = null;
      cancelNewUserUploadButton.disabled = true;
    });
  }

  if (removeCurrentImageButton) {
    removeCurrentImageButton.addEventListener('click', async function () {
      if (!CURRENT_IMAGE_ID || !USER_ID) {
        showMessage('Nenhuma imagem atual para remover ou ID do usuário ausente.', 'error');
        return;
      }

      Swal.fire({
        title: 'Tem certeza?',
        text: 'Você deseja remover a imagem atual do seu perfil?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, remover!',
        cancelButtonText: 'Cancelar'
      }).then(async (result) => {
        if (result.isConfirmed) {
          showMessage('Removendo imagem atual... Por favor, aguarde.', 'info');
          uploadButton.disabled = true;
          clearButton.disabled = true;
          removeCurrentImageButton.disabled = true;
          cancelNewUserUploadButton.disabled = true;

          const formData = new FormData();
          formData.append('user_id', USER_ID);
          formData.append('image_id', CURRENT_IMAGE_ID);

          try {
            const response = await fetch(REMOVE_USER_IMAGE_URL, {
              method: 'POST',
              body: formData,
            });

            const result = await response.json();

            if (response.ok) {
              Swal.fire(
                'Removida!',
                'Sua imagem foi removida com sucesso.',
                'success'
              ).then(() => {
                // window.location.reload();
              });
            } else {
              let errorMessage = 'Erro ao remover imagem.';
              if (result.messages && typeof result.messages === 'object') {
                errorMessage += ' Detalhes: ' + Object.values(result.messages).join(', ');
              } else if (result.message) {
                errorMessage += ' Detalhes: ' + result.message;
              }
              Swal.fire(
                'Erro!',
                errorMessage,
                'error'
              );
            }
          } catch (error) {
            Swal.fire(
              'Erro!',
              'Erro de conexão ou rede: ' + error.message,
              'error'
            );
          } finally {
            uploadButton.disabled = false;
            clearButton.disabled = false;
            removeCurrentImageButton.disabled = false;
            cancelNewUserUploadButton.disabled = false;
          }
        }
      });
    });
  }

  if (cancelNewUserUploadButton) {
    cancelNewUserUploadButton.addEventListener('click', async function () {
      if (!uploadedTemporaryImageId) {
        showMessage('Nenhuma imagem temporária para excluir.', 'error');
        return;
      }

      Swal.fire({
        title: 'Tem certeza?',
        text: 'Você deseja cancelar a inclusão e excluir a imagem que você acabou de enviar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
      }).then(async (result) => {
        if (result.isConfirmed) {
          showMessage('Excluindo imagem temporária... Por favor, aguarde.', 'info');
          uploadButton.disabled = true;
          clearButton.disabled = true;
          removeCurrentImageButton.disabled = true;
          cancelNewUserUploadButton.disabled = true;

          const formData = new FormData();
          formData.append('image_id', uploadedTemporaryImageId);

          try {
            const response = await fetch(DELETE_TEMPORARY_IMAGE_URL, {
              method: 'POST',
              body: formData,
            });

            const result = await response.json();

            if (response.ok) {
              Swal.fire(
                'Excluída!',
                'A imagem temporária foi excluída com sucesso.',
                'success'
              ).then(() => {
                imageInput.value = '';
                selectedFile = null;
                uploadedTemporaryImageId = null;
                initializeImagePreview();
              });
            } else {
              let errorMessage = 'Erro ao excluir imagem temporária.';
              if (result.messages && typeof result.messages === 'object') {
                errorMessage += ' Detalhes: ' + Object.values(result.messages).join(', ');
              } else if (result.message) {
                errorMessage += ' Detalhes: ' + result.message;
              }
              Swal.fire(
                'Erro!',
                errorMessage,
                'error'
              );
            }
          } catch (error) {
            Swal.fire(
              'Erro!',
              'Erro de conexão ou rede: ' + error.message,
              'error'
            );
          } finally {
            uploadButton.disabled = false;
            clearButton.disabled = false;
            removeCurrentImageButton.disabled = false;
            cancelNewUserUploadButton.disabled = false;
          }
        }
      });
    });
  }

  document.querySelectorAll('a[href^="' + BASE_URL + 'arquivos/delete/"]').forEach(button => {
    button.addEventListener('click', function (event) {
      event.preventDefault();

      Swal.fire({
        title: 'Tem certeza?',
        text: 'Você deseja excluir este arquivo? Isso pode afetar usuários ou outras entidades que o utilizam.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = button.href;
        }
      });
    });
  });

  function restoreIconButton(button) {
    button.innerHTML = '';
    const icon = document.createElement('i');
    icon.classList.add('bi', 'bi-clipboard');
    button.appendChild(icon);
  }

  function showCopyFeedback(button, message, type = 'info') {
    const parentDiv = button.closest('.input-with-copy');
    if (!parentDiv) {
      return;
    }

    const feedbackSpan = parentDiv.querySelector('.copy-feedback-message-external');
    if (!feedbackSpan) {
      return;
    }

    feedbackSpan.textContent = message;
    feedbackSpan.style.backgroundColor = type === 'success' ? 'rgba(22, 163, 74, 0.9)' : 'rgba(220, 38, 38, 0.9)';
    feedbackSpan.classList.add('show');

    setTimeout(() => {
      feedbackSpan.classList.remove('show');
      restoreIconButton(button);
    }, 2000);
  }

  function copyToClipboardLegacy(text) {
    const textarea = document.createElement('textarea');
    textarea.value = text;
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    document.body.appendChild(textarea);
    textarea.focus();
    textarea.select();

    try {
      const successful = document.execCommand('copy');
      document.body.removeChild(textarea);
      return successful;
    } catch (err) {
      document.body.removeChild(textarea);
      return false;
    }
  }

  const cpfInput = document.getElementById('cpf');
  const cpfFeedback = document.getElementById('cpf-feedback');

  function formatCPF(value) {
    value = value.replace(/\D/g, "");
    value = value.replace(/(\d{3})(\d)/, "$1.$2");
    value = value.replace(/(\d{3})(\d)/, "$1.$2");
    value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    return value;
  }

  function validateCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');

    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
      return false;
    }

    let sum = 0;
    let remainder;

    for (let i = 1; i <= 9; i++) {
      sum = sum + parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }
    remainder = (sum * 10) % 11;

    if ((remainder === 10) || (remainder === 11)) {
      remainder = 0;
    }
    if (remainder !== parseInt(cpf.substring(9, 10))) {
      return false;
    }

    sum = 0;
    for (let i = 1; i <= 10; i++) {
      sum = sum + parseInt(cpf.substring(i - 1, i)) * (12 - i);
    }
    remainder = (sum * 10) % 11;

    if ((remainder === 10) || (remainder === 11)) {
      remainder = 0;
    }
    if (remainder !== parseInt(cpf.substring(10, 11))) {
      return false;
    }

    return true;
  }

  if (cpfInput && cpfFeedback) {
    cpfInput.addEventListener('input', function () {
      let value = this.value;
      this.value = formatCPF(value);
      this.classList.remove('is-valid', 'is-invalid');
      cpfFeedback.classList.remove('valid-feedback', 'invalid-feedback');
      cpfFeedback.textContent = '';

      if (this.value.length === 0) {
        cpfFeedback.textContent = '';
      } else if (this.value.length === 14) {
        if (validateCPF(this.value)) {
          this.classList.add('is-valid');
          cpfFeedback.classList.add('valid-feedback');
          cpfFeedback.textContent = 'CPF válido.';
        } else {
          this.classList.add('is-invalid');
          cpfFeedback.classList.add('invalid-feedback');
          cpfFeedback.textContent = 'CPF inválido.';
        }
      } else {
        this.classList.add('is-invalid');
        cpfFeedback.classList.add('invalid-feedback');
        cpfFeedback.textContent = 'CPF incompleto.';
      }
    });

    if (cpfInput.value.length > 0) {
      cpfInput.dispatchEvent(new Event('input'));
    }
  }

  const cepInput = document.getElementById('cep');

  if (cepInput) {
    cepInput.addEventListener('input', function (e) {
      let value = e.target.value;
      value = value.replace(/\D/g, '');
      if (value.length > 5) {
        value = value.substring(0, 5) + '-' + value.substring(5, 8);
      }
      e.target.value = value;
    });
  }

  const emailInput = document.getElementById('email');

  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  if (emailInput) {
    emailInput.addEventListener('input', function () {
      const email = emailInput.value.trim();
      if (isValidEmail(email)) {
        emailInput.classList.add('is-valid');
        emailInput.classList.remove('is-invalid');
      } else {
        emailInput.classList.add('is-invalid');
        emailInput.classList.remove('is-valid');
      }
    });
  }

  const targetTextareaSobre = document.getElementById('sobre');
  let editorSobre = null;

  if (targetTextareaSobre) {
    editorSobre = SUNEDITOR.create(targetTextareaSobre, {
      lang: SUNEDITOR_LANG['pt_br'],
      height: 'auto',
      minHeight: '250px',
      buttonList: [
        ['undo', 'redo'],
        ['bold', 'underline', 'italic', 'strike'],
        ['fullScreen', 'codeView'],
        ['removeFormat']
      ],
    });

    editorSobre.onLoad = function () {
      if (this.container) {
        this.container.classList.add('form-control');
      }
    };
  }

  const targetTextareaAssinatura = document.getElementById('assinatura_email');
  let editorAssinatura = null;

  if (targetTextareaAssinatura) {
    editorAssinatura = SUNEDITOR.create(targetTextareaAssinatura, {
      lang: SUNEDITOR_LANG['pt_br'],
      height: 'auto',
      minHeight: '150px',
      buttonList: [
        ['undo', 'redo'],
        ['bold', 'underline', 'italic', 'strike'],
        ['fullScreen', 'codeView'],
        ['removeFormat']
      ],
    });

    editorAssinatura.onLoad = function () {
      if (this.container) {
        this.container.classList.add('form-control');
      }
    };
  }

  const formElement = document.querySelector('form');
  if (formElement) {
    formElement.addEventListener('submit', function (e) {
      // console.log('Submissão do formulário principal interceptada. Prevenindo default...'); // Removido
      // console.trace(); // Removido
      e.preventDefault();

      if (editorSobre) {
        const conteudoHTMLSobre = editorSobre.getContents();
      }

      if (editorAssinatura) {
        const conteudoHTMLAssinatura = editorAssinatura.getContents();
      }
    });
  }

  // --- Funções de Geração de Credenciais ---

  /**
   * Gera uma senha forte e aleatória.
   * @returns {string} A senha gerada.
   */
  const generateStrongPassword = () => {
    const lowerCaseChars = 'abcdefghijklmnopqrstuvwxyz';
    const upperCaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const numberChars = '0123456789';
    const symbolChars = '!@#$%^&*()_+[]{}|;:,.<>?';
    const allChars = lowerCaseChars + upperCaseChars + numberChars + symbolChars;
    let password = '';
    const passwordLength = 16; // Tamanho da senha

    // Garante que a senha tenha pelo menos um de cada tipo de caractere
    password += lowerCaseChars.charAt(Math.floor(Math.random() * lowerCaseChars.length));
    password += upperCaseChars.charAt(Math.floor(Math.random() * upperCaseChars.length));
    password += numberChars.charAt(Math.floor(Math.random() * numberChars.length));
    password += symbolChars.charAt(Math.floor(Math.random() * symbolChars.length));

    // Preenche o restante da senha com caracteres aleatórios
    for (let i = password.length; i < passwordLength; i++) {
      password += allChars.charAt(Math.floor(Math.random() * allChars.length));
    }

    // Embaralha a senha para garantir aleatoriedade na posição dos caracteres
    password = password.split('').sort(() => Math.random() - 0.5).join('');
    return password;
  };

  /**
   * Gera um nome de usuário aleatório composto por letras minúsculas e números.
   * @param {number} length O comprimento desejado para o nome de usuário.
   * @returns {string} O nome de usuário gerado.
   */
  const generateRandomUsername = (length = 10) => { // Padrão de 10 caracteres
    const chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
    let username = '';
    for (let i = 0; i < length; i++) {
      username += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return username;
  };

  // --- Listeners para os Botões de Geração de Credenciais ---

  const nomeUsuarioInput = document.getElementById('nome_usuario');
  const gerarNomeUsuarioBtn = document.getElementById('gerar_nome_usuario_btn'); // Novo ID para o botão de nome de usuário

  if (gerarNomeUsuarioBtn && nomeUsuarioInput) {
    gerarNomeUsuarioBtn.addEventListener('click', function () {
      nomeUsuarioInput.value = generateRandomUsername(10); // Gera um nome de usuário de 10 caracteres
    });
  }

  const generatedPasswordInput = document.getElementById('senha');
  const gerarSenhaBtn = document.getElementById('gerar_senha_btn'); // Novo ID para o botão de senha

  if (gerarSenhaBtn && generatedPasswordInput) {
    gerarSenhaBtn.addEventListener('click', function () {
      generatedPasswordInput.value = generateStrongPassword();
    });
  }

  const copyCredentialsBtn = document.getElementById('copy_credentials_btn');

  if (copyCredentialsBtn && nomeUsuarioInput && generatedPasswordInput) {
    copyCredentialsBtn.addEventListener('click', async () => {
      const username = nomeUsuarioInput.value;
      const password = generatedPasswordInput.value;

      if (!username && !password) {
        showCopyFeedback(copyCredentialsBtn, 'Campos vazios!', 'error');
        return;
      }

      const textToCopy = `Nome de usuário: ${username}\nSenha: ${password}\nLembre-se de alterar o nome de usuário e a senha!`;

      if (navigator.clipboard && navigator.clipboard.writeText) {
        try {
          await navigator.clipboard.writeText(textToCopy);
          showCopyFeedback(copyCredentialsBtn, 'Copiado!', 'success');
        } catch (err) {
          // Fallback para document.execCommand se navigator.clipboard falhar (ex: em iframes)
          if (copyToClipboardLegacy(textToCopy)) {
            showCopyFeedback(copyCredentialsBtn, 'Copiado!', 'success');
          } else {
            showCopyFeedback(copyCredentialsBtn, 'Falha!', 'error');
          }
        }
      } else {
        // Fallback para navegadores mais antigos
        if (copyToClipboardLegacy(textToCopy)) {
          showCopyFeedback(copyCredentialsBtn, 'Copiado!', 'success');
        } else {
          showCopyFeedback(copyCredentialsBtn, 'Falha!', 'error');
        }
      }
    });
  }

  // --- Fim dos Listeners para os Botões de Geração de Credenciais ---

});

