<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPanen extends Model
{
    use HasFactory;
    // Tambahkan baris ini
    protected $fillable = ['nama_komoditas', 'jumlah_kg', 'tanggal_panen']; 
}