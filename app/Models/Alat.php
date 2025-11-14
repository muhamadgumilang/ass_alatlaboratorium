<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $table    = 'alat';
    protected $fillable = [
        'nama_alat',
        'stok',
        'kategori_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriAlat::class, 'kategori_id');
    }

    public function peminjamanDetail()
    {
        return $this->hasMany(PeminjamanDetail::class);
    }
}
