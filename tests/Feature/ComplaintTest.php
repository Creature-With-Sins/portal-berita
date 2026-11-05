<?php

use App\Models\Complaint;
use App\Models\User;

test('halaman pengaduan dapat diakses publik tanpa login', function () {
    $response = $this->get('/pengaduan');
    $response->assertStatus(200);
    $response->assertSee('Formulir Pengaduan', false);
});

test('masyarakat dapat mengirim pengaduan tanpa login dan menerima nomor tiket', function () {
    $response = $this->post('/pengaduan', [
        'name'     => 'Ahmad Warga',
        'phone'    => '081234567890',
        'email'    => 'ahmad@example.com',
        'category' => 'Pelayanan Publik & Administrasi',
        'title'    => 'Pelayanan KTP Terlambat',
        'location' => 'Kantor Kelurahan',
        'content'  => 'Mohon bantuan untuk mempercepat cetak KTP yang sudah menunggu 2 minggu.',
    ]);

    $complaint = Complaint::where('phone', '081234567890')->first();
    expect($complaint)->not->toBeNull();
    expect($complaint->status)->toBe('pending');
    expect($complaint->ticket_number)->toStartWith('PGD-');

    $response->assertRedirect(route('complaints.success', ['ticket' => $complaint->ticket_number]));
});

test('masyarakat dapat melacak pengaduan menggunakan nomor tiket', function () {
    $complaint = Complaint::create([
        'ticket_number' => 'PGD-20261027-TEST1',
        'name'          => 'Siti Lestari',
        'phone'         => '08987654321',
        'category'      => 'Infrastruktur, Jalan & Fasilitas Umum',
        'title'         => 'Jalan Berlubang di Dekat Pasar',
        'content'       => 'Jalan berlubang cukup parah dan sering membuat pengendara jatuh.',
        'status'        => 'pending',
    ]);

    $response = $this->get('/pengaduan/lacak?ticket=' . $complaint->ticket_number);
    $response->assertStatus(200);
    $response->assertSee('PGD-20261027-TEST1');
    $response->assertSee('Jalan Berlubang di Dekat Pasar');
});

test('admin dapat mengupdate status dan respon pengaduan', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $complaint = Complaint::create([
        'ticket_number' => 'PGD-20261027-TEST2',
        'name'          => 'Joko',
        'phone'         => '0811223344',
        'category'      => 'Kebersihan, Sampah & Lingkungan Hidup',
        'title'         => 'Tumpukan Sampah',
        'content'       => 'Ada tumpukan sampah liar di pinggir sungai.',
        'status'        => 'pending',
    ]);

    $response = $this->actingAs($admin)->patch("/admin/pengaduan/{$complaint->id}/status", [
        'status'   => 'diproses',
        'response' => 'Tim kebersihan sudah diterjunkan ke lokasi.',
    ]);

    $response->assertRedirect();
    $complaint->refresh();
    expect($complaint->status)->toBe('diproses');
    expect($complaint->response)->toBe('Tim kebersihan sudah diterjunkan ke lokasi.');
    expect($complaint->responded_at)->not->toBeNull();
});
