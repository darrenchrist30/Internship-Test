<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';

    protected $fillable = ['customer_id', 'customer_name', 'customer_email'];

    public function purchases() {
        return $this->hasMany(Purchase::class, 'customer_id', 'customer_id');
    }
}
