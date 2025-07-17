<?= $this->extend('layout/principal') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h5 class="mb-0 text-primary-emphasis"><?= $titulo ?></h5>

        <div class="d-sm-flex align-items-center">
            <div class="col-md-auto me-2">
                <form action="<?= current_url() ?>" method="GET" class="d-flex">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= esc($search ?? '') ?>">
                        <button class="btn btn-secondary" type="submit" title="Pesquisar">
                            <i class="bi bi-search"></i>
                        </button>
                        <?php if (!empty($search)) : ?>
                            <a href="<?= current_url() ?>" class="btn btn-danger" title="Limpar pesquisa">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
            <div class="col-md-auto me-1">
                <?php if (service('Carol')->pode('ARQUIVOS.NOVO')) : ?>
                    <a href="<?= base_url('arquivos/new') ?>" class="btn btn-primary shadow-sm">
                        <i class="bi bi-plus-lg text-white-50"></i> Novo
                    </a>
                <?php endif; ?>
            </div>
            <div class="col-md-auto">
                <button id="toggleViewButton" class="btn btn-info">
                    <i class="bi bi-grid-3x3-gap-fill me-2"></i> Alternar Visualização
                </button>
            </div>
        </div>
    </div>

    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div id="listView" class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 text-primary-emphasis">Lista</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Nome Original</th>
                            <th>Tipo</th>
                            <th>Tamanho</th>
                            <th>Descrição</th>
                            <th>Entidade</th>
                            <th>Visível Cliente</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php if (!empty($registros)): ?>
                            <?php foreach ($registros as $registro): ?>
                                <tr>
                                    <td>
                                        <?php if (str_starts_with($registro->tipo_arquivo, 'image/')) : ?>
                                            <img src="<?= base_url('arquivos/thumbnail/' . $registro->id) ?>"
                                                alt="<?= esc($registro->nome_original) ?>" style="max-width: 100px; max-height: 100px; object-fit: contain;"
                                                onerror="this.onerror=null;this.src=SEM_IMAGEM;">
                                        <?php else : ?>
                                            <!-- Ícone para outros tipos de arquivo -->
                                            <i class="bi bi-file-earmark-text" style="font-size: 50px;"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $registro->nome_original ?></td>
                                    <td><?= $registro->tipo_arquivo ?></td>
                                    <td><?= number_format($registro->tamanho_bytes / 1024, 2) ?> KB</td>
                                    <td><?= $registro->descricao ?></td>
                                    <td><?= $registro->entidade_tipo . ' (' . ($registro->entidade_nome ?? 'N/A') . ')' ?></td>
                                    <td><?= $registro->sn_visivel_cliente ?></td>
                                    <td>
                                        <?php if (service('Carol')->pode('ARQUIVOS.DOWNLOAD') && $registro->file_exists) : ?>
                                            <a href="<?= base_url('arquivos/download/' . $registro->id) ?>" class="btn btn-primary btn-sm" title="Download">
                                                <i class="bi bi-cloud-download"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (service('Carol')->pode('ARQUIVOS.VER')) : ?>
                                            <a href="<?= base_url('arquivos/' . $registro->id) . '/show' ?>" class="btn btn-info btn-sm" title="Detalhes">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (service('Carol')->pode('ARQUIVOS.EDITAR')) : ?>
                                            <a href="<?= base_url('arquivos/' . $registro->id . '/edit') ?>" class="btn btn-warning btn-sm" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (service('Carol')->pode('ARQUIVOS.EXCLUIR')) : ?>
                                            <form action="<?= base_url('arquivos/' . $registro->id) ?>" method="POST" class="d-inline form-delete">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm" title="Excluir">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <?= $this->include('partes/paginacao') ?>
        </div>
        <div class="card-footer text-body-secondary texto-pequeno">
        </div>
    </div>

    <!-- Visualização em Álbum -->
    <div id="albumView" class="card shadow mb-4 d-none">
        <div class="card-header py-3">
            <h6 class="m-0 text-primary-emphasis">Álbum</h6>
        </div>
        <div class="card-body">
            <?php
            if (!empty($registros)): ?>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                    <?php foreach ($registros as $registro): ?>
                        <div class="col">
                            <div class="album-card">
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <?php if (str_starts_with($registro->tipo_arquivo, 'image/')) : ?>
                                            <img src="<?= base_url('arquivos/thumbnail/' . $registro->id) ?>"
                                                alt="<?= esc($registro->nome_original) ?>" style="max-width: 100px; max-height: 100px; object-fit: contain;"
                                                onerror="this.onerror=null;this.src='/img/sem-imagem.png';">
                                        <?php else : ?>
                                            <!-- Ícone para outros tipos de arquivo -->
                                            <i class="bi bi-file-earmark-text" style="font-size: 50px;"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <?= $registro->descricao ?>
                                    </div>
                                </div>
                                <div class="album-card-body">
                                    <h5 class="card-title text-truncate mb-1"><?= esc($registro->nome_original) ?></h5>
                                    <p class="card-text text-muted small mb-2">
                                        <?= number_format($registro->tamanho_bytes / 1024, 2) ?> KB
                                    </p>
                                    <div class="album-card-actions">
                                        <?php if (service('Carol')->pode('ARQUIVOS.DOWNLOAD') && $registro->file_exists) : ?>
                                            <a href="<?= base_url('arquivos/download/' . $registro->id) ?>" class="btn btn-primary btn-sm" title="Download">
                                                <i class="bi bi-cloud-download"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (service('Carol')->pode('ARQUIVOS.VER')) : ?>
                                            <a href="<?= base_url('arquivos/' . $registro->id) . '/show' ?>" class="btn btn-info btn-sm" title="Detalhes">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (service('Carol')->pode('ARQUIVOS.EDITAR')) : ?>
                                            <a href="<?= base_url('arquivos/' . $registro->id . '/edit') ?>" class="btn btn-warning btn-sm" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (service('Carol')->pode('ARQUIVOS.EXCLUIR')) : ?>
                                            <form action="<?= base_url('arquivos/' . $registro->id) ?>" method="POST" class="d-inline form-delete">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm" title="Excluir">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?= $this->include('partes/paginacao') ?>
        </div>
        <div class="card-footer text-body-secondary texto-pequeno">
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const uploadButton = document.getElementById('uploadButton');
        const clearButton = document.getElementById('clearButton');
        const removeCurrentImageButton = document.getElementById('removeCurrentImageButton');
        const cancelNewUserUploadButton = document.getElementById('cancelNewUserUploadButton');
        const messageDiv = document.getElementById('message');
        const dropArea = document.getElementById('dropArea');
        const toggleViewButton = document.getElementById('toggleViewButton'); // Novo botão
        const listView = document.getElementById('listView'); // Seção da lista
        const albumView = document.getElementById('albumView'); // Seção do álbum

        let selectedFile = null;
        let uploadedTemporaryImageId = null;

        // Dados do usuário e da imagem atual (passados do PHP)
        const USER_ID = <?= json_encode($userData['id'] ?? null) ?>;
        const CURRENT_IMAGE_ID = <?= json_encode($userData['imagem_id'] ?? null) ?>;
        const CURRENT_IMAGE_URL = <?= json_encode($currentImage['url_publica'] ?? base_url('assets/images/sem-imagem.jpg')) ?>;
        const DEFAULT_IMAGE_URL = '<?= base_url('assets/images/sem-imagem.jpg') ?>';

        // URLs dos endpoints no seu CodeIgniter 4
        const UPLOAD_URL = '<?= base_url('arquivos/upload') ?>';
        const REMOVE_USER_IMAGE_URL = '<?= base_url('arquivos/removeUserImage') ?>';
        const DELETE_TEMPORARY_IMAGE_URL = '<?= base_url('arquivos/deleteTemporaryImage') ?>';

        // Tipos de arquivo permitidos (devem corresponder ao backend)
        const ALLOWED_TYPES = [
            'image/jpeg', 'image/png', 'image/gif', 'image/webp',
            'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'text/plain'
        ];
        const MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB em bytes

        function showMessage(msg, type = 'info') {
            messageDiv.textContent = msg;
            messageDiv.className = `mt-4 text-center small w-100`; // Reset classes
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
                if (!ALLOWED_TYPES.includes(selectedFile.type)) {
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
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove('d-none');
                    };
                    reader.readAsDataURL(selectedFile);
                } else {
                    imagePreview.src = "/img/sem-imagem.png";
                    imagePreview.classList.remove('d-none');
                }

                uploadButton.disabled = false;
                clearButton.disabled = false;
            }
        }

        function initializeImagePreview() {
            if (CURRENT_IMAGE_URL && CURRENT_IMAGE_URL !== DEFAULT_IMAGE_URL) {
                imagePreview.src = CURRENT_IMAGE_URL;
                imagePreview.classList.remove('d-none');
                removeCurrentImageButton.disabled = false;
            } else {
                imagePreview.src = DEFAULT_IMAGE_URL;
                imagePreview.classList.remove('d-none');
                removeCurrentImageButton.disabled = true;
            }
            uploadButton.disabled = true;
            clearButton.disabled = true;
            cancelNewUserUploadButton.disabled = true;
            uploadedTemporaryImageId = null;
        }

        // --- Lógica de Alternância de Visualização ---
        const VIEW_MODE_KEY = 'arquivosViewMode'; // Chave para localStorage

        function setViewMode(mode) {
            if (mode === 'list') {
                listView.classList.remove('d-none');
                albumView.classList.add('d-none');
                toggleViewButton.innerHTML = '<i class="bi bi-grid-3x3-gap-fill me-2"></i> Alternar Visualização';
            } else if (mode === 'album') {
                listView.classList.add('d-none');
                albumView.classList.remove('d-none');
                toggleViewButton.innerHTML = '<i class="bi bi-list-ul me-2"></i> Alternar Visualização';
            }
            localStorage.setItem(VIEW_MODE_KEY, mode); // Salva a preferência
        }

        // Inicializa a visualização com base na preferência salva ou padrão
        const savedViewMode = localStorage.getItem(VIEW_MODE_KEY);
        if (savedViewMode) {
            setViewMode(savedViewMode);
        } else {
            setViewMode('list'); // Padrão
        }

        toggleViewButton.addEventListener('click', function() {
            if (listView.classList.contains('d-none')) {
                setViewMode('list');
            } else {
                setViewMode('album');
            }
        });
        // --- Fim da Lógica de Alternância de Visualização ---


        initializeImagePreview();

        imageInput.addEventListener('change', function(event) {
            if (event.target.files.length > 0) {
                processFile(event.target.files[0]);
            }
        });

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

        uploadButton.addEventListener('click', async function() {
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
                    showMessage('Upload realizado com sucesso! Atualizando perfil...', 'success');
                    uploadedTemporaryImageId = result.data.id;
                    cancelNewUserUploadButton.disabled = false;
                    window.location.reload();
                } else {
                    let errorMessage = 'Erro no upload.';
                    if (result.messages && typeof result.messages === 'object') {
                        errorMessage += ' Detalhes: ' + Object.values(result.messages).join(', ');
                    } else if (result.message) {
                        errorMessage += ' Detalhes: ' + result.message;
                    }
                    showMessage(errorMessage, 'error');
                    console.error('Erro no upload:', result);
                }
            } catch (error) {
                showMessage('Erro de conexão ou rede: ' + error.message, 'error');
                console.error('Erro de rede ou fetch:', error);
            } finally {
                uploadButton.disabled = false;
                clearButton.disabled = false;
            }
        });

        clearButton.addEventListener('click', function() {
            imageInput.value = '';
            selectedFile = null;
            showMessage('');
            initializeImagePreview();
            uploadedTemporaryImageId = null;
            cancelNewUserUploadButton.disabled = true;
        });

        removeCurrentImageButton.addEventListener('click', async function() {
            if (!CURRENT_IMAGE_ID || !USER_ID) {
                showMessage('Nenhuma imagem atual para remover ou ID do usuário ausente.', 'error');
                return;
            }

            if (!confirm('Tem certeza que deseja remover a imagem atual do seu perfil?')) {
                return;
            }

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
                    showMessage('Imagem removida com sucesso! Atualizando perfil...', 'success');
                    window.location.reload();
                } else {
                    let errorMessage = 'Erro ao remover imagem.';
                    if (result.messages && typeof result.messages === 'object') {
                        errorMessage += ' Detalhes: ' + Object.values(result.messages).join(', ');
                    } else if (result.message) {
                        errorMessage += ' Detalhes: ' + result.message;
                    }
                    showMessage(errorMessage, 'error');
                    console.error('Erro ao remover imagem:', result);
                }
            } catch (error) {
                showMessage('Erro de conexão ou rede: ' + error.message, 'error');
                console.error('Erro de rede ou fetch:', error);
            } finally {
                uploadButton.disabled = false;
                clearButton.disabled = false;
                removeCurrentImageButton.disabled = false;
                cancelNewUserUploadButton.disabled = false;
            }
        });

        cancelNewUserUploadButton.addEventListener('click', async function() {
            if (!uploadedTemporaryImageId) {
                showMessage('Nenhuma imagem temporária para excluir.', 'error');
                return;
            }

            if (!confirm('Tem certeza que deseja cancelar a inclusão e excluir a imagem que você acabou de enviar?')) {
                return;
            }

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
                    showMessage('Imagem temporária excluída com sucesso!', 'success');
                    imageInput.value = '';
                    selectedFile = null;
                    uploadedTemporaryImageId = null;
                    initializeImagePreview();
                } else {
                    let errorMessage = 'Erro ao excluir imagem temporária.';
                    if (result.messages && typeof result.messages === 'object') {
                        errorMessage += ' Detalhes: ' + Object.values(result.messages).join(', ');
                    } else if (result.message) {
                        errorMessage += ' Detalhes: ' + result.message;
                    }
                    showMessage(errorMessage, 'error');
                    console.error('Erro ao excluir imagem temporária:', result);
                }
            } catch (error) {
                showMessage('Erro de conexão ou rede: ' + error.message, 'error');
                console.error('Erro de rede ou fetch:', error);
            } finally {
                uploadButton.disabled = false;
                clearButton.disabled = false;
                removeCurrentImageButton.disabled = false;
                cancelNewUserUploadButton.disabled = false;
            }
        });

        document.querySelectorAll('a[href^="<?= base_url('arquivos/delete/') ?>"]').forEach(button => {
            button.addEventListener('click', function(event) {
                const confirmDelete = confirm('Tem certeza que deseja excluir este arquivo? Isso pode afetar usuários ou outras entidades que o utilizam.');
                if (!confirmDelete) {
                    event.preventDefault();
                }
            });
        });
    });
</script>


<?= $this->endSection() ?>