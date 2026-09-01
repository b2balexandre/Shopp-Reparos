#!/bin/bash

# Script de Deploy para Imagens do Blog - Shopp Reparos
# Este script garante que todas as imagens necessárias estejam disponíveis em produção

echo "🚀 Iniciando deploy das imagens do blog..."

# Configurações
BLOG_IMAGES_DIR="public/img/blog"
REQUIRED_IMAGES=(
    "desentupir-vaso-sanitario.jpg"
    "vazamento-torneira.jpg"
    "trocar-registro-gaveta.jpg"
    "limpeza-caixa-agua.jpg"
    "pressao-agua-baixa.jpg"
    "chuveiro-nao-esquenta.jpg"
    "trocar-interruptor-luz.jpg"
    "ferramentas-basicas-casa.jpg"
    "como-pintar-parede.jpg"
    "manutencao-preventiva-cronograma.jpg"
)

FALLBACK_IMAGES=(
    "blog.svg"
    "iconfav.png"
)

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Função para log colorido
log_info() {
    echo -e "${GREEN}✅ $1${NC}"
}

log_warn() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

log_error() {
    echo -e "${RED}❌ $1${NC}"
}

# Verifica se o diretório existe
if [ ! -d "$BLOG_IMAGES_DIR" ]; then
    log_warn "Diretório $BLOG_IMAGES_DIR não existe. Criando..."
    mkdir -p "$BLOG_IMAGES_DIR"
fi

# Verifica imagens principais
echo "🔍 Verificando imagens principais..."
missing_images=0

for image in "${REQUIRED_IMAGES[@]}"; do
    if [ -f "$BLOG_IMAGES_DIR/$image" ]; then
        log_info "$image - Disponível"
    else
        log_warn "$image - NÃO ENCONTRADA"
        missing_images=$((missing_images + 1))
    fi
done

# Verifica imagens de fallback
echo -e "\n🔍 Verificando imagens de fallback..."
for image in "${FALLBACK_IMAGES[@]}"; do
    if [ -f "public/img/$image" ]; then
        log_info "$image - Disponível como fallback"
    else
        log_warn "$image - Fallback não encontrado"
    fi
done

# Relatório final
echo -e "\n📊 RELATÓRIO DE VERIFICAÇÃO:"
echo "Total de imagens necessárias: ${#REQUIRED_IMAGES[@]}"
echo "Imagens disponíveis: $((${#REQUIRED_IMAGES[@]} - missing_images))"
echo "Imagens em falta: $missing_images"

if [ $missing_images -gt 0 ]; then
    log_warn "ATENÇÃO: $missing_images imagens estão em falta!"
    log_warn "Os posts serão criados com imagens de fallback ou sem imagem."
    echo -e "\n💡 RECOMENDAÇÕES:"
    echo "1. Verifique se todas as imagens foram enviadas para o servidor"
    echo "2. Confirme os nomes dos arquivos (case-sensitive)"
    echo "3. Execute o seeder mesmo assim - ele usará fallbacks"
else
    log_info "Todas as imagens estão disponíveis!"
fi

# Verifica permissões
echo -e "\n🔐 Verificando permissões..."
if [ -d "$BLOG_IMAGES_DIR" ]; then
    chmod 755 "$BLOG_IMAGES_DIR"
    log_info "Permissões do diretório ajustadas"
fi

# Lista todas as imagens disponíveis
echo -e "\n📁 Imagens disponíveis no diretório:"
ls -la "$BLOG_IMAGES_DIR" | grep -E "\.(jpg|jpeg|png|webp|svg)$" | head -20

echo -e "\n🎯 Deploy das imagens concluído!"
echo "Execute o seeder com: php artisan blog:seed-production"

