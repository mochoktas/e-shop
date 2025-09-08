<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Keranjang extends Model
{
    //
    protected $table = 'keranjang';
    public $timestamps = false;
    protected $fillable = [
        'meja_id',
        'barang_id',
        'jumlah'
    ];
    public function meja(): BelongsTo
    {
        return $this->belongsTo(Meja::class);
    }
    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }
}
