<script>
  const toggleButton = document.getElementById('theme-toggle');

  // Sayfa yüklenince localStorage'dan tema al
  window.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme') || 'light-mode';
    document.body.classList.add(savedTheme);
    updateButtonText(savedTheme);
  });

  toggleButton.addEventListener('click', () => {
    let currentTheme = document.body.classList.contains('dark-mode') ? 'dark-mode' : 'light-mode';
    let newTheme = currentTheme === 'dark-mode' ? 'light-mode' : 'dark-mode';

    document.body.classList.remove(currentTheme);
    document.body.classList.add(newTheme);
    localStorage.setItem('theme', newTheme);
    updateButtonText(newTheme);
  });

  function updateButtonText(theme) {
    toggleButton.textContent = theme === 'dark-mode' ? '☀️ Açık Mod' : '🌙 Karanlık Mod';
  }
</script>
