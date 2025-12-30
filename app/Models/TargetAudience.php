<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetAudience extends Model
{
    protected $table = 'target_audiences';

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
