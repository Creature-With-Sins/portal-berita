<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ComplaintController extends Controller
{
    /**
     * Kategori standar pengaduan/pengajuan masyarakat
     */
    public static array $categories = [
        'Pelayanan Publik & Administrasi',
        'Infrastruktur, Jalan & Fasilitas Umum',
        'Kebersihan, Sampah & Lingkungan Hidup',
        'Keamanan, Ketertiban & Ketenteraman',
        'Sosial, Bantuan Masyarakat & Kesehatan',
        'Aspirasi & Usulan Pembangunan',
        'Lainnya',
    ];

    /**
     * Tampilkan formulir pengaduan masyarakat (publik, tanpa perlu login).
     */
    public function create()
    {
        $categories = self::$categories;
        return view('complaints.create', compact('categories'));
    }

    /**
     * Simpan pengaduan baru dari masyarakat.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:150',
            'phone'      => 'required|string|max:30',
            'email'      => 'nullable|email|max:150',
            'category'   => 'required|string|max:100',
            'title'      => 'required|string|max:255',
            'location'   => 'nullable|string|max:255',
            'content'    => 'required|string',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,webp,pdf|max:3072',
        ], [
            'name.required'     => 'Nama lengkap wajib diisi.',
            'phone.required'    => 'Nomor telepon / WhatsApp wajib diisi agar kami dapat mengabari perkembangan.',
            'category.required' => 'Silakan pilih kategori pengaduan.',
            'title.required'    => 'Judul atau perihal pengaduan wajib diisi.',
            'content.required'  => 'Isi atau rincian pengaduan wajib diisi.',
            'attachment.max'    => 'Ukuran lampiran maksimal 3MB.',
            'attachment.mimes'  => 'Format lampiran yang diperbolehkan: JPG, PNG, WEBP, atau PDF.',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('complaints', 'public');
        }

        // Generate nomor tiket unik otomatis, contoh: PGD-20261027-A8K2Z
        $ticketNumber = 'PGD-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        $complaint = Complaint::create([
            'ticket_number' => $ticketNumber,
            'name'          => $request->name,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'category'      => $request->category,
            'title'         => $request->title,
            'location'      => $request->location,
            'content'       => $request->content,
            'attachment'    => $attachmentPath,
            'status'        => 'pending',
        ]);

        return redirect()->route('complaints.success', ['ticket' => $complaint->ticket_number])
            ->with('success', 'Pengaduan Anda berhasil dikirim!');
    }

    /**
     * Halaman sukses pengajuan dan menampilkan nomor tiket.
     */
    public function success(Request $request)
    {
        $ticket = $request->query('ticket');
        $complaint = null;

        if ($ticket) {
            $complaint = Complaint::where('ticket_number', $ticket)->first();
        }

        return view('complaints.success', compact('complaint', 'ticket'));
    }

    /**
     * Halaman lacak status pengaduan oleh masyarakat (publik).
     */
    public function track(Request $request)
    {
        $ticket = trim($request->query('ticket', ''));
        $complaint = null;

        if ($ticket !== '') {
            $complaint = Complaint::where('ticket_number', $ticket)
                ->orWhere(function ($q) use ($ticket) {
                    $q->where('phone', $ticket);
                })
                ->latest()
                ->first();
        }

        return view('complaints.track', compact('complaint', 'ticket'));
    }

    /* =========================================================================
     * AREA ADMIN (Memerlukan Otorisasi Admin)
     * ========================================================================= */

    /**
     * Tampilkan daftar pengaduan masyarakat untuk admin.
     */
    public function adminIndex(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk Admin.');
        }

        $query = Complaint::latest();

        // Filter status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Pencarian (tiket, nama, judul, no hp)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $complaints = $query->paginate(15)->withQueryString();

        $stats = [
            'total'    => Complaint::count(),
            'pending'  => Complaint::where('status', 'pending')->count(),
            'diproses' => Complaint::where('status', 'diproses')->count(),
            'selesai'  => Complaint::where('status', 'selesai')->count(),
            'ditolak'  => Complaint::where('status', 'ditolak')->count(),
        ];

        $categories = self::$categories;

        return view('admin.complaints.index', compact('complaints', 'stats', 'categories'));
    }

    /**
     * Detail pengaduan untuk ditinjau admin.
     */
    public function adminShow(Complaint $complaint)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        return view('admin.complaints.show', compact('complaint'));
    }

    /**
     * Perbarui status & tanggapan admin atas pengaduan.
     */
    public function adminUpdateStatus(Request $request, Complaint $complaint)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'status'   => 'required|in:pending,diproses,selesai,ditolak',
            'response' => 'nullable|string',
        ]);

        $complaint->update([
            'status'       => $request->status,
            'response'     => $request->response,
            'responded_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Status & tanggapan pengaduan berhasil diperbarui!');
    }

    /**
     * Hapus pengaduan oleh admin jika diperlukan.
     */
    public function adminDestroy(Complaint $complaint)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        if ($complaint->attachment && Storage::disk('public')->exists($complaint->attachment)) {
            Storage::disk('public')->delete($complaint->attachment);
        }

        $complaint->delete();

        return redirect()->route('admin.complaints.index')->with('success', 'Data pengaduan berhasil dihapus.');
    }
}
