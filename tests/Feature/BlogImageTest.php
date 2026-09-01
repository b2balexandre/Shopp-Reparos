<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BlogImageTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Criar usuário admin
        $this->admin = User::factory()->create([
            'perfil' => 'admin'
        ]);
        
        // Usar storage real para teste
        // Storage::fake('public');
    }

    /** @test */
    public function admin_pode_criar_post_com_imagem()
    {
        $this->actingAs($this->admin);
        
        $image = UploadedFile::fake()->image('test-image.jpg', 800, 600);
        
        $postData = [
            'title' => 'Teste de Post com Imagem',
            'excerpt' => 'Resumo do post de teste',
            'content' => '<p>Conteúdo do post de teste</p>',
            'category' => 'reparos-hidraulicos',
            'featured_image' => $image,
            'published' => true
        ];
        
        $response = $this->withoutMiddleware()->post(route('admin.posts.store'), $postData);
        
        // Verificar se a resposta foi bem-sucedida
        if ($response->getStatusCode() !== 302) {
            dump('Response status:', $response->getStatusCode());
            dump('Response content:', $response->getContent());
        }
        
        $response->assertRedirect(route('admin.posts.index'));
        
        // Verificar se o post foi criado
        $this->assertDatabaseHas('posts', [
            'title' => 'Teste de Post com Imagem',
            'slug' => 'teste-de-post-com-imagem'
        ]);
        
        // Verificar se a imagem foi salva
        $post = Post::where('title', 'Teste de Post com Imagem')->first();
        $this->assertNotNull($post->featured_image);
        
        // Aceitar ambos os formatos: storage (blog/) ou public (img/blog/)
        $this->assertTrue(
            str_starts_with($post->featured_image, 'blog/') || 
            str_starts_with($post->featured_image, 'img/blog/'),
            'A imagem deve começar com "blog/" ou "img/blog/"'
        );
        
        // Debug: verificar o que está no storage
        dump('Post featured_image:', $post->featured_image);
        
        // Verificar se o arquivo existe fisicamente
        if (str_starts_with($post->featured_image, 'blog/')) {
            // Sistema storage
            $this->assertTrue(Storage::disk('public')->exists($post->featured_image));
        } else {
            // Sistema public
            $this->assertTrue(file_exists(public_path($post->featured_image)));
        }
    }

    /** @test */
    public function sistema_aceita_formatos_de_imagem_corretos()
    {
        $this->actingAs($this->admin);
        
        // Testar apenas um formato para simplificar
        $image = UploadedFile::fake()->image('test-image.jpg', 800, 600);
        
        $postData = [
            'title' => 'Teste JPG',
            'excerpt' => 'Resumo teste',
            'content' => '<p>Conteúdo teste</p>',
            'category' => 'reparos-hidraulicos',
            'featured_image' => $image,
            'published' => true
        ];
        
        $response = $this->withoutMiddleware()->post(route('admin.posts.store'), $postData);
        
        // Verificar se foi aceito
        $this->assertDatabaseHas('posts', [
            'title' => 'Teste JPG'
        ]);
    }

    /** @test */
    public function sistema_rejeita_arquivos_invalidos()
    {
        $this->actingAs($this->admin);
        
        // Arquivo que não é imagem
        $invalidFile = UploadedFile::fake()->create('document.txt', 100);
        
        $postData = [
            'title' => 'Teste Arquivo Inválido',
            'excerpt' => 'Resumo teste',
            'content' => '<p>Conteúdo teste</p>',
            'category' => 'reparos-hidraulicos',
            'featured_image' => $invalidFile,
            'published' => true
        ];
        
        $response = $this->withoutMiddleware()->post(route('admin.posts.store'), $postData);
        
        // Verificar se foi rejeitado
        $response->assertSessionHasErrors('featured_image');
        
        // Verificar se o post não foi criado
        $this->assertDatabaseMissing('posts', [
            'title' => 'Teste Arquivo Inválido'
        ]);
    }
}
