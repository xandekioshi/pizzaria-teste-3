// GRANDE PARTE DO JAVA FOI REVISADO E COMPLEMENTADO PELO CLAUDE OPUS 4.8
document.addEventListener('DOMContentLoaded', () => {
  const abas = document.querySelectorAll('.cardapio__aba');
  const categoriaPizzas = document.getElementById('categoria-pizzas');
  const categoriaBebidas = document.getElementById('categoria-bebidas');

  abas.forEach((aba) => {
    aba.addEventListener('click', () => {
   
      abas.forEach((a) => {
        a.classList.remove('is-ativa');
        a.setAttribute('aria-selected', 'false');
      });
      aba.classList.add('is-ativa');
      aba.setAttribute('aria-selected', 'true');


      const categoria = aba.dataset.categoria;
      categoriaPizzas.hidden = categoria !== 'pizzas';
      categoriaBebidas.hidden = categoria !== 'bebidas';
    });
  });
});
