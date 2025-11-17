<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisBarang extends Model
{
    //
    protected $table = 'jenis_barang';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        
    ];
    // public function jenis_kendaraan(): BelongsTo
    // {
    //     return $this->belongsTo(Jenis_Kendaraan::class);
    // }

    public function barang(): HasMany
    {
        return $this->hasMany(Barang::class);
    }
}
