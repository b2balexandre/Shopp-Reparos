<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PostSeeder2 extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Como Instalar Chuveiro Elétrico com Segurança',
                'excerpt' => 'Instalação segura de chuveiro elétrico: requisitos elétricos, hidráulicos e normas de segurança. Tutorial completo com dicas profissionais.',
                'category' => 'reparos-hidraulicos',
                'meta_keywords' => ['instalar chuveiro elétrico', 'chuveiro elétrico segurança', 'instalação elétrica', 'banheiro', 'chuveiro 220v'],
                'tags' => ['Chuveiro Elétrico', 'Instalação', 'Segurança', 'Elétrica'],
                'featured_image' => 'img/blog/instalar-chuveiro-eletrico.jpg'
            ],
            [
                'title' => 'Tubulação PVC vs Cobre: Qual Escolher para sua Casa?',
                'excerpt' => 'Comparativo completo entre tubulação PVC e cobre: vantagens, desvantagens, custos, durabilidade e qual é melhor para cada situação.',
                'category' => 'reparos-hidraulicos',
                'meta_keywords' => ['tubulação PVC', 'tubulação cobre', 'encanamento casa', 'reforma hidráulica', 'tubos água'],
                'tags' => ['Tubulação', 'PVC', 'Cobre', 'Reforma'],
                'featured_image' => 'img/blog/tubulacao-pvc-cobre.jpg'
            ],
            [
                'title' => 'Vazamento no Vaso Sanitário: Como Identificar e Reparar',
                'excerpt' => 'Identifique diferentes tipos de vazamento no vaso sanitário e aprenda técnicas eficazes de reparo. Economize água e dinheiro.',
                'category' => 'reparos-hidraulicos',
                'meta_keywords' => ['vazamento vaso sanitário', 'vaso sanitário vazando', 'reparo banheiro', 'economia água', 'conserto vaso'],
                'tags' => ['Vaso Sanitário', 'Vazamento', 'Reparo', 'Banheiro'],
                'featured_image' => 'img/blog/vazamento-vaso-sanitario.jpg'
            ],
            [
                'title' => 'Tomada com Faísca: Perigos e Como Resolver',
                'excerpt' => 'Entenda os riscos de tomadas com faísca e aprenda como resolver este problema perigoso. Dicas de segurança elétrica essenciais.',
                'category' => 'eletrica',
                'meta_keywords' => ['tomada faísca', 'tomada fazendo faísca', 'perigo elétrico', 'segurança tomada', 'curto circuito'],
                'tags' => ['Tomada', 'Faísca', 'Segurança', 'Perigo'],
                'featured_image' => 'img/blog/tomada-faisca.jpg'
            ],
            [
                'title' => 'Quadro Elétrico: Organização e Manutenção',
                'excerpt' => 'Mantenha seu quadro elétrico organizado e seguro. Dicas de manutenção preventiva, identificação de disjuntores e normas de segurança.',
                'category' => 'eletrica',
                'meta_keywords' => ['quadro elétrico', 'disjuntores', 'manutenção elétrica', 'segurança elétrica', 'painel elétrico'],
                'tags' => ['Quadro Elétrico', 'Disjuntores', 'Manutenção', 'Organização'],
                'featured_image' => 'img/blog/quadro-eletrico-manutencao.jpg'
            ],
            [
                'title' => 'Falta de Energia em Casa: Diagnóstico e Soluções',
                'excerpt' => 'Aprenda a diagnosticar e resolver problemas de falta de energia elétrica em casa. Identifique causas comuns e soluções práticas.',
                'category' => 'eletrica',
                'meta_keywords' => ['falta energia casa', 'queda energia', 'disjuntor desarmado', 'problema elétrico', 'energia cortada'],
                'tags' => ['Energia', 'Disjuntor', 'Diagnóstico', 'Elétrica'],
                'featured_image' => 'img/blog/falta-energia-casa.jpg'
            ],
            [
                'title' => 'Furadeira: Como Escolher e Usar Corretamente',
                'excerpt' => 'Guia completo sobre furadeiras: tipos, como escolher a ideal para cada trabalho e técnicas de uso seguro e eficiente.',
                'category' => 'ferramentas',
                'meta_keywords' => ['furadeira', 'como escolher furadeira', 'tipos furadeira', 'uso furadeira', 'furadeira impacto'],
                'tags' => ['Furadeira', 'Escolha', 'Uso', 'Técnicas'],
                'featured_image' => 'img/blog/furadeira-como-escolher.jpg'
            ],
            [
                'title' => 'Chaves de Fenda e Phillips: Tipos e Aplicações',
                'excerpt' => 'Conheça os diferentes tipos de chaves de fenda e Phillips, suas aplicações específicas e como escolher a ferramenta certa.',
                'category' => 'ferramentas',
                'meta_keywords' => ['chave fenda', 'chave phillips', 'tipos chaves', 'ferramentas manuais', 'parafusos'],
                'tags' => ['Chave de Fenda', 'Phillips', 'Manual', 'Tipos'],
                'featured_image' => 'img/blog/chaves-fenda-phillips.jpg'
            ],
            [
                'title' => 'Tipos de Tinta: Qual Escolher para Cada Ambiente',
                'excerpt' => 'Guia completo sobre tipos de tinta e suas aplicações ideais para cada ambiente. Descubra qual tinta usar em cada cômodo da casa.',
                'category' => 'pintura',
                'meta_keywords' => ['tipos tinta', 'tinta ambiente', 'escolher tinta', 'tinta parede', 'tinta banheiro', 'tinta cozinha'],
                'tags' => ['Tinta', 'Tipos', 'Ambiente', 'Escolha'],
                'featured_image' => 'img/blog/tipos-tinta-ambiente.jpg'
            ],
            [
                'title' => 'Problemas de Umidade: Identificação e Soluções',
                'excerpt' => 'Como identificar diferentes tipos de umidade em casa e as melhores soluções para cada caso. Proteja sua casa contra mofo e infiltrações.',
                'category' => 'manutencao-geral',
                'meta_keywords' => ['umidade casa', 'mofo parede', 'infiltração', 'ventilação', 'umidade banheiro', 'desumidificador'],
                'tags' => ['Umidade', 'Mofo', 'Infiltração', 'Ventilação'],
                'featured_image' => 'img/blog/problemas-umidade-solucoes.jpg'
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

<h3>Benefícios de Resolver Corretamente</h3>
<p>Ao seguir este guia, você obterá:</p>
<ul>
<li>Economia significativa em chamadas técnicas</li>
<li>Conhecimento para futuras manutenções</li>
<li>Maior independência em reparos domésticos</li>
<li>Satisfação pessoal pelo trabalho bem feito</li>
</ul>

<h3>Manutenção Preventiva</h3>
<p>Para evitar que o problema se repita:</p>
<ul>
<li>Faça inspeções regulares a cada 6 meses</li>
<li>Substitua peças conforme recomendação</li>
<li>Use sempre produtos de qualidade</li>
<li>Mantenha um registro das manutenções realizadas</li>
</ul>

<h3>Quando Chamar um Profissional</h3>
<p>Procure ajuda especializada se:</p>
<ul>
<li>O problema persistir após seguir este guia</li>
<li>Você identificar questões mais complexas</li>
<li>Houver qualquer risco de segurança</li>
<li>For necessário conhecimento técnico especializado</li>
</ul>

<h3>Conclusão</h3>
<p>Com as informações deste guia detalhado, você está preparado para resolver este problema de forma segura e econômica. A Shopp Reparos está sempre disponível para fornecer os melhores materiais e orientação técnica especializada.</p>

<p><strong>Precisa de materiais ou tem dúvidas?</strong> Visite uma de nossas lojas em Águas Claras ou Taguatinga, ou entre em contato conosco. Nossa equipe de especialistas está pronta para ajudar!</p>";
    }
}
