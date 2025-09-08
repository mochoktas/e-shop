<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Meja extends Model
{
    //
    protected $table = 'meja';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nomor_meja',
        'status'
    ];
    public function keranjang(): HasMany
    {
        return $this->hasMany(Keranjang::class);
    }

}
