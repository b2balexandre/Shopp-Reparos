function iniciarCarrossel(selector) {
    const carrossel = document.querySelector(selector);
    if (!carrossel) return;

    const slidesContainer = carrossel.querySelector('.slides');
    const slides = carrossel.querySelectorAll('.slide');
    const indicadoresContainer = carrossel.querySelector('.indicadores');
    const setaDireita = carrossel.querySelector('.seta.direita');
    const setaEsquerda = carrossel.querySelector('.seta.esquerda');

    let indiceAtual = 0;
    let autoplayInterval;

    // Cria os indicadores dinamicamente
    indicadoresContainer.innerHTML = '';
    slides.forEach((_, index) => {
        const bolinha = document.createElement('span');
        bolinha.classList.add('bolinha');
        if (index === 0) bolinha.classList.add('ativo');
        bolinha.addEventListener('click', () => {
            pausarAutoplay();
            irParaSlide(index);
        });
        indicadoresContainer.appendChild(bolinha);
    });

    const bolinhas = indicadoresContainer.querySelectorAll('.bolinha');

    function mostrarSlide(indice) {
        // Remove a classe ativo de todos os slides
        slides.forEach(slide => slide.classList.remove('ativo'));
        
        // Adiciona a classe ativo apenas ao slide atual
        slides[indice].classList.add('ativo');

        // Atualiza os indicadores (bolinhas)
        bolinhas.forEach(b => b.classList.remove('ativo'));
        bolinhas[indice].classList.add('ativo');
    }

    function irParaSlide(indice) {
        if (indice < 0) {
            indiceAtual = slides.length - 1;
        } else if (indice >= slides.length) {
            indiceAtual = 0;
        } else {
            indiceAtual = indice;
        }
        mostrarSlide(indiceAtual);
    }

    // Navegação manual com pausa do autoplay
    setaDireita.addEventListener('click', () => {
        pausarAutoplay();
        irParaSlide(indiceAtual + 1);
    });

    setaEsquerda.addEventListener('click', () => {
        pausarAutoplay();
        irParaSlide(indiceAtual - 1);
    });

    window.addEventListener('resize', () => {
        mostrarSlide(indiceAtual);
    });

    // Autoplay
    function iniciarAutoplay() {
        autoplayInterval = setInterval(() => {
            irParaSlide(indiceAtual + 1);
        }, 3000); // 3 segundos
    }

    function pausarAutoplay() {
        clearInterval(autoplayInterval);
    }

    // Pausar ao passar o mouse (desktop)
    carrossel.addEventListener('mouseenter', pausarAutoplay);
    carrossel.addEventListener('mouseleave', iniciarAutoplay);

    iniciarAutoplay();
    mostrarSlide(indiceAtual);
}

// 🧠 Detecta se é mobile ou desktop
function verificaTamanho() {
    return window.innerWidth <= 768 ? 'mobile' : 'desktop';
}

// Aguarda o DOM ser carregado antes de inicializar tudo
document.addEventListener('DOMContentLoaded', function() {
    // Inicialização dos carrosseis
    let tipoAtual = verificaTamanho();

    if (tipoAtual === 'mobile') {
        iniciarCarrossel('.carrossel-mobile');
    } else {
        iniciarCarrossel('.carrossel');
    }

    // 🔄 Observa se há mudança de tamanho (quebra entre mobile e desktop)
    window.addEventListener('resize', () => {
        const novoTipo = verificaTamanho();
        if (novoTipo !== tipoAtual) {
            tipoAtual = novoTipo;
            // Reinicia o carrossel correto
            if (novoTipo === 'mobile') {
                iniciarCarrossel('.carrossel-mobile');
            } else {
                iniciarCarrossel('.carrossel');
            }
        }
    });

    // Menu mobile
    const btnMenu = document.querySelector('.menu-mobile');
    const menu = document.querySelector('.menu');

    if (btnMenu && menu) {
        btnMenu.addEventListener('click', () => {
          menu.classList.toggle('active');

          if (menu.classList.contains('active')) {
            btnMenu.textContent = '×'; // muda para X
            btnMenu.setAttribute('aria-label', 'Fechar menu');
            btnMenu.classList.add('rotate'); // gira o botão
          } else {
            btnMenu.textContent = '☰'; // volta para hambúrguer
            btnMenu.setAttribute('aria-label', 'Abrir menu');
            btnMenu.classList.remove('rotate'); // volta à posição normal
          }
        });
    }
});

// Slider Assistência
const galleries = document.querySelectorAll('.galery');

galleries.forEach(galery => {
  const images = galery.querySelectorAll('img');
  let index = 0;

  setInterval(() => {
    images[index].classList.remove('active');
    index = (index + 1) % images.length;
    images[index].classList.add('active');
  }, 2000);
});

