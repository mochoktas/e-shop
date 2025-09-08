<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPemesanan extends Model
{
    //
    protected $table = 'detail_pemesanan';
    public $timestamps = false;
    protected $fillable = [
        'pemesanan_id',
        'barang_id',
        'jumlah',
        'harga_satuan',
        'harga_total'
    ];
    
    public function pemesanan(): BelongsTo
    {
        return $this->belongsTo(Pemesanan::class);
    }
    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }
}
