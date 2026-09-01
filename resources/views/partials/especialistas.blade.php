<!-- Seção de Especialistas em Reparos Hidráulicos -->
<section class="especialistas-section">
    <div class="container">
        <!-- Cabeçalho -->
        <div class="section-header">
            <h2 class="section-title">
                Especialistas em <span class="title-highlight">Reparos Hidráulicos</span>
            </h2>
        </div>

        <!-- Galeria de Imagens -->
        <div class="gallery-grid">
            <!-- Imagem 1 -->
            <div class="gallery-item">
                <img src="{{ asset('img/reparoshidraulicos/01.webp') }}" alt="Serviços Hidráulicos">
            </div>

            <!-- Imagem 2 -->
            <div class="gallery-item">
                <img src="{{ asset('img/reparoshidraulicos/2.webp') }}" alt="Serviços Hidráulicos">
            </div>

            <!-- Imagem 3 -->
            <div class="gallery-item">
                <img src="{{ asset('img/reparoshidraulicos/4.webp') }}" alt="Serviços Hidráulicos">
            </div>
        </div>

        <!-- Call to Action -->
        <div class="cta-section">
            <div class="cta-buttons">
                <a href="https://api.whatsapp.com/send?phone=5561996096296&text=Ol%C3%A1+vim+pelo+site+%21" class="cta-btn whatsapp-primary" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp Águas Claras</span>
                </a>
                <a href="https://api.whatsapp.com/send?phone=5561999318077&text=Ol%C3%A1+%21+Vim+pelo+site." class="cta-btn whatsapp-secondary" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp Taguatinga</span>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
/* Estilos para a seção de especialistas */
.especialistas-section {
    background: #ffffff;
    padding: 60px 0;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Cabeçalho da seção */
.section-header {
    text-align: center;
    margin-bottom: 50px;
}

.section-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
}

.title-highlight {
    color: #2563eb;
}

/* Galeria de imagens */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    margin-bottom: 50px;
}

.gallery-item {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

.gallery-item img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    object-position: center;
    transform: scale(1.1);
    transition: transform 0.3s ease;
}

.gallery-item:hover img {
    transform: scale(1.15);
}

/* Call to Action */
.cta-section {
    background: linear-gradient(135deg, #1e40af, #3b82f6);
    border-radius: 12px;
    padding: 40px;
    text-align: center;
    color: white;
}

.cta-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
    align-items: center;
    width: 100%;
}

.cta-btn {
    padding: 15px 30px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
    min-width: 200px;
    text-align: center;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    white-space: nowrap;
    box-sizing: border-box;
    gap: 8px;
}

.cta-btn i {
    font-size: 1.1em;
    line-height: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cta-btn span {
    line-height: 1;
    display: inline-block;
}

.whatsapp-primary {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.whatsapp-primary:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

.whatsapp-secondary {
    background: white;
    color: #1e40af;
    border: 2px solid white;
}

.whatsapp-secondary:hover {
    background: #f8fafc;
    transform: translateY(-2px);
}

/* Responsividade */
@media (max-width: 768px) {
    .section-title {
        font-size: 2rem;
    }
    
    .gallery-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
        gap: 15px;
        width: 100%;
    }
    
    .cta-btn {
        width: 100%;
        max-width: 280px;
        min-width: auto;
        padding: 12px 24px;
        font-size: 0.95rem;
        justify-content: center;
    }
    
    .cta-section {
        padding: 30px 20px;
    }
}

@media (max-width: 480px) {
    .especialistas-section {
        padding: 40px 0;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .gallery-item img {
        height: 200px;
    }
}
</style>
