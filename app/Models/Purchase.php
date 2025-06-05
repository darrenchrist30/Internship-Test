<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchases';
    protected $primaryKey = 'purchase_id';

    protected $fillable = [
        'customer_id',    // <--- TAMBAHKAN INI JIKA BELUM ADA
        'purchase_date',
        'total_price',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
}
