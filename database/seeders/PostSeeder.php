<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Como Desentupir Vaso Sanitário: 7 Métodos Eficazes',
                'excerpt' => 'Aprenda 7 técnicas comprovadas para desentupir vaso sanitário sem precisar chamar um encanador. Métodos seguros e eficazes para resolver o problema rapidamente.',
                'category' => 'reparos-hidraulicos',
                'meta_keywords' => ['desentupir vaso sanitário', 'vaso entupido', 'desentupimento', 'reparo hidráulico', 'banheiro entupido'],
                'tags' => ['Desentupimento', 'Vaso Sanitário', 'DIY', 'Emergência'],
                'featured_image' => 'img/blog/desentupir-vaso-sanitario.jpg',
                'fallback_image' => 'img/blog/blog.svg'
            ],
            [
                'title' => 'Vazamento na Torneira: Causas e Soluções Definitivas',
                'excerpt' => 'Descubra as principais causas de vazamento em torneiras e como resolver de forma definitiva. Economize água e dinheiro com nossas dicas profissionais.',
                'category' => 'reparos-hidraulicos',
                'meta_keywords' => ['vazamento torneira', 'torneira pingando', 'reparo torneira', 'economia água', 'conserto torneira'],
                'tags' => ['Torneira', 'Vazamento', 'Economia', 'Reparo'],
                'featured_image' => 'img/blog/vazamento-torneira.jpg',
                'fallback_image' => 'img/blog/blog.svg'
            ],
            [
                'title' => 'Como Trocar Registro de Gaveta: Passo a Passo Completo',
                'excerpt' => 'Tutorial completo para trocar registro de gaveta com segurança. Ferramentas necessárias, dicas profissionais e cuidados importantes.',
                'category' => 'reparos-hidraulicos',
                'meta_keywords' => ['trocar registro gaveta', 'registro hidráulico', 'instalação hidráulica', 'encanamento', 'registro água'],
                'tags' => ['Registro', 'Instalação', 'Hidráulica', 'Tutorial'],
                'featured_image' => 'img/blog/trocar-registro-gaveta.jpg',
                'fallback_image' => 'img/blog/blog.svg'
            ],
            [
                'title' => 'Caixa d\'Água: Limpeza e Manutenção Preventiva',
                'excerpt' => 'Guia completo para limpeza e manutenção da caixa d\'água. Mantenha a qualidade da água da sua família com procedimentos seguros.',
                'category' => 'reparos-hidraulicos',
                'meta_keywords' => ['limpeza caixa água', 'manutenção caixa água', 'qualidade água', 'reservatório água', 'higiene água'],
                'tags' => ['Caixa d\'Água', 'Limpeza', 'Manutenção', 'Saúde'],
                'featured_image' => 'img/blog/limpeza-caixa-agua.jpg',
                'fallback_image' => 'img/blog/blog.svg'
            ],
            [
                'title' => 'Pressão da Água Baixa: 8 Causas e Como Resolver',
                'excerpt' => 'Identifique e resolva problemas de baixa pressão de água em casa. Soluções práticas e eficazes para aumentar a pressão do chuveiro e torneiras.',
                'category' => 'reparos-hidraulicos',
                'meta_keywords' => ['pressão água baixa', 'pouca pressão chuveiro', 'sistema hidráulico', 'bombas água', 'pressão torneira'],
                'tags' => ['Pressão', 'Chuveiro', 'Sistema Hidráulico', 'Bomba'],
                'featured_image' => 'img/blog/pressao-agua-baixa.jpg',
                'fallback_image' => 'img/blog/blog.svg'
            ],
            [
                'title' => 'Chuveiro Elétrico não Esquenta: 7 Causas e Soluções',
                'excerpt' => 'Descubra por que seu chuveiro elétrico não esquenta e como resolver os problemas mais comuns. Dicas para resistência, disjuntor e instalação.',
                'category' => 'eletrica',
                'meta_keywords' => ['chuveiro não esquenta', 'chuveiro elétrico frio', 'resistência chuveiro', 'reparo chuveiro', 'chuveiro sem água quente'],
                'tags' => ['Chuveiro Elétrico', 'Resistência', 'Reparo', 'Manutenção'],
                'featured_image' => 'img/blog/chuveiro-nao-esquenta.jpg',
                'fallback_image' => 'img/blog/blog.svg'
            ],
            [
                'title' => 'Como Trocar Interruptor de Luz: Tutorial Seguro',
                'excerpt' => 'Aprenda a trocar interruptor de luz com segurança. Procedimentos corretos, cuidados essenciais e normas de segurança elétrica.',
                'category' => 'eletrica',
                'meta_keywords' => ['trocar interruptor', 'interruptor luz', 'instalação elétrica', 'segurança elétrica', 'interruptor quebrado'],
                'tags' => ['Interruptor', 'Instalação', 'Segurança', 'Elétrica'],
                'featured_image' => 'img/blog/trocar-interruptor-luz.jpg',
                'fallback_image' => 'img/blog/blog.svg'
            ],
            [
                'title' => 'Ferramentas Básicas para Reparos Domésticos',
                'excerpt' => 'Lista completa das ferramentas essenciais que toda casa deveria ter para reparos básicos. Kit fundamental para emergências e manutenção.',
                'category' => 'ferramentas',
                'meta_keywords' => ['ferramentas básicas', 'kit ferramentas casa', 'ferramentas essenciais', 'reparo doméstico', 'caixa de ferramentas'],
                'tags' => ['Ferramentas', 'Kit Básico', 'Casa', 'Essencial'],
                'featured_image' => 'img/blog/ferramentas-basicas-casa.jpg',
                'fallback_image' => 'img/blog/blog.svg'
            ],
            [
                'title' => 'Como Pintar Parede: Guia Completo do Iniciante',
                'excerpt' => 'Tutorial completo para pintar paredes como um profissional. Técnicas, materiais necessários, preparação e dicas para um acabamento perfeito.',
                'category' => 'pintura',
                'meta_keywords' => ['como pintar parede', 'pintura parede', 'tutorial pintura', 'tinta parede', 'pintura casa'],
                'tags' => ['Pintura', 'Parede', 'Tutorial', 'DIY'],
                'featured_image' => 'img/blog/como-pintar-parede.jpg',
                'fallback_image' => 'img/blog/blog.svg'
            ],
            [
                'title' => 'Manutenção Preventiva Residencial: Cronograma Anual',
                'excerpt' => 'Cronograma completo de manutenção preventiva para manter sua casa sempre em perfeito estado. Evite problemas e economize dinheiro.',
                'category' => 'manutencao-geral',
                'meta_keywords' => ['manutenção preventiva', 'cronograma manutenção', 'cuidados casa', 'conservação residencial', 'manutenção casa'],
                'tags' => ['Manutenção', 'Preventiva', 'Cronograma', 'Casa'],
                'featured_image' => 'img/blog/manutencao-preventiva-cronograma.jpg',
                'fallback_image' => 'img/blog/blog.svg'
            ]
        ];

        foreach ($posts as $postData) {
            // Verifica se a imagem existe, caso contrário usa a imagem padrão
            $finalImage = $this->validateImagePath($postData['featured_image'], $postData['fallback_image']);
            
            Post::create([
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'excerpt' => $postData['excerpt'],
                'content' => $this->generateContent($postData['title']),
                'featured_image' => $finalImage,
                'meta_title' => $postData['title'] . ' | Shopp Reparos',
                'meta_description' => $postData['excerpt'],
                'meta_keywords' => $postData['meta_keywords'],
                'author_name' => 'Equipe Shopp Reparos',
                'category' => $postData['category'],
                'tags' => $postData['tags'],
                'published' => true,
                'published_at' => Carbon::now()->subDays(rand(1, 365))->subHours(rand(1, 23)),
                'views' => rand(50, 2000),
                'reading_time' => rand(3, 12)
            ]);
        }
    }

    /**
     * Valida se a imagem existe e retorna o caminho correto
     */
    private function validateImagePath($imagePath, $fallbackPath = null)
    {
        // Verifica se a imagem principal existe
        if (File::exists(public_path($imagePath))) {
            return $imagePath;
        }

        // Se não existir e tiver fallback, verifica o fallback
        if ($fallbackPath && File::exists(public_path($fallbackPath))) {
            return $fallbackPath;
        }

        // Se nenhuma imagem existir, retorna uma imagem padrão genérica
        $defaultImages = [
            'img/blog/blog.svg',
            'img/blog.svg',
            'img/iconfav.png'
        ];

        foreach ($defaultImages as $defaultImage) {
            if (File::exists(public_path($defaultImage))) {
                return $defaultImage;
            }
        }

        // Se nada existir, retorna null (sem imagem)
        return null;
    }

    private function generateContent($title)
    {
        return "<h2>Introdução</h2>
<p>Este guia completo sobre <strong>{$title}</strong> foi desenvolvido pelos especialistas da Shopp Reparos para ajudar você a resolver este problema de forma eficiente e segura.</p>

<h3>Por que é importante resolver este problema?</h3>
<p>Manter os sistemas da sua casa em perfeito funcionamento é essencial para:</p>
<ul>
<li>Garantir a segurança da sua família</li>
<li>Evitar desperdícios e gastos desnecessários</li>
<li>Prevenir problemas maiores no futuro</li>
<li>Manter o valor do seu imóvel</li>
</ul>

<h3>Materiais e Ferramentas Necessárias</h3>
<p>Antes de começar, certifique-se de ter em mãos:</p>
<ul>
<li>Ferramentas básicas de qualidade</li>
<li>Materiais específicos para o reparo</li>
<li>Equipamentos de proteção individual (EPI)</li>
<li>Manual do fabricante (quando aplicável)</li>
</ul>

<h3>Passo a Passo Detalhado</h3>
<ol>
<li><strong>Diagnóstico:</strong> Avalie cuidadosamente a situação antes de agir</li>
<li><strong>Preparação:</strong> Reúna todos os materiais e desligue sistemas quando necessário</li>
<li><strong>Execução:</strong> Siga as instruções de segurança rigorosamente</li>
<li><strong>Teste:</strong> Verifique se o problema foi resolvido adequadamente</li>
<li><strong>Limpeza:</strong> Organize o local e descarte materiais adequadamente</li>
</ol>

<blockquote>
<strong>Dica Profissional:</strong> Se você não se sentir seguro realizando o reparo, não hesite em procurar ajuda profissional. A segurança deve ser sempre a prioridade.
</blockquote>

<h3>Manutenção Preventiva</h3>
<p>Para evitar que o problema se repita:</p>
<ul>
<li>Faça inspeções regulares</li>
<li>Substitua peças conforme recomendação do fabricante</li>
<li>Use produtos de qualidade</li>
<li>Mantenha registros de manutenção</li>
</ul>

<h3>Quando Chamar um Profissional</h3>
<p>Procure ajuda especializada se:</p>
<ul>
<li>O problema persistir após sua intervenção</li>
<li>Você identificar questões mais complexas</li>
<li>Houver risco de segurança</li>
<li>For necessário conhecimento técnico específico</li>
</ul>

<h3>Conclusão</h3>
<p>Com as informações deste guia e um pouco de cuidado, você pode resolver muitos problemas domésticos de forma segura e econômica. Lembre-se de que a Shopp Reparos está sempre disponível para ajudar com materiais de qualidade e orientação técnica.</p>

<p><strong>Precisa de materiais para o reparo?</strong> Visite uma de nossas lojas ou entre em contato conosco. Nossa equipe terá prazer em ajudar você!</p>";
    }
}