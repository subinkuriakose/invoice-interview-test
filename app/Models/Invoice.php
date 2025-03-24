<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Crypt;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'invoice_date', 'amount', 'status'
    ];

    protected function idEnc(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Crypt::encryptString($this->attributes['id']),
        );
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
