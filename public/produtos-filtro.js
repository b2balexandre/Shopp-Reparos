document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('categoria');
    const container = document.querySelector('.produtos-row, #produtosRow');
    if (!select || !container) return;
    function normalizar(str) {
        return (str || '').toString().trim().toLowerCase();
    }
    function filtrar() {
        const categoria = normalizar(select.value);
        const cards = container.querySelectorAll('.produto-card-item');
        cards.forEach(card => {
            const cardCategoria = normalizar(card.getAttribute('data-categoria'));
            if (!categoria || cardCategoria === categoria) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
    select.addEventListener('change', filtrar);
    filtrar(); // Aplica filtro ao carregar
    // Observa mudanças no DOM para reaplicar o filtro se os cards mudarem
    const observer = new MutationObserver(filtrar);
    observer.observe(container, { childList: true, subtree: true });
});
