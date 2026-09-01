# 🚀 Deploy do Blog em Produção - Shopp Reparos

Este documento garante que todos os seeders do blog funcionem perfeitamente em produção, incluindo as imagens.

## 📋 Pré-requisitos

- Laravel 10+ instalado
- Banco de dados configurado e funcionando
- Todas as migrações executadas
- Imagens do blog enviadas para o servidor

## 🔧 Configuração de Produção

### 1. Variáveis de Ambiente

Certifique-se de que seu arquivo `.env` tenha as configurações corretas:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://seudominio.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

FILESYSTEM_DISK=local
```

### 2. Permissões de Arquivos

```bash
# Ajuste as permissões dos diretórios
chmod -R 755 public/img
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# Propriedade dos arquivos (se necessário)
chown -R www-data:www-data public/img
chown -R www-data:www-data storage
```

## 🖼️ Preparação das Imagens

### 1. Estrutura de Diretórios

```
public/
├── img/
│   ├── blog/
│   │   ├── desentupir-vaso-sanitario.jpg
│   │   ├── vazamento-torneira.jpg
│   │   ├── trocar-registro-gaveta.jpg
│   │   ├── limpeza-caixa-agua.jpg
│   │   ├── pressao-agua-baixa.jpg
│   │   ├── chuveiro-nao-esquenta.jpg
│   │   ├── trocar-interruptor-luz.jpg
│   │   ├── ferramentas-basicas-casa.jpg
│   │   ├── como-pintar-parede.jpg
│   │   └── manutencao-preventiva-cronograma.jpg
│   ├── blog.svg
│   └── iconfav.png
```

### 2. Verificação Automática

Execute o script de verificação:

```bash
# Torne o script executável
chmod +x deploy-blog-images.sh

# Execute a verificação
./deploy-blog-images.sh
```

## 🌱 Execução dos Seeders

### 1. Comando Seguro para Produção

```bash
# Comando principal (com confirmação)
php artisan blog:seed-production

# Comando forçado (sem confirmação)
php artisan blog:seed-production --force
```

### 2. Comando Tradicional (se preferir)

```bash
php artisan db:seed
```

### 3. Seeder Específico

```bash
# Apenas posts
php artisan db:seed --class=PostSeeder

# Apenas banners
php artisan db:seed --class=BannerSeeder
```

## 🔍 Verificação Pós-Deploy

### 1. Verificar Posts Criados

```bash
# Acesse o tinker
php artisan tinker

# Verifique os posts
App\Models\Post::count();
App\Models\Post::whereNull('featured_image')->count();
App\Models\Post::first()->featured_image;
```

### 2. Verificar no Navegador

- Acesse: `https://seudominio.com/blog`
- Verifique se os posts aparecem com imagens
- Teste a navegação entre categorias

### 3. Verificar Logs

```bash
tail -f storage/logs/laravel.log
```

## 🚨 Solução de Problemas

### Problema: Posts sem Imagem

**Sintoma**: Posts aparecem sem imagem de destaque

**Solução**:
1. Verifique se as imagens existem em `public/img/blog/`
2. Confirme os nomes dos arquivos (case-sensitive)
3. Execute o seeder novamente

### Problema: Erro de Permissão

**Sintoma**: Erro 403 ao acessar imagens

**Solução**:
```bash
chmod -R 755 public/img
chown -R www-data:www-data public/img
```

### Problema: Imagens não Carregam

**Sintoma**: Imagens quebradas (ícone de imagem quebrada)

**Solução**:
1. Verifique o caminho das imagens no banco
2. Confirme se os arquivos existem no servidor
3. Verifique as configurações do servidor web

## 📊 Monitoramento

### 1. Verificar Status dos Posts

```bash
# Posts publicados
php artisan tinker
App\Models\Post::published()->count();

# Posts por categoria
App\Models\Post::selectRaw('category, count(*) as total')->groupBy('category')->get();
```

### 2. Verificar Performance

```bash
# Tempo de carregamento das páginas
# Use ferramentas como Google PageSpeed Insights
# Monitore logs de erro do servidor
```

## 🔄 Atualizações Futuras

### 1. Adicionar Novos Posts

1. Adicione as imagens em `public/img/blog/`
2. Atualize o seeder correspondente
3. Execute: `php artisan blog:seed-production`

### 2. Modificar Posts Existentes

1. Use o painel admin ou
2. Atualize diretamente no banco de dados
3. Limpe o cache: `php artisan cache:clear`

## 📞 Suporte

Se encontrar problemas:

1. Verifique os logs em `storage/logs/`
2. Execute o script de verificação: `./deploy-blog-images.sh`
3. Use o comando de debug: `php artisan blog:seed-production`
4. Verifique as permissões dos arquivos

## ✅ Checklist de Deploy

- [ ] Todas as imagens enviadas para o servidor
- [ ] Permissões configuradas corretamente
- [ ] Banco de dados configurado
- [ ] Migrações executadas
- [ ] Script de verificação executado
- [ ] Seeder executado com sucesso
- [ ] Posts verificados no navegador
- [ ] Imagens carregando corretamente
- [ ] Logs verificados
- [ ] Performance testada

---

**🎯 Resultado Esperado**: Blog funcionando perfeitamente em produção com todas as imagens carregando corretamente e posts sendo exibidos adequadamente.

