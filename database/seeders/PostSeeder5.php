<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PostSeeder5 extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Fios Elétricos: Tipos, Bitolas e Aplicações',
                'excerpt' => 'Guia completo sobre fios elétricos: tipos, bitolas corretas para cada aplicação e normas de segurança. Escolha o fio ideal para sua instalação.',
                'category' => 'eletrica',
                'meta_keywords' => ['fios elétricos', 'bitolas fios', 'tipos fios', 'instalação elétrica', 'fios casa', 'fios 2.5mm'],
                'tags' => ['Fios Elétricos', 'Bitolas', 'Instalação', 'Segurança'],
                'featured_image' => 'blog/1755292083_fios-eletricos-tipos-bitolas-e-aplicacoes.webp'
            ],
            [
                'title' => 'Choque Elétrico: Primeiros Socorros e Prevenção',
                'excerpt' => 'Aprenda os primeiros socorros para choque elétrico e medidas preventivas essenciais. Proteja sua família contra acidentes elétricos.',
                'category' => 'eletrica',
                'meta_keywords' => ['choque elétrico', 'primeiros socorros', 'prevenção choque', 'acidente elétrico', 'segurança elétrica'],
                'tags' => ['Choque Elétrico', 'Primeiros Socorros', 'Prevenção', 'Segurança'],
                'featured_image' => 'blog/1755293335_choque-eletrico-primeiros-socorros-e-prevencao.jpg'
            ],
            [
                'title' => 'Aterramento Elétrico: Importância e Como Fazer',
                'excerpt' => 'Entenda a importância do aterramento elétrico para segurança e como implementar corretamente em sua residência.',
                'category' => 'eletrica',
                'meta_keywords' => ['aterramento elétrico', 'haste aterramento', 'segurança elétrica', 'proteção', 'fio terra'],
                'tags' => ['Aterramento', 'Proteção', 'Segurança', 'Instalação'],
                'featured_image' => 'blog/aterramento-eletrico.jpg'
            ],
            [
                'title' => 'Timer Elétrico: Instalação e Programação',
                'excerpt' => 'Aprenda a instalar e programar timer elétrico para automação residencial. Economize energia com programação inteligente.',
                'category' => 'eletrica',
                'meta_keywords' => ['timer elétrico', 'automação residencial', 'programação timer', 'economia energia', 'timer digital'],
                'tags' => ['Timer', 'Automação', 'Programação', 'Economia'],
                'featured_image' => 'blog/timer-eletrico.jpg'
            ],
            [
                'title' => 'Serra: Tipos e Aplicações para Cada Material',
                'excerpt' => 'Guia completo sobre serras: tipos, aplicações específicas e como escolher a serra ideal para cada material e projeto.',
                'category' => 'ferramentas',
                'meta_keywords' => ['serra', 'tipos serra', 'serra madeira', 'serra metal', 'serra circular', 'serra tico-tico'],
                'tags' => ['Serra', 'Tipos', 'Aplicações', 'Materiais'],
                'featured_image' => 'blog/serra-tipos-aplicacoes.jpg'
            ],
            [
                'title' => 'Morsa e Bancada: Organização da Oficina',
                'excerpt' => 'Como montar uma bancada eficiente com morsa para trabalhos de precisão. Organização ideal da oficina doméstica.',
                'category' => 'ferramentas',
                'meta_keywords' => ['morsa', 'bancada', 'oficina', 'organização ferramentas', 'bancada trabalho'],
                'tags' => ['Morsa', 'Bancada', 'Oficina', 'Organização'],
                'featured_image' => 'blog/morsa-bancada-oficina.jpg'
            ],
            [
                'title' => 'Manutenção de Ferramentas: Prolongue a Vida Útil',
                'excerpt' => 'Dicas essenciais para manutenção e conservação de ferramentas, aumentando sua durabilidade e performance.',
                'category' => 'ferramentas',
                'meta_keywords' => ['manutenção ferramentas', 'conservação ferramentas', 'cuidado ferramentas', 'limpeza ferramentas'],
                'tags' => ['Manutenção', 'Conservação', 'Durabilidade', 'Cuidados'],
                'featured_image' => 'blog/manutencao-ferramentas.jpg'
            ],
            [
                'title' => 'Cores na Decoração: Psicologia e Combinações',
                'excerpt' => 'Como as cores influenciam o ambiente e o bem-estar. Dicas para combinações harmoniosas e impacto psicológico das cores.',
                'category' => 'pintura',
                'meta_keywords' => ['cores decoração', 'psicologia cores', 'combinação cores', 'decoração ambiente', 'harmonia cores'],
                'tags' => ['Cores', 'Psicologia', 'Decoração', 'Harmonia'],
                'featured_image' => 'blog/cores-decoracao-psicologia.jpg'
            ],
            [
                'title' => 'Economia de Energia em Casa: 20 Dicas Práticas',
                'excerpt' => '20 dicas práticas e eficazes para reduzir o consumo de energia em casa e economizar na conta de luz.',
                'category' => 'manutencao-geral',
                'meta_keywords' => ['economia energia', 'reduzir conta luz', 'dicas economia', 'sustentabilidade', 'consumo energia'],
                'tags' => ['Economia', 'Energia', 'Sustentabilidade', 'Dicas'],
                'featured_image' => 'blog/economia-energia-dicas.jpg'
            ],
            [
                'title' => 'Organização de Ferramentas: Dicas de Armazenamento',
                'excerpt' => 'Como organizar e armazenar ferramentas de forma eficiente e segura. Maximize o espaço e facilite o acesso.',
                'category' => 'manutencao-geral',
                'meta_keywords' => ['organização ferramentas', 'armazenamento ferramentas', 'oficina organizada', 'caixa ferramentas'],
                'tags' => ['Organização', 'Armazenamento', 'Ferramentas', 'Oficina'],
                'featured_image' => 'blog/organizacao-ferramentas-armazenamento.jpg'
            ]
        ];

        foreach ($posts as $postData) {
            Post::create([
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'excerpt' => $postData['excerpt'],
                'content' => $this->generateExpertContent($postData['title'], $postData['category']),
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

    private function generateExpertContent($title, $category)
    {
        $expertiseAreas = [
            'reparos-hidraulicos' => ['sistemas hidráulicos avançados', 'encanamento residencial', 'soluções em água e esgoto'],
            'eletrica' => ['instalações elétricas certificadas', 'segurança elétrica residencial', 'automação predial'],
            'ferramentas' => ['equipamentos profissionais', 'ferramentas especializadas', 'tecnologia em ferramentas'],
            'pintura' => ['técnicas de pintura profissional', 'acabamentos decorativos', 'revestimentos especiais'],
            'manutencao-geral' => ['manutenção preventiva', 'conservação predial', 'eficiência residencial']
        ];

        $areas = $expertiseAreas[$category] ?? ['reparos gerais', 'manutenção básica', 'soluções práticas'];
        $mainArea = $areas[0];

        return "<h2>Expertise Técnica Especializada</h2>
<p>Este artigo sobre <strong>{$title}</strong> representa o conhecimento acumulado da Shopp Reparos em <strong>{$mainArea}</strong>, baseado em mais de 25 anos de experiência no mercado de materiais de construção e reparos.</p>

<h3>Importância Estratégica do Conhecimento</h3>
<p>O domínio desta técnica oferece vantagens competitivas importantes:</p>
<ul>
<li>Eliminação da dependência de serviços técnicos externos</li>
<li>Capacidade de resposta rápida em situações críticas</li>
<li>Desenvolvimento de expertise técnica pessoal valiosa</li>
<li>Otimização de custos operacionais de manutenção</li>
<li>Maior controle sobre a qualidade dos resultados</li>
<li>Possibilidade de orientar outros em situações similares</li>
</ul>

<h3>Especificações Técnicas e Materiais</h3>
<p>Para atingir padrões profissionais de qualidade, é essencial:</p>
<ul>
<li>Conjunto completo de ferramentas certificadas e calibradas</li>
<li>Materiais premium conforme especificações técnicas</li>
<li>Equipamentos de proteção individual homologados</li>
<li>Documentação técnica atualizada e normas vigentes</li>
<li>Ambiente de trabalho adequadamente preparado</li>
<li>Instrumentos de medição e verificação precisos</li>
</ul>

<h3>Protocolo de Execução Profissional</h3>
<ol>
<li><strong>Avaliação Técnica Preliminar:</strong> Análise detalhada das condições existentes</li>
<li><strong>Projeto de Intervenção:</strong> Elaboração de plano técnico estruturado</li>
<li><strong>Preparação Logística:</strong> Organização de recursos e cronograma</li>
<li><strong>Implementação Controlada:</strong> Execução seguindo protocolos técnicos</li>
<li><strong>Controle de Qualidade:</strong> Verificação sistemática de cada etapa</li>
<li><strong>Testes de Performance:</strong> Validação dos resultados obtidos</li>
<li><strong>Documentação Final:</strong> Registro completo do procedimento</li>
</ol>

<blockquote>
<strong>Recomendação Técnica:</strong> Este procedimento requer conhecimento especializado em {$mainArea}. A Shopp Reparos mantém equipe técnica qualificada disponível para consultoria e suporte especializado quando necessário.
</blockquote>

<h3>Vantagens da Execução Profissional</h3>
<p>A aplicação correta desta metodologia garante:</p>
<ul>
<li>Resultados com durabilidade estendida e confiabilidade</li>
<li>Otimização significativa de recursos financeiros</li>
<li>Desenvolvimento de competências técnicas transferíveis</li>
<li>Elevação do padrão de qualidade dos trabalhos</li>
<li>Maior segurança operacional durante a execução</li>
<li>Conformidade com normas técnicas e regulamentações</li>
</ul>

<h3>Sistema de Manutenção Preventiva Integrada</h3>
<p>Para garantir performance sustentada ao longo do tempo:</p>
<ul>
<li>Estabelecimento de cronograma de inspeções programadas</li>
<li>Utilização exclusiva de componentes certificados</li>
<li>Manutenção de histórico técnico detalhado</li>
<li>Monitoramento contínuo de indicadores de performance</li>
<li>Atualizações tecnológicas conforme evolução do mercado</li>
<li>Treinamento contínuo em novas metodologias</li>
</ul>

<h3>Critérios para Suporte Técnico Especializado</h3>
<p>Recomendamos assistência profissional da Shopp Reparos quando:</p>
<ul>
<li>A complexidade técnica exceder o nível de expertise disponível</li>
<li>Houver envolvimento de sistemas críticos ou de alta responsabilidade</li>
<li>Existirem riscos potenciais à segurança ou integridade estrutural</li>
<li>For necessária certificação técnica ou garantia formal</li>
<li>Os padrões de qualidade não forem atingidos conforme especificado</li>
<li>Houver necessidade de conformidade com normas específicas</li>
</ul>

<h3>Compromisso com a Excelência Técnica</h3>
<p>Este conteúdo técnico especializado reflete o compromisso contínuo da Shopp Reparos em transferir conhecimento de alta qualidade para nossos clientes, sempre priorizando segurança, eficiência e resultados duradouros em {$mainArea}.</p>

<p><strong>Materiais de primeira linha fazem toda a diferença no resultado final!</strong> Nossas lojas especializadas em Águas Claras e Taguatinga oferecem produtos premium e orientação técnica personalizada, com equipe de especialistas certificados prontos para suportar seus projetos mais desafiadores.</p>

<p><em>Shopp Reparos - Referência em soluções técnicas e materiais especializados desde 1995. Sua parceira em excelência e inovação.</em></p>";
    }
}
