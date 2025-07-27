<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_user';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['id_user','nama_user', 'username', 'password', 'level'];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level', 'id_level');
    }
}
