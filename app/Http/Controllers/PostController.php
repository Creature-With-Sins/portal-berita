<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Menampilkan dashboard utama berdasarkan role (Admin / Member).
     */
    public function index()
    {
        $user = auth()->user();

        // 1. Jika User adalah ADMIN -> Tampilkan Dashboard Admin
        if ($user->role === 'admin') {
            $posts = Post::with(['author', 'category'])->latest()->get();
            return view('dashboard', compact('posts'));
        }

        // 2. Jika User adalah MEMBER -> Tampilkan Dashboard Member
        $myPosts = Post::with('category')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('member.dashboard', compact('myPosts'));
    }

    /**
     * Menampilkan form tambah artikel.
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Menyimpan artikel baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content'     => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        // Mencegah error slug bentrok jika judul sama
        $slug = Str::slug($request->title) . '-' . Str::random(5);

        // Jika Admin -> Langsung Published, Jika Member -> Pending
        $status = (auth()->user()->role === 'admin') ? 'published' : 'pending';

        Post::create([
            'user_id'     => auth()->id(),
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'slug'        => $slug,
            'content'     => $request->content,
            'image'       => $imagePath,
            'status'      => $status,
        ]);

        $message = ($status === 'published')
            ? 'Berita berhasil diterbitkan!'
            : 'Berita berhasil dikirim! Menunggu persetujuan admin.';

        return redirect()->route('dashboard')->with('success', $message);
    }

    /**
     * Menampilkan form edit artikel (Khusus Admin atau Pemilik Artikel).
     */
    public function edit(Post $post)
    {
        $user = auth()->user();

        // Memastikan CUMA Admin ATAU Pemilik Artikel yang bisa edit
        if ($user->role !== 'admin' && $post->user_id !== $user->id) {
            abort(403, 'Kamu tidak memiliki izin untuk mengedit artikel ini.');
        }

        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Menyimpan perubahan artikel yang diedit.
     */
    public function update(Request $request, Post $post)
    {
        $user = auth()->user();

        // Memastikan CUMA Admin ATAU Pemilik Artikel yang bisa update
        if ($user->role !== 'admin' && $post->user_id !== $user->id) {
            abort(403, 'Kamu tidak memiliki izin untuk mengubah artikel ini.');
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content'     => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }

        // Jika member mengedit artikel (baik pending/published), kembalikan ke 'pending' untuk di-review lagi oleh Admin.
        // Jika Admin yang mengedit, status tetap seperti semula.
        $status = ($user->role === 'admin') ? $post->status : 'pending';

        $post->title       = $request->title;
        $post->category_id = $request->category_id;
        $post->content     = $request->content;
        $post->status      = $status;
        $post->save();

        return redirect()->route('dashboard')->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Menghapus artikel (Khusus Admin atau Pemilik Artikel).
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (auth()->user()->role !== 'admin' && $post->user_id !== auth()->id()) {
            abort(403, 'Kamu tidak memiliki izin untuk menghapus artikel ini.');
        }

        $post->delete();

        return redirect()->back()->with('success', 'Artikel berhasil dihapus!');
    }

    /**
     * Menampilkan semua artikel berstatus 'pending' (Khusus Admin).
     */
    public function pendingPosts()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Halaman ini khusus Admin.');
        }

        $pendingPosts = Post::with(['author', 'category'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('posts.pending', compact('pendingPosts'));
    }

    /**
     * Halaman review isi penuh artikel sebelum disetujui (Khusus Admin).
     */
    public function review(Post $post)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses khusus Admin.');
        }

        $post->load(['author', 'category']);
        return view('posts.review', compact('post'));
    }

    /**
     * Memperbarui status artikel / Approve / Reject (Khusus Admin).
     */
    public function updateStatus(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Aksi ini khusus Admin.');
        }

        $request->validate([
            'status' => 'required|in:published,rejected,pending,draft',
        ]);

        $post = Post::findOrFail($id);
        $post->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status berita berhasil diperbarui!');
    }
}