// Inicialização do Swiper movida para DOMContentLoaded (ver abaixo) para garantir carregamento correto

(function() {
  const carrossel = document.querySelector('.carrossel-parceiros');
  const btnEsquerda = document.querySelector('.parceiros-seta.esquerda');
  const btnDireita = document.querySelector('.parceiros-seta.direita');

  if (!carrossel || !btnEsquerda || !btnDireita) return;

  // Função para pausar/retomar a animação
  let animationPaused = false;
  
  const toggleAnimation = () => {
    if (animationPaused) {
      carrossel.style.animationPlayState = 'running';
      animationPaused = false;
    } else {
      carrossel.style.animationPlayState = 'paused';
      animationPaused = true;
    }
  };

  // Pausar animação ao clicar nas setas (apenas no desktop)
  if (window.innerWidth > 768) {
    btnEsquerda.addEventListener('click', () => {
      toggleAnimation();
      setTimeout(() => toggleAnimation(), 2000); // Retoma após 2 segundos
    });

    btnDireita.addEventListener('click', () => {
      toggleAnimation();
      setTimeout(() => toggleAnimation(), 2000); // Retoma após 2 segundos
    });
  }

  // Pausar animação ao tocar no mobile
  if (window.innerWidth <= 768) {
    carrossel.addEventListener('touchstart', () => {
      carrossel.style.animationPlayState = 'paused';
    });
    
    carrossel.addEventListener('touchend', () => {
      setTimeout(() => {
        carrossel.style.animationPlayState = 'running';
      }, 1000);
    });
  }
})();

document.addEventListener('DOMContentLoaded', function() {
    const servicosRow = document.getElementById('servicosRow');
    if (!servicosRow) return;

    fetch('/api/servicos')
        .then(response => response.json())
        .then(data => {
            servicosRow.innerHTML = '';
            data.forEach(servico => {
                const card = document.createElement('div');
                card.className = 'servico-card';
                card.innerHTML = `
                    <img src="${servico.imagem ? '/storage/' + servico.imagem : 'img/icones/servicos.svg'}" alt="${servico.titulo}">
                    <span>${servico.titulo}</span>
                `;
                servicosRow.appendChild(card);
            });
        })
        .catch(() => {
            servicosRow.innerHTML = '<p style="color:red">Erro ao carregar serviços.</p>';
        });
});

// Swiper stories - NÃO INTERFERE na renderização inicial
// Os slides já estão 100% visíveis via CSS antes deste script executar
(function initSwiperStories() {
    // Delay proposital para NÃO interferir na renderização inicial
    // Os slides já estão visíveis via CSS, então podemos esperar
    function initSwiper() {
        if (typeof Swiper === 'undefined') {
            return; // Swiper não carregou, mas slides já estão visíveis
        }
        
        const swiperContainer = document.querySelector('.container-stories .swiper, .mySwiper');
        if (!swiperContainer || swiperContainer.swiper) {
            return;
        }
        
        const slides = swiperContainer.querySelectorAll('.swiper-slide');
        const totalSlides = slides.length;
        if (totalSlides === 0) return;
        
        // Configuração que NÃO interfere nos estilos CSS já aplicados
        try {
            const swiper = new Swiper(swiperContainer, {
                init: false, // Não inicializa ainda
                direction: 'horizontal',
                speed: 300,
                lazy: false,
                preloadImages: false,
                watchSlidesProgress: false,
                observer: false,
                observeParents: false,
                slidesPerView: 'auto', // Usa largura automática (não força tamanho)
                spaceBetween: 15,
                freeMode: true, // Scroll livre - não força posições
                freeModeMomentum: false,
                freeModeSticky: false,
                resistance: true,
                resistanceRatio: 0,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                    hideOnClick: false,
                },
                breakpoints: {
                    0: {
                        slidesPerView: 'auto',
                        spaceBetween: 10,
                        freeMode: true,
                        navigation: false,
                    },
                    640: {
                        slidesPerView: 'auto',
                        spaceBetween: 15,
                    },
                    768: {
                        slidesPerView: 'auto',
                        spaceBetween: 15,
                    },
                    1024: {
                        slidesPerView: 'auto',
                        spaceBetween: 20,
                        navigation: false, // Esconde navegação quando todos estão visíveis
                    }
                },
                on: {
                    beforeInit: function() {
                        // Preserva os estilos CSS existentes e distribui de canto a canto
                        const wrapper = this.wrapperEl;
                        const container = this.el;
                        if (wrapper) {
                            wrapper.style.display = 'flex';
                            wrapper.style.justifyContent = 'space-between'; // Distribui de canto a canto
                            wrapper.style.width = '100%';
                            wrapper.style.transform = 'none';
                        }
                        if (container) {
                            container.style.overflow = 'hidden'; // Remove scroll
                        }
                    },
                    init: function() {
                        // Garante que os slides permaneçam visíveis e distribuídos
                        const wrapper = this.wrapperEl;
                        if (wrapper) {
                            wrapper.style.justifyContent = 'space-between'; // Distribui de canto a canto
                            wrapper.style.width = '100%';
                        }
                        this.slides.forEach(slide => {
                            slide.style.opacity = '1';
                            slide.style.visibility = 'visible';
                            slide.style.flex = '1 1 0'; // Distribui espaço igualmente
                        });
                        // Remove scroll no mobile
                        if (window.innerWidth <= 767) {
                            this.el.style.overflow = 'hidden';
                            if (wrapper) {
                                wrapper.style.flexWrap = 'wrap';
                                wrapper.style.justifyContent = 'space-between';
                            }
                        }
                    },
                    resize: function() {
                        // Mantém distribuído de canto a canto e sem scroll ao redimensionar
                        const wrapper = this.wrapperEl;
                        if (wrapper) {
                            wrapper.style.justifyContent = 'space-between'; // Distribui de canto a canto
                            wrapper.style.width = '100%';
                        }
                        if (window.innerWidth <= 767) {
                            this.el.style.overflow = 'hidden';
                            if (wrapper) {
                                wrapper.style.flexWrap = 'wrap';
                                wrapper.style.justifyContent = 'space-between';
                            }
                            // Mobile: 3 colunas
                            this.slides.forEach(slide => {
                                slide.style.flex = '0 0 calc(33.333% - 5px)';
                            });
                        } else {
                            if (wrapper) {
                                wrapper.style.flexWrap = 'nowrap';
                            }
                            // Desktop: distribuição igual
                            this.slides.forEach(slide => {
                                slide.style.flex = '1 1 0';
                            });
                        }
                    }
                }
            });
            
            // Inicializa apenas após um delay para não interferir na renderização inicial
            setTimeout(() => {
                if (!swiperContainer.swiper) {
                    swiper.init();
                }
            }, 100); // Pequeno delay para garantir que CSS já renderizou
            
        } catch (e) {
            // Se der erro, não faz nada - slides já estão visíveis via CSS
            console.log('Swiper initialization skipped:', e);
        }
    }
    
    // Aguarda DOM e Swiper estarem prontos, mas slides já estão visíveis
    if (document.readyState === 'complete') {
        // Espera um pouco para não interferir na renderização inicial
        setTimeout(initSwiper, 50);
    } else {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initSwiper, 50);
        });
    }
})(); 

