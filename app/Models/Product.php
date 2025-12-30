<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'business_id',
        'name',
        'description',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
