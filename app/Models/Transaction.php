<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $primaryKey = 'id_transaction';
    protected $table = 'transaction';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_transaction',
        'id_item',
        'quantity',
        'price',
        'amount',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item', 'id_item');
    }
}
