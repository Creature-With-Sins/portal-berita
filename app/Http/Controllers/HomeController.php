<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Tampilkan semua berita yang sudah PUBLISHED di Homepage
    public function index(Request $request)
    {
        $categories = Category::all();

        $postsQuery = Post::with(['author', 'category'])
            ->where('status', 'published');

        // Filter Kategori
        if ($request->has('category') && $request->category != '') {
            $postsQuery->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }

        // Filter Searchbar
        if ($request->has('search') && $request->search != '') {
            $postsQuery->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $posts = $postsQuery->latest()->get();

        return view('welcome', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        $post = Post::with(['author', 'category'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('posts.show', compact('post'));
    }
}
