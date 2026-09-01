<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Komik extends Model
{
    use HasFactory;

    protected $table = 'komiks';

    protected $fillable = [
        'judul',
        'penulis',
        'kategori_id',
        'stok',
        'status',
        'file_pdf',
    ];

    public function kategori(): BelongsTo
    { 
        return $this->belongsTo(Kategori::class); 
    } 
    
    public function peminjaman(): HasMany 
    { 
        return $this->hasMany(Peminjaman::class); 
    }
}