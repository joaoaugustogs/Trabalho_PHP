// Modal
const modal = document.getElementById('modal');
const openModalBtn = document.getElementById('openModal');
const closeModalBtn = document.getElementById('closeModal');

openModalBtn.addEventListener('click', () => {
  modal.classList.add('active');
});

closeModalBtn.addEventListener('click', () => {
  modal.classList.remove('active');
});

// Fecha modal ao clicar fora do conteúdo
modal.addEventListener('click', (e) => {
  if (e.target === modal) {
    modal.classList.remove('active');
  }
});

// Exemplo simples para envio do formulário
document.querySelector('.modal-content form').addEventListener('submit', (e) => {
  e.preventDefault();
  alert('Cadastro enviado com sucesso!');
  modal.classList.remove('active');
});