// Melhorar interação com vídeos nos cards
document.addEventListener('DOMContentLoaded', function() {
    const videoCards = document.querySelectorAll('.card .video-container');
    
    videoCards.forEach(container => {
        const video = container.querySelector('video');
        if (video) {
            // Configurações essenciais para melhor aproveitamento do espaço
            video.style.objectFit = 'cover';
            video.style.objectPosition = 'center';
            video.style.maxWidth = '100%';
            video.style.maxHeight = '100%';
            video.style.width = '100%';
            video.style.height = '100%';
            
            // Adicionar classe loading inicialmente
            container.classList.add('loading');
            
            // Remover loading quando o vídeo carregar
            video.addEventListener('loadeddata', function() {
                container.classList.remove('loading');
            });
            
            // Adicionar classe playing quando o vídeo estiver reproduzindo
            video.addEventListener('play', function() {
                container.classList.add('playing');
            });
            
            // Remover classe playing quando o vídeo pausar
            video.addEventListener('pause', function() {
                container.classList.remove('playing');
            });
            
            // Permitir clicar no vídeo para pausar/reproduzir
            container.addEventListener('click', function() {
                if (video.paused) {
                    video.play();
                } else {
                    video.pause();
                }
            });
            
            // Adicionar indicador visual de que é clicável
            container.style.cursor = 'pointer';
            
            // Garantir que o vídeo seja responsivo e bem posicionado
            video.addEventListener('loadedmetadata', function() {
                // Forçar configurações para melhor aproveitamento
                video.style.objectFit = 'cover';
                video.style.objectPosition = 'center';
                
                // Ajustar posição do foco baseado na proporção do vídeo
                const aspectRatio = video.videoWidth / video.videoHeight;
                
                // Se o vídeo for muito largo, focar no centro
                if (aspectRatio > 1.5) {
                    video.style.objectPosition = 'center center';
                } else if (aspectRatio < 0.8) {
                    // Se for muito alto, focar no centro
                    video.style.objectPosition = 'center center';
                } else {
                    // Proporção equilibrada
                    video.style.objectPosition = 'center center';
                }
                
                // Remover loading se ainda estiver ativo
                container.classList.remove('loading');
            });
            
            // Tratar erros de carregamento
            video.addEventListener('error', function() {
                container.classList.remove('loading');
                console.log('Erro ao carregar vídeo:', video.src);
            });
            
            // Garantir que o vídeo seja reproduzido automaticamente no mobile
            if ('ontouchstart' in window) {
                video.setAttribute('playsinline', '');
                video.setAttribute('webkit-playsinline', '');
                video.setAttribute('muted', '');
                video.setAttribute('loop', '');
            }
            
            // Forçar configurações a cada frame para garantir que não sejam sobrescritas
            const observer = new MutationObserver(function() {
                if (video.style.objectFit !== 'cover') {
                    video.style.objectFit = 'cover';
                }
                if (video.style.objectPosition !== 'center center') {
                    video.style.objectPosition = 'center center';
                }
            });
            
            observer.observe(video, {
                attributes: true,
                attributeFilter: ['style']
            });
        }
    });
}); 

