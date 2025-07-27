<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'level';
    protected $primaryKey = 'id_level';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    
    protected $fillable = ['id_level','level'];

    public function petugas()
    {
        return $this->hasMany(Petugas::class, 'id_level', 'level');
    }
}
