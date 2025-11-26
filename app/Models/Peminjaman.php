<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'kode_pinjam',
        'tanggal_pinjam',
        'tanggal_kembali',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(PeminjamanAlat::class, 'peminjaman_id');
    }

    public function alats()
    {
        return $this->belongsToMany(
            Alat::class,
            'peminjaman_alat',
            'peminjaman_id',
            'alat_id'
        )
            ->withPivot('jumlah')
            ->withTimestamps();
    }
}
