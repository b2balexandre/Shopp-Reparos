<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    private function checkAdmin()
    {
        if (!Auth::check() || Auth::user()->perfil !== 'admin') {
            abort(403, 'Acesso não autorizado');
        }
    }

    public function index(Request $request)
    {
        $this->checkAdmin();
        
        $query = Post::query();

        // Filtros
        if ($request->has('busca') && $request->busca) {
            $query->where('title', 'LIKE', '%' . $request->busca . '%')
                  ->orWhere('content', 'LIKE', '%' . $request->busca . '%');
        }

        if ($request->has('categoria') && $request->categoria) {
            $query->where('category', $request->categoria);
        }

        if ($request->has('status')) {
            if ($request->status === 'publicado') {
                $query->where('published', true);
            } elseif ($request->status === 'rascunho') {
                $query->where('published', false);
            }
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(15);
        
        $categorias = Post::select('category')
                         ->distinct()
                         ->pluck('category')
                         ->sort();

        return view('admin.blog.index', compact('posts', 'categorias'));
    }

    public function create()
    {
        $this->checkAdmin();
        
        $categorias = [
            'reparos-hidraulicos' => 'Reparos Hidráulicos',
            'eletrica' => 'Elétrica',
            'ferramentas' => 'Ferramentas',
            'pintura' => 'Pintura',
            'manutencao-geral' => 'Manutenção Geral'
        ];

        return view('admin.blog.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string',
            'meta_keywords' => 'nullable|string',
            'tags' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'published' => 'boolean'
        ]);

        // Capturar apenas os campos esperados (evita lixo do $request->all())
        $data = $request->only(['title','excerpt','content','category']);

        $data['content'] = $this->normalizeContent($data['content']);
        
        // Processar slug
        $data['slug'] = Str::slug($data['title']);
        
        // Verificar se slug já existe
        $originalSlug = $data['slug'];
        $counter = 1;
        while (Post::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Processar meta dados
        $data['meta_title'] = $data['title'] . ' | Shopp Reparos';
        $data['meta_description'] = $data['excerpt'];
        
        if ($request->has('meta_keywords')) {
            $data['meta_keywords'] = $request->filled('meta_keywords')
                ? array_map('trim', explode(',', $request->meta_keywords))
                : null;
        }
        if ($request->has('tags')) {
            $data['tags'] = $request->filled('tags')
                ? array_map('trim', explode(',', $request->tags))
                : null;
        }

        // Upload da imagem padronizado no disco 'public' (storage/app/public/blog)
        if ($request->hasFile('featured_image')) {
            $imageFile = $request->file('featured_image');
            $imageName = 'post_' . time() . '_' . Str::random(10) . '.' . $imageFile->getClientOriginalExtension();

            try {
                Storage::disk('public')->makeDirectory('blog');
                $stored = $imageFile->storeAs('blog', $imageName, 'public');
                if ($stored) {
                    $this->copyToPublicStorage($stored);
                    $data['featured_image'] = 'blog/' . $imageName;
                } else {
                    throw new \RuntimeException('Falha ao salvar imagem no disco public');
                }
            } catch (\Throwable $e) {
                Log::error('Erro no upload de imagem do blog: ' . $e->getMessage());
                // Fallback para public/img/blog
                $destinationPath = public_path('img/blog');
                if (!file_exists($destinationPath)) mkdir($destinationPath, 0755, true);
                if ($imageFile->move($destinationPath, $imageName)) {
                    $data['featured_image'] = 'img/blog/' . $imageName;
                }
            }
        }

        // Definir autor
        $data['author_name'] = Auth::user()->name ?? 'Equipe Shopp Reparos';

        // Publicação: checkbox ou botão "Criar Post" (action=publish)
        $wantsPublish = $request->boolean('published') || $request->input('action') === 'publish';
        $data['published'] = $wantsPublish;
        if ($wantsPublish) {
            $data['published_at'] = now();
        }

        Post::create($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post criado com sucesso!');
    }

    public function show(Post $post)
    {
        $this->checkAdmin();
        return view('admin.blog.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->checkAdmin();
        
        $categorias = [
            'reparos-hidraulicos' => 'Reparos Hidráulicos',
            'eletrica' => 'Elétrica',
            'ferramentas' => 'Ferramentas',
            'pintura' => 'Pintura',
            'manutencao-geral' => 'Manutenção Geral'
        ];

        return view('admin.blog.edit', compact('post', 'categorias'));
    }

    public function update(Request $request, Post $post)
    {
        $this->checkAdmin();
        
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string',
            'meta_keywords' => 'nullable|string',
            'tags' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'published' => 'boolean'
        ]);

        // Capturar apenas os campos previstos
        $data = $request->only(['title','excerpt','content','category']);

        $data['content'] = $this->normalizeContent($data['content']);

        // Atualizar slug se título mudou
        if ($data['title'] !== $post->title) {
            $data['slug'] = Str::slug($data['title']);
            
            // Verificar se novo slug já existe
            $originalSlug = $data['slug'];
            $counter = 1;
            while (Post::where('slug', $data['slug'])->where('id', '!=', $post->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Processar meta dados
        $data['meta_title'] = $data['title'] . ' | Shopp Reparos';
        $data['meta_description'] = $data['excerpt'];
        
        if ($request->has('meta_keywords')) {
            $data['meta_keywords'] = $request->filled('meta_keywords')
                ? array_map('trim', explode(',', $request->meta_keywords))
                : null; // permitir limpar
        }
        if ($request->has('tags')) {
            $data['tags'] = $request->filled('tags')
                ? array_map('trim', explode(',', $request->tags))
                : null; // permitir limpar
        }

        // Upload da nova imagem padronizado no disco 'public'
        if ($request->hasFile('featured_image')) {
            // Deletar imagem antiga se existir
            if ($post->featured_image) {
                if (str_starts_with($post->featured_image, 'img/blog/')) {
                    if (file_exists(public_path($post->featured_image))) @unlink(public_path($post->featured_image));
                } elseif (str_starts_with($post->featured_image, 'blog/')) {
                    Storage::disk('public')->delete($post->featured_image);
                    $this->deletePublicCopy($post->featured_image);
                }
            }
            
            $imageFile = $request->file('featured_image');
            $imageName = 'post_' . time() . '_' . Str::random(10) . '.' . $imageFile->getClientOriginalExtension();
            
            try {
                Storage::disk('public')->makeDirectory('blog');
                $stored = $imageFile->storeAs('blog', $imageName, 'public');
                if ($stored) {
                    $this->copyToPublicStorage($stored);
                    $data['featured_image'] = 'blog/' . $imageName;
                } else {
                    throw new \RuntimeException('Falha ao salvar imagem no disco public');
                }
            } catch (\Throwable $e) {
                Log::error('Erro no upload de imagem do blog (update): ' . $e->getMessage());
                // Fallback: salvar diretamente na pasta public
                $destinationPath = public_path('img/blog');
                if (!file_exists($destinationPath)) mkdir($destinationPath, 0755, true);
                if ($imageFile->move($destinationPath, $imageName)) {
                    $data['featured_image'] = 'img/blog/' . $imageName;
                }
            }
        }

        // Publicação (checkbox). Só alterar se o campo vier no request
        if ($request->has('published')) {
            $newPublished = $request->boolean('published');
            $data['published'] = $newPublished;
            if ($newPublished && !$post->published) {
                $data['published_at'] = now();
            } elseif (!$newPublished && $post->published) {
                $data['published_at'] = null;
            }
        }

        $post->update($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post atualizado com sucesso!');
    }

    public function destroy(Post $post)
    {
        $this->checkAdmin();
        
        // Deletar imagem se existir (compatibilidade com sistema antigo e novo)
        if ($post->featured_image) {
            if (str_starts_with($post->featured_image, 'img/blog/')) {
                // Sistema antigo - deletar de public/img/blog
                if (file_exists(public_path($post->featured_image))) {
                    unlink(public_path($post->featured_image));
                }
            } else {
                // Sistema novo - deletar de storage e cópia pública
                Storage::disk('public')->delete($post->featured_image);
                $this->deletePublicCopy($post->featured_image);
            }
        }

        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post excluído com sucesso!');
    }

    public function togglePublished(Post $post)
    {
        $this->checkAdmin();
        
        $post->update([
            'published' => !$post->published,
            'published_at' => !$post->published ? now() : null
        ]);

        $status = $post->published ? 'publicado' : 'despublicado';
        
        return redirect()
            ->back()
            ->with('success', "Post {$status} com sucesso!");
    }

    public function inlineUpdate(Request $request, Post $post)
    {
        $this->checkAdmin();

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $updates = [];

        if (isset($data['title']) && $data['title'] !== $post->title) {
            $updates['title'] = $data['title'];
            $updates['meta_title'] = $data['title'] . ' | Shopp Reparos';
        }

        $metaDescriptionSource = null;

        if (array_key_exists('excerpt', $data)) {
            $excerptValue = isset($data['excerpt']) ? trim($data['excerpt']) : '';
            $updates['excerpt'] = $excerptValue !== '' ? $excerptValue : null;
            $metaDescriptionSource = $excerptValue !== '' ? $excerptValue : null;
        }

        if (isset($data['content'])) {
            $normalizedContent = $this->normalizeContent($data['content']);
            $updates['content'] = $normalizedContent;
            if ($metaDescriptionSource === null) {
                $metaDescriptionSource = $normalizedContent;
            }
        }

        if ($metaDescriptionSource !== null) {
            $updates['meta_description'] = Str::limit(strip_tags($metaDescriptionSource), 160);
        }

        if (!empty($updates)) {
            $post->update($updates);
        }

        $post->refresh();

        return response()->json([
            'success' => true,
            'message' => 'Post atualizado com sucesso!',
            'post' => [
                'title' => $post->title,
                'excerpt' => $post->excerpt,
                'content' => $post->content,
                'updated_at' => $post->updated_at->toDateTimeString(),
                'reading_time_text' => $post->reading_time_text,
                'reading_time' => $post->reading_time
            ]
        ]);
    }

    private function copyToPublicStorage(string $relativePath): void
    {
        if (is_link(public_path('storage'))) {
            return;
        }

        $source = storage_path('app/public/' . ltrim($relativePath, '/'));
        $target = public_path('storage/' . ltrim($relativePath, '/'));

        if (!file_exists($source)) {
            return;
        }

        $targetDir = dirname($target);
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        @copy($source, $target);
    }

    private function deletePublicCopy(string $relativePath): void
    {
        if (is_link(public_path('storage'))) {
            return;
        }

        $target = public_path('storage/' . ltrim($relativePath, '/'));
        if (file_exists($target)) {
            @unlink($target);
        }
    }

    private function normalizeContent(string $content): string
    {
        $trimmed = trim($content);

        if ($trimmed === '') {
            return '';
        }

        // Se já conter tags HTML, manter como está
        if (preg_match('/<\s*\/?\s*[a-zA-Z!]/', $trimmed)) {
            return $trimmed;
        }

        $normalized = preg_replace("/\r\n|\r/", "\n", $trimmed);
        $blocks = preg_split("/\n{2,}/", $normalized);

        $paragraphs = array_map(function ($block) {
            $block = trim($block);
            if ($block === '') {
                return null;
            }

            $lines = array_map(function ($line) {
                return htmlspecialchars($line, ENT_QUOTES, 'UTF-8');
            }, explode("\n", $block));

            return '<p>' . implode('<br>', $lines) . '</p>';
        }, $blocks);

        $paragraphs = array_filter($paragraphs);

        return implode("\n\n", $paragraphs);
    }
}