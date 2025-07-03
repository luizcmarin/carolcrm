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

  // --- Módulo 2: Confirmação de Exclusão com SweetAlert2 ---
  function initDeleteConfirmation() {
    const deleteForms = selectAll('.form-delete');
    deleteForms.forEach(form => {
      form.addEventListener('submit', function (e) {
        e.preventDefault(); // Impede o envio padrão

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
            form.submit();
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

        if (isInteractiveField) {
          event.preventDefault();

          const form = targetElement.form;
          if (!form) return;

          const focusableElements = Array.from(form.elements).filter(el =>
            (el.tagName === 'INPUT' && el.type !== 'hidden' && el.type !== 'submit' && el.type !== 'button' && el.type !== 'reset') ||
            el.tagName === 'SELECT' ||
            el.tagName === 'TEXTAREA' ||
            (el.tagName === 'BUTTON' && el.type !== 'submit' && el.type !== 'reset' && el.type !== 'image')
          ).filter(el =>
            !el.disabled && !el.readOnly && el.tabIndex !== -1 &&
            window.getComputedStyle(el).display !== 'none' &&
            window.getComputedStyle(el).visibility !== 'hidden'
          );

          const currentIndex = focusableElements.indexOf(targetElement);
          const nextIndex = currentIndex + 1;

          if (nextIndex < focusableElements.length) {
            focusableElements[nextIndex].focus();
          } else {
            // Comportamento para o último campo: submete o formulário
            form.submit();
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

  // --- Módulo 5: Funcionalidade de Logout ---
  function initLogout() {
    window.logout = function () {
      alert('Fazendo logout...');
      if (typeof BASE_URL !== 'undefined') {
        window.location.href = BASE_URL + '/auth/logout';
      } else {
        console.error('BASE_URL não definida. Não foi possível redirecionar para logout.');
        window.location.href = '/auth/logout';
      }
    };
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

  // --- Listener principal para DOMContentLoaded ---
  document.addEventListener('DOMContentLoaded', function () {
    initLoaderScreen();
    initDeleteConfirmation();
    initEnterKeyNavigation();
    initTooltips();
    initLogout();
    initSubmenuControl();
    initCustomizerButton();
    initScrollToTop();
    initSidebarToggle();
    ThemeSwitcher.init(); // Inicializa o seletor de tema
  });

})();