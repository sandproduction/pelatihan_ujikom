<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'id_customer';
    protected $table = 'customer';
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_customer',
        'nama_customer',
        'alamat',
        'telp',
        'fax',
        'email',
    ];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($customer) {
            $customer->sales()->delete();
        });
    }
    public function sales()
    {
        return $this->hasMany(Sales::class, 'id_customer', 'id_customer');
    }
}
