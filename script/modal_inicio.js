const btnAbrirModal = document.querySelector('.cadastrarFilmes');
  const btnFecharModal = document.querySelector('.buttonFecharModal');
  const fundoModal = document.getElementById('fundoModal_registerFilme');

  // Abrir o modal
  btnAbrirModal.addEventListener('click', (e) => {
    e.preventDefault(); // evita que o link recarregue a página
    fundoModal.classList.remove('desativarModal');
    fundoModal.classList.add('ativarModal');
  });

  // Fechar o modal
  btnFecharModal.addEventListener('click', (e) => {
    e.preventDefault();
    fundoModal.classList.remove('ativarModal');
    fundoModal.classList.add('desativarModal');
  });