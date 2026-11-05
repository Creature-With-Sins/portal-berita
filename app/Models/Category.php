<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Tambahkan ini biar kolom name dan slug bisa diisi otomatis
    protected $fillable = ['name', 'slug'];

    // Atau kalau mau simpel pakai guarded (selain 'id' boleh diisi):
    // protected $guarded = ['id'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}