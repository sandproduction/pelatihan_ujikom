<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $primaryKey = 'id_item';
    protected $table = 'item';
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_item',
        'nama_item',
        'uom',
        'harga_beli',
        'harga_jual',
    ];
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id_item');
    }
}
