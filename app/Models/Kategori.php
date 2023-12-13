<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;
    protected $table = "kategori";
    public $timestamps = false;
    protected $primaryKey = 'id_kategori';
    protected $fillable = [
        'nama_kategori',
    ];
}