// Controle simples dos indicadores de parceiros
document.addEventListener('DOMContentLoaded', function() {
    const indicadores = document.querySelectorAll('.indicador');
    const parceirosGrid = document.querySelector('.parceiros-grid');
    
    if (!indicadores.length || !parceirosGrid) return;
    
    let currentSlide = 0;
    const totalSlides = indicadores.length;
    let isTransitioning = false;
    
    // Função para atualizar indicadores
    function updateIndicators() {
        indicadores.forEach((indicador, index) => {
            if (index === currentSlide) {
                indicador.classList.add('active');
            } else {
                indicador.classList.remove('active');
            }
        });
    }
    
    // Função para ir para slide específico
    function goToSlide(slideIndex) {
        if (isTransitioning) return; // Evitar múltiplas transições
        
        isTransitioning = true;
        currentSlide = slideIndex;
        updateIndicators();
        
        // Calcular posição de scroll baseada no slide
        const itemWidth = 140 + 25; // largura do item + gap
        const scrollPosition = slideIndex * itemWidth * 2; // 2 itens por "slide"
        
        parceirosGrid.scrollTo({
            left: scrollPosition,
            behavior: 'smooth'
        });
        
        // Permitir nova transição após 800ms (tempo da transição CSS)
        setTimeout(() => {
            isTransitioning = false;
        }, 800);
    }
    
    // Adicionar eventos de clique nos indicadores
    indicadores.forEach((indicador, index) => {
        indicador.addEventListener('click', () => {
            goToSlide(index);
        });
    });
    
    // Auto-play suave
    let autoPlayInterval = setInterval(() => {
        if (!isTransitioning) {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateIndicators();
            
            // Scroll automático suave
            const itemWidth = 140 + 25;
            const scrollPosition = currentSlide * itemWidth * 2;
            
            parceirosGrid.scrollTo({
                left: scrollPosition,
                behavior: 'smooth'
            });
        }
    }, 5000); // Aumentado para 5 segundos para transições mais suaves
    
    // Pausar auto-play ao interagir
    parceirosGrid.addEventListener('mouseenter', () => {
        clearInterval(autoPlayInterval);
    });
    
    parceirosGrid.addEventListener('mouseleave', () => {
        autoPlayInterval = setInterval(() => {
            if (!isTransitioning) {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateIndicators();
                
                const itemWidth = 140 + 25;
                const scrollPosition = currentSlide * itemWidth * 2;
                
                parceirosGrid.scrollTo({
                    left: scrollPosition,
                    behavior: 'smooth'
                });
            }
        }, 5000);
    });
    
    // Pausar auto-play ao tocar no mobile
    parceirosGrid.addEventListener('touchstart', () => {
        clearInterval(autoPlayInterval);
    });
    
    parceirosGrid.addEventListener('touchend', () => {
        setTimeout(() => {
            autoPlayInterval = setInterval(() => {
                if (!isTransitioning) {
                    currentSlide = (currentSlide + 1) % totalSlides;
                    updateIndicators();
                    
                    const itemWidth = 140 + 25;
                    const scrollPosition = currentSlide * itemWidth * 2;
                    
                    parceirosGrid.scrollTo({
                        left: scrollPosition,
                        behavior: 'smooth'
                    });
                }
            }, 5000);
        }, 1500); // Aumentado para 1.5 segundos
    });
    
    // Atualizar indicadores baseado no scroll (mais suave)
    let scrollTimeout;
    parceirosGrid.addEventListener('scroll', () => {
        clearTimeout(scrollTimeout);
        
        scrollTimeout = setTimeout(() => {
            const scrollLeft = parceirosGrid.scrollLeft;
            const itemWidth = 140 + 25;
            const currentSlideFromScroll = Math.round(scrollLeft / (itemWidth * 2));
            
            if (currentSlideFromScroll !== currentSlide && currentSlideFromScroll < totalSlides) {
                currentSlide = currentSlideFromScroll;
                updateIndicators();
            }
        }, 100); // Debounce para evitar atualizações excessivas
    });
}); 