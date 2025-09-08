<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Pembayaran extends Model
{
    //
    protected $table = 'pembayaran';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pemesanan_id',
        'total_bayar',
        'metode_pembayaran',
        'status'
    ];
    public function pemesanan(): BelongsTo
    {
        return $this->belongsTo(Pemesanan::class);  
    }

}
