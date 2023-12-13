<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    use HasFactory;
    protected $table = "produk";
    public $timestamps = false;
    protected $primaryKey = 'id_produk';
    protected $fillable = [
        'nama_produk',
        'harga',
        'kategori_id',
        'status_id'
    ];
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
