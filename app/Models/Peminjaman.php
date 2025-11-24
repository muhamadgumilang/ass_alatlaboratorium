<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman'; // <== WAJIB DITAMBAHKAN

    protected $fillable = [
        'kode_pinjam',
        'tanggal_pinjam',
        'tanggal_kembali',
        'user_id',
    ];

    public function alat()
    {
        return $this->belongsToMany(Alat::class, 'detail_peminjaman')
            ->withPivot('jumlah')
            ->withTimestamps();
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
