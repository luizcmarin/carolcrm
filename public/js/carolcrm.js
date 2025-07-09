// main.js - Código Otimizado

(function () {
  "use strict";

  // --- Funções Auxiliares Comuns ---
  const select = (selector, parent = document) => parent.querySelector(selector);
  const selectAll = (selector, parent = document) => Array.from(parent.querySelectorAll(selector));
  const hideElement = (el) => { if (el) el.style.display = 'none'; };
  const showElement = (el) => { if (el) el.style.display = 'block'; }; // Ou 'flex', 'grid' dependendo do contexto CSS
  const getTransitionDuration = (el) => {
    if (!el) return 0;
    const durationStr = window.getComputedStyle(el).transitionDuration;
    return parseFloat(durationStr) * 1000; // Converte para milissegundos
  };

  // --- Módulo 1: Loader da Tela ---
  function initLoaderScreen() {
    const loadScreen = select('#load_screen');
    hideElement(loadScreen);
  }

  // --- Módulo 2: Confirmação de Exclusão com SweetAlert2 (Unificado) ---
  function initDeleteConfirmation() {
    const deleteForms = selectAll('.form-delete');
    deleteForms.forEach(form => {
      form.addEventListener('submit', function (e) {
        e.preventDefault(); // Impede o envio padrão do formulário

        Swal.fire({
          title: 'Tem certeza?',
          text: "Você não poderá reverter esta ação!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Sim, excluir!',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit(); // Envia o formulário se confirmado
          }
        });
      });
    });
  }

  // --- Módulo 3: Navegação de Campos com Tecla Enter ---
  function initEnterKeyNavigation() {
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Enter') {
        const targetElement = event.target;
        const tagName = targetElement.tagName;

        const isInteractiveField = (
          (tagName === 'INPUT' && targetElement.type !== 'submit' && targetElement.type !== 'button' && targetElement.type !== 'reset' && targetElement.type !== 'hidden') ||
          tagName === 'SELECT' ||
          tagName === 'TEXTAREA'
        );

        // Se o Enter foi pressionado em um campo interativo
        if (isInteractiveField) {
          event.preventDefault(); // Impede o comportamento padrão de submit imediato

          const form = targetElement.form;
          if (!form) return;

          // Filtra todos os elementos focáveis dentro do formulário
          const focusableElements = Array.from(form.elements).filter(el =>
            (el.tagName === 'INPUT' && el.type !== 'hidden' && el.type !== 'reset') || // Inclui submit e button aqui para focar neles
            el.tagName === 'SELECT' ||
            el.tagName === 'TEXTAREA' ||
            (el.tagName === 'BUTTON' && el.type !== 'reset') // Inclui submit aqui
          ).filter(el =>
            !el.disabled && !el.readOnly && el.tabIndex !== -1 &&
            window.getComputedStyle(el).display !== 'none' &&
            window.getComputedStyle(el).visibility !== 'hidden'
          );

          const currentIndex = focusableElements.indexOf(targetElement);
          const nextIndex = currentIndex + 1;

          if (nextIndex < focusableElements.length) {
            // Tenta focar no próximo elemento
            focusableElements[nextIndex].focus();
          } else {
            // Se for o último campo interativo, tenta acionar o primeiro botão de submit visível
            const submitButton = Array.from(form.elements).find(el =>
              (el.tagName === 'INPUT' && el.type === 'submit' && !el.disabled && window.getComputedStyle(el).display !== 'none') ||
              (el.tagName === 'BUTTON' && el.type === 'submit' && !el.disabled && window.getComputedStyle(el).display !== 'none')
            );

            if (submitButton) {
              submitButton.click(); // Simula um clique no botão de submit
            } else {
              // Fallback: se não encontrar um botão de submit, submete o formulário diretamente.
              // Use isso com cautela, pois pode submeter formulários inesperadamente.
              form.submit();
            }
          }
        }
      }
    });
  }

  // --- Módulo 4: Inicialização de Tooltips do Bootstrap ---
  function initTooltips() {
    const tooltipTriggerList = selectAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
  }

  // --- Módulo 5: Inicialização de Input Number Spinners
  function initNumberSpinners() {
    // Seleciona todos os grupos de spinner que criamos no HTML
    selectAll('.number-spinner-input-group').forEach(group => {
      const input = select('input[type="number"]', group);
      const minusButton = select('.spinner-minus', group);
      const plusButton = select('.spinner-plus', group);

      if (!input || !minusButton || !plusButton) {
        console.warn('Spinner group mal formatado. Verifique os elementos:', group);
        return; // Pula se algum elemento crucial não for encontrado
      }

      // Obtém o valor mínimo, máximo e o passo do input, com fallbacks
      const min = parseFloat(input.min) || 0;
      const max = parseFloat(input.max) || Infinity;
      const step = parseFloat(input.step) || 1;

      // Adiciona listener para o botão de diminuir
      minusButton.addEventListener('click', function () {
        let currentValue = parseFloat(input.value) || 0;
        let newValue = currentValue - step;
        if (newValue >= min) {
          input.value = newValue;
          input.dispatchEvent(new Event('change')); // Dispara evento change para que outros listeners reajam
        } else {
          input.value = min; // Garante que o valor não vá abaixo do mínimo
          input.dispatchEvent(new Event('change'));
        }
      });

      // Adiciona listener para o botão de aumentar
      plusButton.addEventListener('click', function () {
        let currentValue = parseFloat(input.value) || 0;
        let newValue = currentValue + step;
        if (newValue <= max) {
          input.value = newValue;
          input.dispatchEvent(new Event('change')); // Dispara evento change para que outros listeners reajam
        } else {
          input.value = max; // Garante que o valor não vá acima do máximo
          input.dispatchEvent(new Event('change'));
        }
      });

      // Opcional: Adicionar tratamento para entrada manual para garantir que esteja dentro dos limites
      input.addEventListener('change', function () {
        let currentValue = parseFloat(input.value) || 0;
        if (currentValue < min) {
          input.value = min;
        } else if (currentValue > max) {
          input.value = max;
        }
        // Arredonda para garantir que o step seja respeitado se necessário, mas o input[type="number"] já ajuda
      });

      // Opcional: Impedir que letras sejam digitadas manualmente (o type="number" já faz isso, mas browsers antigos ou ctrl+v podem ignorar)
      input.addEventListener('keypress', function (e) {
        // Permite apenas números e pontos/vírgulas (se aplicável para decimais)
        if (!/[0-9]|\./.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete' && e.key !== 'ArrowLeft' && e.key !== 'ArrowRight') {
          e.preventDefault();
        }
      });

    });
  }

  // --- Módulo 6: Controle de Submenus (Collapse do Bootstrap) ---
  function initSubmenuControl() {
    selectAll('.nav-link[data-bs-toggle="collapse"]').forEach(element => {
      element.addEventListener('click', function () {
        // A rotação da seta já está no CSS.
      });
    });
  }

  // --- Módulo 7: Lógica para o Botão 'Open Customizer' ---
  function initCustomizerButton() {
    const openCustomizerBtn = select('.open-customizer');
    if (openCustomizerBtn) {
      openCustomizerBtn.addEventListener('click', function (e) {
        e.preventDefault();
        alert('Abrir customizador!');
      });
    }
  }

  // --- Módulo 8: Funcionalidade do Botão "Voltar ao Topo" (Scroll To Top) ---
  function initScrollToTop() {
    const scrollToTopBtn = select('.scroll-to-top');
    if (scrollToTopBtn) {
      window.addEventListener('scroll', function () {
        if (window.scrollY > 300) {
          showElement(scrollToTopBtn);
        } else {
          hideElement(scrollToTopBtn);
        }
      });
      scrollToTopBtn.addEventListener('click', function (e) {
        e.preventDefault();
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });
    }
  }

  // --- Módulo 9: Lógica de Toggle da Sidebar ---
  function initSidebarToggle() {
    const sidebarToggle = select('#sidebarToggle');
    const menuSidebar = select('#menu');
    const mainContainer = select('#main-container');
    const bodyElement = document.body;
    const overlay = select('.overlay');

    if (!sidebarToggle || !menuSidebar || !mainContainer || !bodyElement || !overlay) {
      console.warn("Elementos da sidebar não encontrados. Inicialização da sidebar pulada.");
      return;
    }

    const isMobileBreakpoint = () => window.matchMedia('(max-width: 991.98px)').matches;

    function openSidebarMobile() {
      if (overlay) {
        showElement(overlay);
        requestAnimationFrame(() => overlay.style.opacity = '1');
      }
      if (menuSidebar) {
        showElement(menuSidebar);
        requestAnimationFrame(() => menuSidebar.style.left = '0');
      }
      if (bodyElement) bodyElement.classList.add('sidebar-collapsed');
    }

    function closeSidebarMobile() {
      if (overlay) {
        overlay.style.opacity = '0';
        setTimeout(() => hideElement(overlay), getTransitionDuration(overlay) + 50);
      }
      if (menuSidebar) {
        menuSidebar.style.left = `calc(-1 * var(--sidebar-width))`;
        setTimeout(() => hideElement(menuSidebar), getTransitionDuration(menuSidebar) + 50);
      }
      if (bodyElement) bodyElement.classList.remove('sidebar-collapsed');
    }

    sidebarToggle.addEventListener('click', function () {
      const isCurrentlyMobile = isMobileBreakpoint();
      const sidebarIsOpened = menuSidebar.style.left === '0px' || (menuSidebar.style.display !== 'none' && !isCurrentlyMobile);

      if (isCurrentlyMobile) {
        if (sidebarIsOpened) {
          closeSidebarMobile();
        } else {
          openSidebarMobile();
        }
      } else { // Lógica Desktop
        mainContainer.classList.toggle('sidebar-toggled');
        // Garante que estilos mobile sejam resetados em desktop
        menuSidebar.style.left = '';
        menuSidebar.style.display = '';
        hideElement(overlay);
        overlay.style.opacity = '0';
        bodyElement.classList.remove('sidebar-collapsed');
      }
    });

    overlay.addEventListener('click', function (event) {
      if (event.target === overlay && isMobileBreakpoint() && (menuSidebar.style.left === '0px' || menuSidebar.style.display !== 'none')) {
        closeSidebarMobile();
      }
    });

    // Listener para ajustar o estado ao redimensionar a tela
    window.addEventListener('resize', function () {
      if (!isMobileBreakpoint()) { // Transição para DESKTOP
        if (mainContainer) mainContainer.classList.remove('sidebar-toggled');
        if (menuSidebar) {
          menuSidebar.style.left = '';
          menuSidebar.style.display = '';
        }
        if (bodyElement) bodyElement.classList.remove('sidebar-collapsed');
        if (overlay) {
          hideElement(overlay);
          overlay.style.opacity = '0';
        }
      } else { // Transição para MOBILE
        if (menuSidebar) {
          menuSidebar.style.left = `calc(-1 * var(--sidebar-width))`;
          hideElement(menuSidebar);
        }
        if (overlay) {
          hideElement(overlay);
          overlay.style.opacity = '0';
        }
        if (mainContainer) mainContainer.classList.remove('sidebar-toggled');
        if (bodyElement) bodyElement.classList.remove('sidebar-collapsed');
      }
    });
  }

  // --- Módulo 10: Bootstrap Theme Switcher (Mantido como um módulo self-contained) ---
  const ThemeSwitcher = (function () {
    const getStoredTheme = () => localStorage.getItem('theme');
    const setStoredTheme = theme => localStorage.setItem('theme', theme);

    const getPreferredTheme = () => {
      const storedTheme = getStoredTheme();
      if (storedTheme) {
        return storedTheme;
      }
      return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    };

    const setTheme = theme => {
      if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.documentElement.setAttribute('data-bs-theme', 'dark');
      } else {
        document.documentElement.setAttribute('data-bs-theme', theme);
      }
    };

    const showActiveTheme = (theme, focus = false) => {
      const themeSwitcher = select('#bd-theme');
      if (!themeSwitcher) return;

      const activeThemeIcon = select('.theme-icon-active');
      const btnToActive = select(`[data-bs-theme-value="${theme}"]`);

      let svgOfActiveBtn = null;
      if (btnToActive && btnToActive.querySelector('i')) {
        svgOfActiveBtn = btnToActive.querySelector('i').cloneNode(true);
      }

      selectAll('[data-bs-theme-value]').forEach(element => {
        element.classList.remove('active');
        element.setAttribute('aria-pressed', 'false');
        const checkIcon = element.querySelector('.bi-check-lg');
        if (checkIcon) checkIcon.classList.add('d-none');
      });

      if (btnToActive) {
        btnToActive.classList.add('active');
        btnToActive.setAttribute('aria-pressed', 'true');
        const checkIcon = btnToActive.querySelector('.bi-check-lg');
        if (checkIcon) checkIcon.classList.remove('d-none');
      }

      if (activeThemeIcon) {
        activeThemeIcon.innerHTML = '';
        if (svgOfActiveBtn) {
          activeThemeIcon.appendChild(svgOfActiveBtn);
        }
      }

      if (focus) {
        if (themeSwitcher) themeSwitcher.focus();
      }
    };

    return {
      init: () => {
        setTheme(getPreferredTheme());

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
          const storedTheme = getStoredTheme();
          if (storedTheme !== 'light' && storedTheme !== 'dark') {
            setTheme(getPreferredTheme());
          }
        });

        showActiveTheme(getPreferredTheme());

        selectAll('[data-bs-theme-value]')
          .forEach(toggle => {
            toggle.addEventListener('click', () => {
              const theme = toggle.getAttribute('data-bs-theme-value');
              setStoredTheme(theme);
              setTheme(theme);
              showActiveTheme(theme, true);
            });
          });
      }
    };
  })();

  // --- Módulo 11: Inicialização do Air Datepicker (para Datas) ---
  function initDatepickerInputs() {
    selectAll('.datepicker-input').forEach(input => {
      new AirDatepicker(input, {
        locale: AirDatepicker.locales['pt-BR'],
        dateFormat: 'dd/MM/yyyy', // Formato de exibição para o usuário
        altField: input, // O valor real no formato DB será armazenado aqui (ou seja, no próprio input)
        altFieldDateFormat: 'yyyy-MM-dd', // Formato para o backend (DB)
        autoClose: true,
        clearButton: true,
        todayButton: true,
        timepicker: false, // Não usar seletor de tempo para campos de data pura
        // onSelect e outras opções específicas para datas
      });
    });
  }

  // --- Módulo 11.1: Inicialização do Air Datepicker (para Horas) ---
  function initTimepickerInputs() {
    selectAll('.timepicker-input').forEach(input => {
      new AirDatepicker(input, {
        locale: AirDatepicker.locales['pt-BR'],
        dateFormat: 'HH:mm', // Formato de exibição para o usuário
        altField: input,
        altFieldDateFormat: 'HH:mm:ss', // Formato para o backend (DB)
        autoClose: true,
        clearButton: true,
        timepicker: true, // Habilita o seletor de tempo
        onlyTimepicker: true, // Apenas seletor de tempo (sem calendário de datas)
        // todayButton: false, // Botão de hoje não faz sentido para apenas hora
        // onSelect e outras opções específicas para horas
      });
    });
  }

  // --- Módulo 11.2: Inicialização do Air Datepicker (para Data e Hora) ---
  function initDatetimepickerInputs() {
    selectAll('.datetimepicker-input').forEach(input => {
      new AirDatepicker(input, {
        locale: AirDatepicker.locales['pt-BR'],
        dateFormat: 'dd/MM/yyyy HH:mm', // Formato de exibição para o usuário
        altField: input,
        altFieldDateFormat: 'yyyy-MM-dd HH:mm:ss', // Formato para o backend (DB)
        autoClose: true,
        clearButton: true,
        todayButton: true,
        timepicker: true, // Habilita o seletor de tempo
        // onSelect e outras opções específicas para data e hora
      });
    });
  }

  // --- Módulo 12: Inicialização do Clipboard.js
  function initClipboardJS() {
    // Inicializa o Clipboard.js para todos os elementos que têm os atributos 'data-clipboard-*'
    const clipboard = new ClipboardJS('[data-clipboard-target], [data-clipboard-text]');

    clipboard.on('success', function (e) {
      console.info('Ação:', e.action); // 'copy' ou 'cut'
      console.info('Texto:', e.text);  // O texto que foi copiado
      console.info('Gatilho:', e.trigger); // O elemento que acionou a cópia

      // Opcional: Feedback visual para o usuário
      const originalText = e.trigger.textContent;
      e.trigger.textContent = 'Copiado!';
      e.trigger.classList.add('btn-success');

      setTimeout(() => {
        e.trigger.textContent = originalText;
        e.trigger.classList.remove('btn-success');
      }, 1500); // Volta ao texto original após 1.5 segundos

      e.clearSelection(); // Limpa a seleção de texto após a cópia
    });

    clipboard.on('error', function (e) {
      console.error('Ação falhou:', e.action);
      console.error('Gatilho:', e.trigger);

      // Opcional: Feedback visual de erro
      const originalText = e.trigger.textContent;
      e.trigger.textContent = 'Erro ao Copiar!';
      e.trigger.classList.add('btn-danger');

      setTimeout(() => {
        e.trigger.textContent = originalText;
        e.trigger.classList.remove('btn-danger');
      }, 1500);
    });
  }

  // --- Módulo 13: Inicialização do Choices.js para Selects e Tags ---
  function initChoicesSelects() {
    // Inicializa SELECTS (single e multiple)
    selectAll('.choices-select').forEach(selectElement => {
      new Choices(selectElement, {
        // Opções comuns para selects:
        searchEnabled: true,
        removeItemButton: true,
        placeholder: true,
        placeholderValue: 'Selecione uma opção',
        noResultsText: 'Nenhum resultado encontrado',
        itemSelectText: 'Pressione Enter para selecionar',
      });
    });

    // Inicializa INPUTS para tags
    selectAll('.choices-input').forEach(inputElement => {
      new Choices(inputElement, {
        // Opções para inputs de tags:
        delimiter: ',',
        editItems: true,
        maxItemCount: -1,
        removeItemButton: true,
        placeholder: true,
        placeholderValue: 'Digite tags e pressione Enter',
        noChoicesText: 'Nenhum item para adicionar',
        duplicateItemsAllowed: false,
      });
    });
  }

  // --- Módulo 14: Máscara e Tratamento de Campos Monetários(Inteiro)
  function initMonetaryFields() {
    // Função para formatar o valor como monetário (R$ 1.234,56) para exibição
    function formatMoney(event) {
      let value = event.target.value;

      // Se o valor estiver vazio, não faça nada para evitar '0,00' indesejado em campos vazios
      if (value === '') {
        return;
      }

      // Remove tudo que não for número, vírgula ou ponto (mantém apenas um ponto ou vírgula)
      value = value.replace(/[^0-9,.]/g, '');

      // Para evitar múltiplos separadores decimais e para padronizar para cálculo:
      // Troca vírgula por ponto para o parse, e garante que só tenha um ponto.
      // Permite que o usuário digite a vírgula e os centavos.
      if (value.includes(',')) {
        value = value.replace(/\./g, ''); // Remove pontos de milhar temporariamente para não confundir com decimal
        let parts = value.split(',');
        if (parts.length > 2) { // Caso de múltiplas vírgulas
          value = parts[0] + ',' + parts.slice(1).join('');
        }
        value = value.replace(',', '.'); // Converte vírgula para ponto para o parseFloat
      } else {
        // Se não tem vírgula, garante que não tem pontos de milhar enquanto digita
        value = value.replace(/\./g, '');
      }

      let numericValue = parseFloat(value);

      if (isNaN(numericValue)) {
        event.target.value = '';
        return;
      }

      // Garante sempre 2 casas decimais para formatação BR
      event.target.value = numericValue.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    // Função para preparar o valor para envio (formato inteiro, ex: 1234)
    function cleanMoneyForSubmit(event) {
      let input = event.target;
      let value = input.value;

      // Se o campo estiver vazio, envia vazio. O backend pode tratar como NULL ou 0.
      if (value === '') {
        input.value = '';
        return;
      }

      // Remove separadores de milhar (pontos)
      value = value.replace(/\./g, '');
      // Substitui vírgula por ponto decimal
      value = value.replace(',', '.');

      // Converte para float (para precisão antes de virar inteiro) e depois para inteiro
      let numericValue = parseFloat(value);

      if (isNaN(numericValue)) {
        input.value = ''; // Envia vazio ou um valor padrão (ex: '0') se não for um número válido
      } else {
        // Multiplica por 100 e converte para inteiro
        // Math.round é importante para evitar problemas de ponto flutuante (ex: 12.34 * 100 = 1233.9999999999)
        input.value = Math.round(numericValue * 100);
      }
    }

    const monetaryInputs = selectAll('.monetary-input');

    monetaryInputs.forEach(input => {
      // Aplica a formatação inicial ao carregar a página (se já tiver um valor)
      // Isso é redundante se o PHP já formata corretamente, mas garante
      if (input.value !== '') {
        // Cria um evento artificial para acionar a formatação inicial
        const initialEvent = { target: input };
        formatMoney(initialEvent);
      }

      // Aplica a formatação monetária enquanto o usuário digita
      input.addEventListener('input', formatMoney);
      // Aplica a formatação monetária ao perder o foco (para garantir formatação final)
      input.addEventListener('blur', formatMoney);

      // Adiciona um listener no formulário pai para limpar os valores antes de submeter
      // Isso garante que todos os campos monetários do FORMULARIO ATUAL sejam limpos
      // O .closest('form') é importante para não pegar forms desnecessários
      const form = input.closest('form');
      if (form && !form.dataset.monetaryListenerAdded) { // Evita adicionar o listener múltiplas vezes para o mesmo form
        form.addEventListener('submit', function (event) {
          this.querySelectorAll('.monetary-input').forEach(inputToClean => {
            cleanMoneyForSubmit({ target: inputToClean });
          });
        });
        form.dataset.monetaryListenerAdded = true; // Marca o formulário
      }
    });
  }


  // --- Listener principal para DOMContentLoaded ---
  document.addEventListener('DOMContentLoaded', function () {
    initLoaderScreen();
    initDeleteConfirmation();
    initEnterKeyNavigation();
    initTooltips();
    initSubmenuControl();
    initCustomizerButton();
    initScrollToTop();
    initSidebarToggle();
    initDatepickerInputs();    // Inicializa campos de data
    initTimepickerInputs();    // Inicializa campos de hora
    initDatetimepickerInputs(); // Inicializa campos de data e hora
    initChoicesSelects();
    initNumberSpinners(); // Inicializa os spinners numéricos
    initClipboardJS(); // Inicializa o Clipboard.js
    initMonetaryFields(); // Inicializa os campos monetários
    ThemeSwitcher.init(); // Inicializa o seletor de tema
  });

})();