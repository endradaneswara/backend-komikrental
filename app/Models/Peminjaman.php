<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model 
{ 
    use HasFactory; protected $table = 'peminjaman'; 
    
    protected $fillable = [
        'anggota_id', 
        'komik_id', 
        'tanggal_pinjam', 
        'tanggal_kembal i', 
        'status'
    ]; 
    
    public function anggota() 
    { 
        return $this->belongsTo(Anggota::class); 
    } 
    
    public function komik() 
    {
        return $this->belongsTo(Komik::class); 
    } 
}
