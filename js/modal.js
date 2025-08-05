window.addEventListener('DOMContentLoaded', () => {
  // Exibir modal uma vez
  if (!localStorage.getItem('modalShown')) {
    const modal = document.getElementById('meuModal');
    if (modal) {
      modal.style.display = 'block';
      localStorage.setItem('modalShown', 'true');
    }
  }

  const fecharBtn = document.getElementById('fecharModal');
  if (fecharBtn) {
    fecharBtn.addEventListener('click', () => {
      const modal = document.getElementById('meuModal');
      if (modal) modal.style.display = 'none';
    });
  }
});

// Dropdown de perfil
function toggleDropdown(event) {
  event.stopPropagation();
  const menu = document.getElementById('profileDropdown');
  if (menu) {
    menu.classList.toggle('show');
  }
}

document.addEventListener('click', function (event) {
  const profile = document.querySelector('.user-profile');
  const menu = document.getElementById('profileDropdown');
  if (menu && !profile.contains(event.target)) {
    menu.classList.remove('show');
  }
});

