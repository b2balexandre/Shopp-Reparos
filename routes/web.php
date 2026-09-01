<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Servico;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

// Página inicial pública - SEU SITE
Route::get('/', function () {
    $servicos = Servico::where('ativo', true)->take(6)->get(); // Limita a 6 serviços
    $todasMarcas = Servico::distinct()->pluck('marca');
    $produtos = Produto::with('categoria')->take(6)->get(); // Limita a 6 produtos
    $todasCategorias = Categoria::distinct()->pluck('nome');
    $banners = App\Models\Banner::getActiveAll(); // Buscar banners ativos
    return view('site', compact('servicos', 'todasMarcas', 'produtos', 'todasCategorias', 'banners'));
})->name('home');

// Páginas institucionais públicas
Route::view('/assistencia-tecnica', 'site.assistencia-tecnica');
Route::view('/lojas', 'site.lojas');
Route::view('/reparos-hidraulicos', 'site.reparos-hidraulicos');
Route::view('/contato', 'site.contato');

// Listagem de serviços e produtos
Route::get('/site/servicos', function() {
    $servicos = App\Models\Servico::where('ativo', true)->paginate(12);
    return view('site.servicos.index', compact('servicos'));
});
Route::get('/site/produtos', function() {
    $produtos = App\Models\Produto::with('categoria')->paginate(12);
    return view('site.produtos.index', compact('produtos'));
});

// Detalhes de serviço (com slug)
Route::get('/site/servicos/{id}-{slug}', function($id, $slug) {
    $servico = App\Models\Servico::findOrFail($id);
    return view('site.servicos.show', compact('servico'));
});

// Rota de compatibilidade - redireciona para URL com slug
Route::get('/site/servicos/{id}', function($id) {
    $servico = App\Models\Servico::findOrFail($id);
    $slug = $servico->slug ?: \Illuminate\Support\Str::slug($servico->titulo);
    return redirect("/site/servicos/{$id}-{$slug}", 301);
})->where('id', '[0-9]+');

// Detalhes de produto (com slug)
Route::get('/site/produtos/{id}-{slug}', function($id, $slug) {
    $produto = App\Models\Produto::findOrFail($id);
    return view('site.produtos.show', compact('produto'));
});

// Rota de compatibilidade - redireciona para URL com slug
Route::get('/site/produtos/{id}', function($id) {
    $produto = App\Models\Produto::findOrFail($id);
    $slug = $produto->slug ?: \Illuminate\Support\Str::slug($produto->nome);
    return redirect("/site/produtos/{$id}-{$slug}", 301);
})->where('id', '[0-9]+');

// Dashboard - redireciona admin para painel administrativo
Route::get('/dashboard', function () {
    if (Auth::user()->perfil === 'admin') {
        return redirect('/admin');
    }
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Demais rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Painel Admin (apenas para admin)
    Route::get('/admin', function () {
        if (!Auth::check() || Auth::user()->perfil !== 'admin') {
            abort(403, 'Acesso não autorizado');
        }
        return view('admin.index');
    })->name('admin.dashboard');

    // Rotas administrativas com prefixo /admin
    Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
        // Blog
    Route::resource('posts', App\Http\Controllers\Admin\PostController::class);
    Route::patch('posts/{post}/inline', [App\Http\Controllers\Admin\PostController::class, 'inlineUpdate'])->name('posts.inline-update');
        Route::patch('posts/{post}/toggle-published', [App\Http\Controllers\Admin\PostController::class, 'togglePublished'])->name('posts.toggle-published');
        
        // Produtos
        Route::resource('produtos', App\Http\Controllers\ProdutoController::class);
        Route::post('produtos/{produto}/duplicate', [App\Http\Controllers\ProdutoController::class, 'duplicate'])->name('produtos.duplicate');
        
        // Ordem de Serviços
        Route::resource('ordem_servicos', App\Http\Controllers\OrdemServicoController::class);
        Route::patch('ordem_servicos/{ordem_servico}/status', [App\Http\Controllers\OrdemServicoController::class, 'updateStatus'])->name('ordem_servicos.status');
        Route::post('ordem_servicos/{ordem_servico}/comentar', [App\Http\Controllers\OrdemServicoController::class, 'comentar'])->name('ordem_servicos.comentar');
        Route::post('ordem_servicos/{ordem_servico}/foto', [App\Http\Controllers\OrdemServicoController::class, 'adicionarFoto'])->name('ordem_servicos.foto');
        Route::post('ordem_servicos/{ordem_servico}/avaliar', [App\Http\Controllers\OrdemServicoController::class, 'avaliar'])->name('ordem_servicos.avaliar');
        // Usuários
        Route::resource('usuarios', App\Http\Controllers\Admin\UsuarioController::class);
        Route::patch('usuarios/{user}/nivel', [App\Http\Controllers\Admin\UsuarioController::class, 'atualizarNivel'])->name('usuarios.nivel');
        // Categorias
        Route::resource('categorias', App\Http\Controllers\CategoriaController::class);
        // Responsáveis
        Route::resource('responsaveis', App\Http\Controllers\ResponsavelController::class);
        // Serviços (CRUD completo)
        Route::resource('servicos', App\Http\Controllers\ServicoController::class);
        Route::post('servicos/{servico}/duplicate', [App\Http\Controllers\ServicoController::class, 'duplicate'])->name('servicos.duplicate');

        // Banners
        Route::get('banners', [App\Http\Controllers\BannerController::class, 'index'])->name('banners.index');
        Route::post('banners', [App\Http\Controllers\BannerController::class, 'store'])->name('banners.store');
        Route::put('banners/{banner}', [App\Http\Controllers\BannerController::class, 'update'])->name('banners.update');
        Route::delete('banners/{banner}', [App\Http\Controllers\BannerController::class, 'destroy'])->name('banners.destroy');
        Route::get('banners/gallery', [App\Http\Controllers\BannerController::class, 'gallery'])->name('banners.gallery');
        Route::post('banners/{id}/restore', [App\Http\Controllers\BannerController::class, 'restore'])->name('banners.restore');
    });
});

