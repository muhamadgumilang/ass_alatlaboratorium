<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanDetail extends Model
{
    protected $table    = 'peminjaman_detail';
    protected $fillable = [
        'peminjaman_id', 'alat_id', 'jumlah',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }
}
