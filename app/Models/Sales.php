<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $primaryKey = 'id_sales';
    protected $table = 'sales';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_sales',
        'tgl_sales',
        'id_customer',
        'do_number',
        'status',
    ];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }
}
