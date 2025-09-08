<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Pemesanan extends Model
{
    //
    protected $table = 'pemesanan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'meja_id',
        'total_harga'
    ];
    public function meja(): BelongsTo
    {
        return $this->belongsTo(Meja::class);       
    }   
    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }
}
