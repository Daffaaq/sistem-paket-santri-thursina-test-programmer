<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asrama extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_asrama';

    protected $table = 'asramas';

    protected $fillable = [
        'nama_asrama',
        'gedung'
    ];

    // Relasi dengan santris (one-to-many)
    public function santris()
    {
        return $this->hasMany(Santri::class, 'id_asrama');
    }
}
