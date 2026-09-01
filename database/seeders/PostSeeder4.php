<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PostSeeder4 extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Como Instalar Torneira de Parede: Passo a Passo',
                'excerpt' => 'Tutorial completo para instalação de torneira de parede. Ferramentas necessárias, técnicas profissionais e cuidados importantes.',
                'category' => 'reparos-hidraulicos',
                'meta_keywords' => ['instalar torneira parede', 'torneira parede instalação', 'hidráulica torneira', 'torneira bica móvel'],
                'tags' => ['Torneira', 'Instalação', 'Parede', 'Hidráulica'],
                'featured_image' => 'blog/instalar-torneira-parede.jpg'
            ],
            [
                'title' => 'Bomba d\'Água: Escolha, Instalação e Manutenção',
                'excerpt' => 'Guia completo sobre bombas d\'água: tipos, como escolher, instalação correta, manutenção e resolução de problemas comuns.',
                'category' => 'reparos-hidraulicos',
                'meta_keywords' => ['bomba água', 'bomba pressurizadora', 'instalação bomba', 'manutenção bomba', 'bomba centrífuga'],
                'tags' => ['Bomba d\'Água', 'Pressurização', 'Instalação', 'Manutenção'],
                'featured_image' => 'blog/bomba-agua-guia.jpg'
            ],
            [
                'title' => 'Infiltração em Parede: Causas e Como Resolver',
                'excerpt' => 'Identifique e resolva problemas de infiltração em paredes. Proteja sua casa contra umidade, mofo e danos estruturais.',
                'category' => 'reparos-hidraulicos',
                'meta_keywords' => ['infiltração parede', 'umidade parede', 'vazamento parede', 'impermeabilização', 'mofo parede'],
                'tags' => ['Infiltração', 'Umidade', 'Parede', 'Impermeabilização'],
                'featured_image' => 'blog/infiltracao-parede.jpg'
            ],
            [
                'title' => 'Extensão Elétrica Segura: Uso Correto e Cuidados',
                'excerpt' => 'Saiba usar extensões elétricas com segurança e evite acidentes domésticos. Dicas importantes para uso seguro e duradouro.',
                'category' => 'eletrica',
                'meta_keywords' => ['extensão elétrica', 'uso seguro extensão', 'segurança elétrica doméstica', 'benjamim elétrico'],
                'tags' => ['Extensão', 'Segurança', 'Uso Correto', 'Prevenção'],
                'featured_image' => 'blog/extensao-eletrica-segura.jpg'
            ],
            [
                'title' => 'DR (Dispositivo Residual): Importância e Funcionamento',
                'excerpt' => 'Entenda a importância do DR na proteção elétrica residencial e como ele funciona para proteger sua família contra choques.',
                'category' => 'eletrica',
                'meta_keywords' => ['DR elétrico', 'dispositivo residual', 'proteção elétrica', 'segurança', 'disjuntor DR'],
                'tags' => ['DR', 'Proteção', 'Segurança', 'Dispositivo'],
                'featured_image' => 'blog/dr-dispositivo-residual.jpg'
            ],
            [
                'title' => 'Como Instalar Tomada Nova: Passo a Passo Seguro',
                'excerpt' => 'Tutorial para instalação de tomada nova com todos os cuidados de segurança necessários. Siga normas técnicas e NBR.',
                'category' => 'eletrica',
                'meta_keywords' => ['instalar tomada', 'tomada nova instalação', 'elétrica residencial', 'tomada 3 pinos'],
                'tags' => ['Tomada', 'Instalação', 'Elétrica', 'Residencial'],
                'featured_image' => 'blog/instalar-tomada-nova.jpg'
            ],
            [
                'title' => 'Martelo: Tipos e Técnicas de Uso Correto',
                'excerpt' => 'Conheça os diferentes tipos de martelo e aprenda técnicas de uso seguro e eficiente para cada situação de trabalho.',
                'category' => 'ferramentas',
                'meta_keywords' => ['martelo', 'tipos martelo', 'uso martelo', 'ferramenta manual', 'martelo unha'],
                'tags' => ['Martelo', 'Tipos', 'Técnicas', 'Manual'],
                'featured_image' => 'blog/martelo-tipos-tecnicas.jpg'
            ],
            [
                'title' => 'Trena e Nível: Medição Precisa em Obras',
                'excerpt' => 'Importância da medição precisa em trabalhos de construção e reforma. Como usar trena e nível corretamente.',
                'category' => 'ferramentas',
                'meta_keywords' => ['trena', 'nível', 'medição', 'precisão obra', 'nível bolha', 'trena laser'],
                'tags' => ['Trena', 'Nível', 'Medição', 'Precisão'],
                'featured_image' => 'blog/trena-nivel-medicao.jpg'
            ],
            [
                'title' => 'Pincel vs Rolo: Quando Usar Cada Ferramenta',
                'excerpt' => 'Descubra quando usar pincel ou rolo para obter o melhor resultado na pintura. Técnicas para acabamento profissional.',
                'category' => 'pintura',
                'meta_keywords' => ['pincel ou rolo', 'ferramenta pintura', 'acabamento pintura', 'rolo lã', 'pincel cerdas'],
                'tags' => ['Pincel', 'Rolo', 'Ferramentas', 'Acabamento'],
                'featured_image' => 'blog/pincel-vs-rolo.jpg',
            ],
            [
                'title' => 'Segurança Doméstica: Checklist Essencial',
                'excerpt' => 'Checklist completo de segurança doméstica para proteger sua família e patrimônio. Prevenção de acidentes e emergências.',
                'category' => 'manutencao-geral',
                'meta_keywords' => ['segurança doméstica', 'checklist segurança', 'proteção casa', 'prevenção acidentes', 'segurança família'],
                'tags' => ['Segurança', 'Checklist', 'Prevenção', 'Proteção'],
                'featured_image' => 'img/blog/seguranca-domestica-checklist.jpg'
            ]
        ];

        foreach ($posts as $postData) {
            Post::create([
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'excerpt' => $postData['excerpt'],
                'content' => $this->generateAdvancedContent($postData['title'], $postData['category']),
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

    private function generateAdvancedContent($title, $category)
    {
        $categoryContent = [
            'reparos-hidraulicos' => 'sistemas hidráulicos',
            'eletrica' => 'instalações elétricas',
            'ferramentas' => 'ferramentas e equipamentos',
            'pintura' => 'técnicas de pintura',
            'manutencao-geral' => 'manutenção residencial'
        ];

        $categoryName = $categoryContent[$category] ?? 'reparos domésticos';

        return "<h2>Visão Geral do Problema</h2>
<p>Este artigo técnico sobre <strong>{$title}</strong> faz parte da série especializada da Shopp Reparos em <strong>{$categoryName}</strong>, desenvolvida para capacitar proprietários na resolução eficiente de problemas domésticos.</p>

<h3>Por Que Este Conhecimento é Valioso?</h3>
<p>Dominar esta técnica proporciona benefícios significativos:</p>
<ul>
<li>Redução drástica de custos com serviços técnicos</li>
<li>Maior rapidez na resolução de emergências</li>
<li>Desenvolvimento de competências práticas valiosas</li>
<li>Aumento da valorização e conservação do imóvel</li>
<li>Independência para manutenções básicas</li>
</ul>

<h3>Equipamentos e Insumos Necessários</h3>
<p>Para garantir um resultado profissional, providencie:</p>
<ul>
<li>Kit completo de ferramentas especializadas</li>
<li>Materiais e componentes de primeira qualidade</li>
<li>Equipamentos de proteção individual certificados</li>
<li>Documentação técnica e normas aplicáveis</li>
<li>Ambiente adequado e bem iluminado para o trabalho</li>
</ul>

<h3>Metodologia Técnica Passo a Passo</h3>
<ol>
<li><strong>Diagnóstico Técnico:</strong> Realize uma análise minuciosa da situação atual</li>
<li><strong>Planejamento Estratégico:</strong> Desenvolva um plano detalhado de execução</li>
<li><strong>Preparação do Ambiente:</strong> Organize o espaço e reúna todos os recursos</li>
<li><strong>Execução Controlada:</strong> Implemente cada etapa seguindo padrões técnicos</li>
<li><strong>Testes de Qualidade:</strong> Verifique rigorosamente cada aspecto do trabalho</li>
<li><strong>Documentação:</strong> Registre o procedimento para referências futuras</li>
</ol>

<blockquote>
<strong>Aviso Importante:</strong> Este procedimento envolve conhecimentos técnicos específicos de {$categoryName}. A Shopp Reparos recomenda que, em caso de qualquer incerteza, você busque orientação de nossos profissionais especializados.
</blockquote>

<h3>Benefícios de uma Execução Correta</h3>
<p>Ao seguir este protocolo técnico, você obterá:</p>
<ul>
<li>Resultado com padrão de qualidade profissional</li>
<li>Durabilidade estendida da solução implementada</li>
<li>Economia significativa em custos operacionais</li>
<li>Conhecimento replicável para situações similares</li>
<li>Maior confiança para projetos futuros</li>
</ul>

<h3>Protocolo de Manutenção Preventiva</h3>
<p>Para maximizar a longevidade do resultado:</p>
<ul>
<li>Institua um cronograma de inspeções regulares</li>
<li>Utilize exclusivamente componentes originais ou equivalentes</li>
<li>Mantenha registro detalhado de todas as intervenções</li>
<li>Monitore indicadores de performance e desgaste</li>
<li>Atualize procedimentos conforme novas tecnologias</li>
</ul>

<h3>Indicações para Assistência Técnica Especializada</h3>
<p>Recomendamos buscar suporte profissional quando:</p>
<ul>
<li>A complexidade exceder o nível de conhecimento disponível</li>
<li>Houver envolvimento de sistemas críticos de segurança</li>
<li>Existirem riscos potenciais à integridade física</li>
<li>For necessária certificação ou garantia técnica formal</li>
<li>Os resultados não atenderem aos padrões esperados</li>
</ul>

<h3>Considerações Técnicas Finais</h3>
<p>Este guia técnico representa o compromisso da Shopp Reparos em democratizar o conhecimento especializado em {$categoryName}, sempre priorizando a segurança e a qualidade dos resultados.</p>

<p><strong>A qualidade dos materiais é fundamental para o sucesso!</strong> Visite nossas unidades especializadas em Águas Claras e Taguatinga, onde você encontrará produtos certificados e orientação técnica personalizada de nossa equipe de especialistas.</p>

<p><em>Shopp Reparos - Sua parceira em soluções técnicas residenciais desde 1995.</em></p>";
    }
}
