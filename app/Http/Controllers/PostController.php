<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['category', 'tags'])->orderByDesc('created_at')->paginate(15);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'published' => 'boolean',
            'published_at' => 'nullable|date',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        $post = Post::create($validated);
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }
        return redirect()->route('posts.index')->with('success', 'Post criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::with(['category', 'tags'])->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::with('tags')->findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $post->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'published' => 'boolean',
            'published_at' => 'nullable|date',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        $post->update($validated);
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }
        return redirect()->route('posts.index')->with('success', 'Post atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post removido com sucesso!');
    }
}
