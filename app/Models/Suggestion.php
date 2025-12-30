<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $table = 'suggestions';

    protected $fillable = [
        'business_id',
        'content',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
