/* =============================================
   McDollibee — script.js
   Theme toggle | Modal | Form switch |
   Password toggle | Hamburger | Validation |
   Scroll reveal | Toasts
   ============================================= */

document.addEventListener('DOMContentLoaded', () => {

  /* ─── ELEMENTS ─── */
  const htmlRoot      = document.getElementById('htmlRoot');
  const themeToggle   = document.getElementById('themeToggle');
  const themeIcon     = document.getElementById('themeIcon');
  const modalOverlay  = document.getElementById('modalOverlay');
  const modalBox      = document.getElementById('modalBox');
  const modalClose    = document.getElementById('modalClose');
  const openLogin     = document.getElementById('openLogin');
  const openRegister  = document.getElementById('openRegister');
  const orderNow      = document.getElementById('orderNow');
  const loginPanel    = document.getElementById('loginPanel');
  const registerPanel = document.getElementById('registerPanel');
  const goRegister    = document.getElementById('goRegister');
  const goLogin       = document.getElementById('goLogin');
  const hamburger     = document.getElementById('hamburger');
  const mobileMenu    = document.getElementById('mobileMenu');

  /* =============================================
     THEME
     ============================================= */
  const saved = localStorage.getItem('mcd-theme') || 'light';
  applyTheme(saved);

  if (themeToggle) {
    themeToggle.addEventListener('click', () => {
      const next = htmlRoot.classList.contains('dark') ? 'light' : 'dark';
      applyTheme(next);
      localStorage.setItem('mcd-theme', next);
    });
  }

  function applyTheme(theme) {
    if (theme === 'dark') {
      htmlRoot.classList.add('dark');
      if (themeIcon) themeIcon.className = 'fa-solid fa-moon';
      if (themeToggle) themeToggle.title = 'Switch to Light Mode';
    } else {
      htmlRoot.classList.remove('dark');
      if (themeIcon) themeIcon.className = 'fa-solid fa-sun';
      if (themeToggle) themeToggle.title = 'Switch to Dark Mode';
    }
  }

  /* =============================================
     MODAL OPEN / CLOSE — index.php only
     ============================================= */
  if (!modalOverlay) return; // ← stop here on dashboard, theme already applied

  function openModal(panel) {
    loginPanel.classList.toggle('hidden',    panel !== 'login');
    registerPanel.classList.toggle('hidden', panel !== 'register');
    modalOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    modalOverlay.classList.remove('active');
    document.body.style.overflow = '';
  }

  if (openLogin)    openLogin.addEventListener('click',    () => openModal('login'));
  if (openRegister) openRegister.addEventListener('click', () => openModal('register'));
  if (orderNow)     orderNow.addEventListener('click',     () => openModal('register'));
  if (modalClose)   modalClose.addEventListener('click',   closeModal);

  modalOverlay.addEventListener('click', e => {
    if (e.target === modalOverlay) closeModal();
  });

  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeModal();
  });

  /* =============================================
     TOGGLE LOGIN ↔ REGISTER
     ============================================= */
  if (goRegister) {
    goRegister.addEventListener('click', () => {
      loginPanel.classList.add('hidden');
      registerPanel.classList.remove('hidden');
      modalBox.scrollTop = 0;
    });
  }

  if (goLogin) {
    goLogin.addEventListener('click', () => {
      registerPanel.classList.add('hidden');
      loginPanel.classList.remove('hidden');
      modalBox.scrollTop = 0;
    });
  }

  /* =============================================
     PASSWORD VISIBILITY TOGGLE
     ============================================= */
  document.querySelectorAll('.toggle-pass').forEach(eye => {
    eye.addEventListener('click', () => {
      const input = eye.closest('.input-wrap').querySelector('input');
      if (!input) return;
      const isPassword = input.type === 'password';
      input.type      = isPassword ? 'text' : 'password';
      eye.className   = isPassword
        ? 'fa-solid fa-eye-slash toggle-pass'
        : 'fa-solid fa-eye toggle-pass';
    });
  });

  /* =============================================
     HAMBURGER / MOBILE MENU
     ============================================= */
  if (hamburger) {
    hamburger.addEventListener('click', () => {
      const isOpen = mobileMenu.classList.toggle('open');
      hamburger.innerHTML = isOpen
        ? '<i class="fa-solid fa-xmark"></i>'
        : '<i class="fa-solid fa-bars"></i>';
    });

    mobileMenu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.remove('open');
        hamburger.innerHTML = '<i class="fa-solid fa-bars"></i>';
      });
    });
  }

  /* =============================================
     FORM VALIDATION
     ============================================= */
  function highlightEmpty(panel) {
    let valid = true;
    panel.querySelectorAll('input').forEach(input => {
      const wrap = input.closest('.input-wrap');
      wrap.style.borderColor = '';
      if (!input.value.trim()) {
        wrap.style.borderColor = '#CC0000';
        valid = false;
      }
    });
    return valid;
  }

  /* LOGIN */
  if (loginPanel && loginPanel.querySelector('.btn-submit')) {
    loginPanel.querySelector('.btn-submit').addEventListener('click', function () {
      if (!highlightEmpty(loginPanel)) return;
      this.innerHTML = '<i class="fa-solid fa-circle-check"></i> Logged In!';
      this.style.background = '#27ae60';
      setTimeout(() => {
        closeModal();
        this.innerHTML = 'Login <i class="fa-solid fa-right-to-bracket"></i>';
        this.style.background = '';
        loginPanel.querySelectorAll('input').forEach(i => i.value = '');
      }, 1500);
    });
  }

  /* REGISTER */
  if (registerPanel && registerPanel.querySelector('.btn-submit')) {
    registerPanel.querySelector('.btn-submit').addEventListener('click', function () {
      if (!highlightEmpty(registerPanel)) return;

      const passInputs = [...registerPanel.querySelectorAll('input[type="password"]')];
      if (passInputs.length >= 2) {
        const p1 = passInputs[passInputs.length - 2];
        const p2 = passInputs[passInputs.length - 1];
        if (p1.value !== p2.value) {
          [p1, p2].forEach(p => p.closest('.input-wrap').style.borderColor = '#CC0000');
          showToast('Passwords do not match!', 'error');
          return;
        }
      }

      this.innerHTML = '<i class="fa-solid fa-circle-check"></i> Account Created!';
      this.style.background = '#27ae60';
      setTimeout(() => {
        registerPanel.classList.add('hidden');
        loginPanel.classList.remove('hidden');
        this.innerHTML = 'Create Account <i class="fa-solid fa-user-plus"></i>';
        this.style.background = '';
        registerPanel.querySelectorAll('input').forEach(i => i.value = '');
        showToast('Account created! Please log in.', 'success');
      }, 1500);
    });
  }

  /* =============================================
     TOAST NOTIFICATIONS
     ============================================= */
  function showToast(message, type = 'success') {
    document.querySelector('.mcd-toast')?.remove();
    const toast = Object.assign(document.createElement('div'), {
      className: 'mcd-toast',
      textContent: message,
    });
    Object.assign(toast.style, {
      position: 'fixed',
      bottom: '2rem',
      left: '50%',
      transform: 'translateX(-50%) translateY(20px)',
      background: type === 'success' ? '#27ae60' : '#CC0000',
      color: 'white',
      padding: '0.75rem 1.75rem',
      borderRadius: '10px',
      fontFamily: "'Nunito', sans-serif",
      fontWeight: '800',
      fontSize: '0.95rem',
      zIndex: '9999',
      boxShadow: '0 8px 24px rgba(0,0,0,0.25)',
      transition: 'transform 0.3s, opacity 0.3s',
      opacity: '0',
      pointerEvents: 'none',
    });
    document.body.appendChild(toast);

    requestAnimationFrame(() => requestAnimationFrame(() => {
      toast.style.transform = 'translateX(-50%) translateY(0)';
      toast.style.opacity = '1';
    }));

    setTimeout(() => {
      toast.style.transform = 'translateX(-50%) translateY(20px)';
      toast.style.opacity = '0';
      setTimeout(() => toast.remove(), 400);
    }, 3000);
  }

  /* =============================================
     SCROLL REVEAL
     ============================================= */
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });

  document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

});