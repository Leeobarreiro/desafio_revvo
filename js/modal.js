window.addEventListener('DOMContentLoaded', () => {
  if (!localStorage.getItem('modalShown')) {
    document.getElementById('meuModal').style.display = 'block';
    localStorage.setItem('modalShown', 'true');
  }

  document.getElementById('fecharModal').addEventListener('click', () => {
    document.getElementById('meuModal').style.display = 'none';
  });
});
