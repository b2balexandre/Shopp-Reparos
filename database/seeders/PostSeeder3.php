<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PostSeeder3 extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Sifão Entupido: Como Limpar e Desentupir Facilmente',
                'excerpt' => 'Técnicas eficazes para desentupir sifão de pia, tanque e lavatório. Mantenha o escoamento perfeito com métodos caseiros e profissionais.',
                'category' => 'reparos-hidraulicos',
                'meta_keywords' => ['sifão entupido', 'desentupir pia', 'sifão lavatório', 'limpeza sifão', 'pia entupida'],
                'tags' => ['Sifão', 'Desentupimento', 'Pia', 'Limpeza'],
                'featured_image' => 'img/blog/sifao-entupido.jpg'
            ],
            [
                'title' => 'Como Trocar a Válvula de Descarga: Tutorial Prático',
                'excerpt' => 'Passo a passo para trocar válvula de descarga com segurança. Economize dinheiro fazendo você mesmo com nossas dicas profissionais.',
                'category' => 'reparos-hidraulicos',
                'meta_keywords' => ['trocar válvula descarga', 'válvula descarga quebrada', 'reparo vaso sanitário', 'válvula hydra'],
                'tags' => ['Válvula de Descarga', 'Vaso Sanitário', 'Troca', 'DIY'],
                'featured_image' => 'img/blog/trocar-valvula-descarga.jpg'
            ],
            [
                'title' => 'Aquecedor de Água: Manutenção e Problemas Comuns',
                'excerpt' => 'Guia completo de manutenção para aquecedores a gás e elétricos. Prolongue a vida útil do equipamento e evite problemas futuros.',
                'category' => 'reparos-hidraulicos',
                'meta_keywords' => ['manutenção aquecedor', 'aquecedor água problemas', 'aquecedor gás', 'aquecedor elétrico', 'boiler'],
                'tags' => ['Aquecedor', 'Manutenção', 'Gás', 'Elétrico'],
                'featured_image' => 'img/blog/manutencao-aquecedor-agua.jpg'
            ],
            [
                'title' => 'Rede de Esgoto Entupida: Sinais e Soluções',
                'excerpt' => 'Identifique sinais de entupimento na rede de esgoto e conheça soluções eficazes para resolver. Quando chamar desentupidora profissional.',
                'category' => 'reparos-hidraulicos',
                'meta_keywords' => ['rede esgoto entupida', 'esgoto entupido', 'desentupimento esgoto', 'saneamento', 'fossa entupida'],
                'tags' => ['Esgoto', 'Desentupimento', 'Saneamento', 'Emergência'],
                'featured_image' => 'img/blog/rede-esgoto-entupida.jpg'
            ],
            [
                'title' => 'Como Instalar Ventilador de Teto: Guia Completo',
                'excerpt' => 'Instalação segura de ventilador de teto: fixação correta, ligação elétrica, balanceamento e dicas para evitar acidentes.',
                'category' => 'eletrica',
                'meta_keywords' => ['instalar ventilador teto', 'ventilador teto instalação', 'fixação ventilador', 'ventilador spirit'],
                'tags' => ['Ventilador', 'Teto', 'Instalação', 'Fixação'],
                'featured_image' => 'img/blog/instalar-ventilador-teto.jpg'
            ],
            [
                'title' => 'Lâmpada LED: Vantagens e Como Escolher',
                'excerpt' => 'Descubra as vantagens das lâmpadas LED e como escolher a ideal para cada ambiente. Economia de energia e maior durabilidade.',
                'category' => 'eletrica',
                'meta_keywords' => ['lâmpada LED', 'economia energia', 'iluminação LED', 'escolher lâmpada', 'lâmpada econômica'],
                'tags' => ['LED', 'Economia', 'Iluminação', 'Sustentabilidade'],
                'featured_image' => 'img/blog/lampada-led-vantagens.jpg'
            ],
            [
                'title' => 'Sobrecarga Elétrica: Como Evitar e Sinais de Alerta',
                'excerpt' => 'Identifique sinais de sobrecarga elétrica e aprenda como prevenir acidentes graves. Dicas de segurança para proteger sua casa.',
                'category' => 'eletrica',
                'meta_keywords' => ['sobrecarga elétrica', 'prevenção incêndio', 'segurança elétrica', 'disjuntor', 'curto circuito'],
                'tags' => ['Sobrecarga', 'Segurança', 'Prevenção', 'Incêndio'],
                'featured_image' => 'img/blog/sobrecarga-eletrica.jpg'
            ],
            [
                'title' => 'Alicate: Tipos e Técnicas de Uso Profissional',
                'excerpt' => 'Descubra os diferentes tipos de alicates e como usar cada um profissionalmente. Ferramentas essenciais para trabalhos elétricos.',
                'category' => 'ferramentas',
                'meta_keywords' => ['alicate', 'tipos alicate', 'uso alicate', 'ferramenta elétrica', 'alicate universal'],
                'tags' => ['Alicate', 'Tipos', 'Profissional', 'Elétrica'],
                'featured_image' => 'img/blog/alicate-tipos-uso.jpg'
            ],
            [
                'title' => 'Parafusadeira: Escolha e Manutenção',
                'excerpt' => 'Como escolher a parafusadeira ideal para suas necessidades e mantê-la em perfeito funcionamento. Dicas para prolongar a vida útil.',
                'category' => 'ferramentas',
                'meta_keywords' => ['parafusadeira', 'escolher parafusadeira', 'manutenção parafusadeira', 'ferramenta elétrica', 'furadeira parafusadeira'],
                'tags' => ['Parafusadeira', 'Escolha', 'Manutenção', 'Elétrica'],
                'featured_image' => 'img/blog/parafusadeira-escolha-manutencao.jpg'
            ],
            [
                'title' => 'Preparação da Parede para Pintura: Passo a Passo',
                'excerpt' => 'Como preparar adequadamente a parede antes da pintura para um resultado profissional. Massa corrida, lixa e primer corretos.',
                'category' => 'pintura',
                'meta_keywords' => ['preparação parede', 'preparo pintura', 'massa corrida', 'lixa parede', 'primer parede'],
                'tags' => ['Preparação', 'Parede', 'Massa Corrida', 'Lixa'],
                'featured_image' => 'img/blog/preparacao-parede-pintura.jpg'
            ]
        ];

        foreach ($posts as $postData) {
            Post::create([
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'excerpt' => $postData['excerpt'],
                'content' => $this->generateContent($postData['title']),
                'featured_image' => $postData['featured_image'],
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

    private function generateContent($title)
    {
        return "<h2>Introdução</h2>
<p>Este guia especializado sobre <strong>{$title}</strong> foi criado pelos profissionais da Shopp Reparos, baseado em anos de experiência e conhecimento técnico avançado.</p>

<h3>Importância do Tema</h3>
<p>Dominar esta técnica é fundamental para:</p>
<ul>
<li>Manter a segurança e funcionamento adequado da sua casa</li>
<li>Economizar significativamente em custos de manutenção</li>
<li>Desenvolver autonomia para pequenos reparos</li>
<li>Preservar o valor e a funcionalidade do seu imóvel</li>
</ul>

<h3>Ferramentas e Materiais Recomendados</h3>
<p>Para um trabalho profissional, você precisará de:</p>
<ul>
<li>Kit básico de ferramentas de qualidade</li>
<li>Materiais específicos conforme o fabricante</li>
<li>Equipamentos de proteção individual adequados</li>
<li>Instruções técnicas e manuais de referência</li>
</ul>

<h3>Procedimento Técnico Detalhado</h3>
<ol>
<li><strong>Análise Técnica:</strong> Faça uma avaliação completa do problema</li>
<li><strong>Planejamento:</strong> Organize materiais e prepare o ambiente de trabalho</li>
<li><strong>Implementação:</strong> Execute cada etapa seguindo normas técnicas</li>
<li><strong>Verificação:</strong> Teste rigorosamente o resultado obtido</li>
<li><strong>Finalização:</strong> Complete com limpeza e organização do local</li>
</ol>

<blockquote>
<strong>Atenção Especial:</strong> Este procedimento requer conhecimento técnico específico. Em caso de dúvida ou insegurança, sempre consulte um profissional qualificado da Shopp Reparos.
</blockquote>

<h3>Vantagens de Fazer Corretamente</h3>
<p>Seguindo este procedimento, você garante:</p>
<ul>
<li>Resultado duradouro e confiável</li>
<li>Economia substancial de recursos</li>
<li>Aprendizado valioso para situações futuras</li>
<li>Maior confiança em projetos domésticos</li>
</ul>

<h3>Programa de Manutenção Preventiva</h3>
<p>Para manter o resultado por mais tempo:</p>
<ul>
<li>Estabeleça rotina de verificação periódica</li>
<li>Use sempre peças e materiais originais</li>
<li>Mantenha documentação das intervenções</li>
<li>Fique atento a sinais de desgaste precoce</li>
</ul>

<h3>Situações que Exigem Assistência Profissional</h3>
<p>Busque ajuda especializada quando:</p>
<ul>
<li>O problema apresentar complexidade além do esperado</li>
<li>Houver envolvimento de sistemas críticos</li>
<li>Existir qualquer risco à segurança pessoal</li>
<li>For necessária certificação ou garantia técnica</li>
</ul>

<h3>Considerações Finais</h3>
<p>Este guia técnico fornece o conhecimento necessário para realizar este procedimento com segurança e eficiência. A Shopp Reparos mantém seu compromisso em oferecer as melhores soluções e materiais do mercado.</p>

<p><strong>Equipamentos e materiais de qualidade fazem toda a diferença!</strong> Visite nossas lojas especializadas em Águas Claras e Taguatinga, onde nossa equipe técnica está pronta para orientar você na escolha dos melhores produtos.</p>";
    }
}
