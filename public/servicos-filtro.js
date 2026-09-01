document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('marca');
    const container = document.querySelector('.servicos-row, #servicos-lista');
    if (!select || !container) return;
    function normalizar(str) {
        return (str || '').toString().trim().toLowerCase();
    }
    function filtrar() {
        const marca = normalizar(select.value);
        const cards = container.querySelectorAll('.servico-card-item');
        cards.forEach(card => {
            const cardMarca = normalizar(card.getAttribute('data-marca'));
            if (!marca || cardMarca === marca) {
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
