<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'name',
        'phone',
        'email',
        'category',
        'title',
        'content',
        'location',
        'attachment',
        'status',
        'response',
        'responded_at',
    ];

    protected function casts(): array
    {
        return [
            'responded_at' => 'datetime',
        ];
    }

    /**
     * Badge CSS class dan label status
     */
    public function getStatusMetaAttribute(): array
    {
        return match ($this->status) {
            'pending' => [
                'label' => 'Menunggu Review',
                'bg' => 'bg-amber-100 text-amber-800 border-amber-200',
                'dot' => 'bg-amber-500',
            ],
            'diproses' => [
                'label' => 'Sedang Diproses',
                'bg' => 'bg-blue-100 text-blue-800 border-blue-200',
                'dot' => 'bg-blue-500',
            ],
            'selesai' => [
                'label' => 'Selesai / Ditindaklanjuti',
                'bg' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                'dot' => 'bg-emerald-500',
            ],
            'ditolak' => [
                'label' => 'Ditolak / Tidak Sesuai',
                'bg' => 'bg-rose-100 text-rose-800 border-rose-200',
                'dot' => 'bg-rose-500',
            ],
            default => [
                'label' => ucfirst($this->status),
                'bg' => 'bg-gray-100 text-gray-800 border-gray-200',
                'dot' => 'bg-gray-400',
            ],
        };
    }
}
