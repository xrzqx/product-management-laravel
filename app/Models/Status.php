<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;
    protected $table = "status";
    public $timestamps = false;
    protected $primaryKey = 'id_status';
    protected $fillable = [
        'nama_status',
    ];
}
