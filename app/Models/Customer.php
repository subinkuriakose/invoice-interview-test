<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Crypt;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'address'
    ];

    protected function idEnc(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Crypt::encryptString($this->attributes['id']),
        );
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'customer_id', 'id');
    }
}
