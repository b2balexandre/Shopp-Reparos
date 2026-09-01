<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::published()->orderBy('published_at', 'desc');

        // Filtro por categoria
        if ($request->has('categoria') && $request->categoria) {
            $query->byCategory($request->categoria);
        }

        // Busca por termo
        if ($request->has('busca') && $request->busca) {
            $searchTerm = $request->busca;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('content', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('excerpt', 'LIKE', "%{$searchTerm}%");
            });
        }

        $posts = $query->paginate(12);
        
        // Cache das categorias para o filtro
        $categorias = Cache::remember('blog_categorias', 3600, function () {
            return Post::published()
                      ->select('category')
                      ->distinct()
                      ->pluck('category')
                      ->sort();
        });

        // Posts em destaque (mais visualizados)
        $postsDestaque = Cache::remember('posts_destaque', 1800, function () {
            return Post::published()
                      ->orderBy('views', 'desc')
                      ->orderBy('published_at', 'desc')
                      ->limit(4)
                      ->get();
        });

        return view('blog.index', compact('posts', 'categorias', 'postsDestaque'));
    }

    public function show(Post $post)
    {
        // Incrementa visualizações
        $post->incrementViews();

        // Posts relacionados (mesma categoria)
        $postsRelacionados = Post::published()
                                ->byCategory($post->category)
                                ->where('id', '!=', $post->id)
                                ->recent()
                                ->limit(4)
                                ->get();

        // Cache do post anterior e próximo
        $postAnterior = Post::published()
                           ->where('published_at', '<', $post->published_at)
                           ->orderBy('published_at', 'desc')
                           ->first();

        $proximoPost = Post::published()
                          ->where('published_at', '>', $post->published_at)
                          ->orderBy('published_at', 'asc')
                          ->first();

        return view('blog.show', compact('post', 'postsRelacionados', 'postAnterior', 'proximoPost'));
    }

    public function categoria($categoria)
    {
        $posts = Post::published()
                    ->byCategory($categoria)
                    ->recent()
                    ->paginate(12);

        $tituloCategoria = ucfirst($categoria);

        return view('blog.categoria', compact('posts', 'categoria', 'tituloCategoria'));
    }

    public function sitemap()
    {
        $posts = Post::published()
                    ->select('slug', 'updated_at')
                    ->get();

        return response()
            ->view('blog.sitemap', compact('posts'))
            ->header('Content-Type', 'application/xml');
    }

    public function feed()
    {
        $posts = Post::published()
                    ->recent()
                    ->limit(20)
                    ->get();

        return response()
            ->view('blog.feed', compact('posts'))
            ->header('Content-Type', 'application/rss+xml');
    }
}