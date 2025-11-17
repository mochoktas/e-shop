<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Barang extends Model
{
    //
    protected $table = 'barang';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'harga',
        'foto',
        'jenis_barang_id'
    ];
    public function jenis_barang(): BelongsTo
    {
        return $this->belongsTo(JenisBarang::class);
    }

    public function detail_pemesanan(): HasMany
    {
        return $this->hasMany(DetailPemesanan::class);
    }

    public function keranjang(): HasMany
    {
        return $this->hasMany(Keranjang::class);
    }
}