require __DIR__.'/auth.php';

// Blog routes
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/categoria/{categoria}', [App\Http\Controllers\BlogController::class, 'categoria'])->name('blog.categoria');
Route::get('/blog/{post:slug}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
Route::get('/blog-sitemap.xml', [App\Http\Controllers\BlogController::class, 'sitemap'])->name('blog.sitemap');
Route::get('/blog/feed.xml', [App\Http\Controllers\BlogController::class, 'feed'])->name('blog.feed');

// Rota para posts (compatibilidade com navegação)
Route::get('/posts', [App\Http\Controllers\BlogController::class, 'index'])->name('posts.index');

// Rota de teste para verificar banners
Route::get('/test-banners', function () {
    $banners = App\Models\Banner::all();
    $dados = [];
    
    foreach($banners as $banner) {
        $dados[] = [
            'ID' => $banner->id,
            'Titulo' => $banner->titulo ?? 'NULL',
            'Ordem' => $banner->ordem ?? 'NULL', 
            'Ativo' => $banner->is_active ? 'Sim' : 'Não',
            'Desktop' => $banner->desktop_image ?? 'NULL',
            'Mobile' => $banner->mobile_image ?? 'NULL',
            'Desktop_Path_Storage' => $banner->desktop_image ? (file_exists(public_path('storage/banners/desktop/' . $banner->desktop_image)) ? 'EXISTS' : 'NOT FOUND') : 'NULL',
            'Desktop_Path_Hero' => $banner->desktop_image ? (file_exists(public_path('img/bannershero/' . $banner->desktop_image)) ? 'EXISTS' : 'NOT FOUND') : 'NULL',
            'Created' => $banner->created_at
        ];
    }
    
    return response()->json($dados, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
});

// Rota para corrigir banners sem imagens
Route::get('/fix-banners', function () {
    if (!auth()->check() || auth()->user()->perfil !== 'admin') {
        abort(403, 'Acesso não autorizado');
    }
    
    $bannersCorrigidos = 0;
    $banners = App\Models\Banner::all();
    
    foreach ($banners as $banner) {
        $corrigido = false;
        
        // Se não tem imagem no storage mas tem referência, tenta encontrar na pasta img/bannershero
        if ($banner->desktop_image && !file_exists(public_path('storage/banners/desktop/' . $banner->desktop_image))) {
            if (file_exists(public_path('img/bannershero/' . $banner->desktop_image))) {
                // Imagem existe na pasta original, mantém a referência
                $corrigido = true;
            } else {
                // Se não existe em lugar nenhum, limpa a referência
                $banner->desktop_image = null;
                $corrigido = true;
            }
        }
        
        if ($banner->mobile_image && !file_exists(public_path('storage/banners/mobile/' . $banner->mobile_image))) {
            if (file_exists(public_path('img/bannershero/' . $banner->mobile_image))) {
                // Imagem existe na pasta original, mantém a referência
                $corrigido = true;
            } else {
                // Se não existe em lugar nenhum, limpa a referência
                $banner->mobile_image = null;
                $corrigido = true;
            }
        }
        
        if ($corrigido) {
            $banner->save();
            $bannersCorrigidos++;
        }
    }
    
    return response()->json([
        'message' => 'Banners corrigidos!',
        'banners_processados' => $bannersCorrigidos,
        'redirect' => '/banners'
    ]);
});
