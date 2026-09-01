// =====================
// CARROSSEL DE SERVIÇOS (API)
// =====================

// Função para buscar serviços da API e popular o carrossel
async function carregarServicosAPI() {
    try {
        // Detecta ambiente local ou produção
        let apiUrl = '/api/servicos';
        if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
            apiUrl = 'http://127.0.0.1:8000/api/servicos';
        }
        const response = await fetch(apiUrl);
        if (!response.ok) return;
        const servicos = await response.json();
        const row = document.getElementById('servicosRow');
        if (!row) return;
        row.innerHTML = '';
        servicos.forEach(servico => {
            const card = document.createElement('div');
            card.className = 'servico-card servico-card-item'; // Adiciona classe necessária para filtro
            card.setAttribute('data-marca', servico.marca || ''); // Adiciona atributo necessário para filtro
            let imgSrc = servico.imagem ? `/storage/${servico.imagem}` : 'img/icones/servicos.svg';
            let desc = servico.descricao ? servico.descricao : 'Descrição breve do serviço.';
            if (desc.length > 80) desc = desc.substring(0, 77) + '...';
            card.innerHTML = `
                <img src="${imgSrc}" alt="${servico.titulo}">
                <span>${servico.titulo}</span>
                <div class="servico-desc">${desc}</div>
                <button class="servico-btn" onclick="event.stopPropagation(); window.open('/site/servicos/${servico.id}','_blank')">
                    <svg width='20' height='20' fill='none' viewBox='0 0 24 24' style='vertical-align:middle;margin-right:6px;'><path d='M6 6h15l-1.5 9h-13z' stroke='#fff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/><circle cx='9' cy='21' r='1' fill='#fff'/><circle cx='18' cy='21' r='1' fill='#fff'/></svg>
                    Ver detalhes
                </button>
            `;
            card.style.cursor = 'pointer';
            card.onclick = function(e) {
                if (!e.target.classList.contains('servico-btn')) {
                    window.open(`/site/servicos/${servico.id}`, '_blank');
                }
            };
            row.appendChild(card);
        });
    } catch (e) {
        // fallback: não faz nada
    }
}

document.addEventListener('DOMContentLoaded', carregarServicosAPI);
