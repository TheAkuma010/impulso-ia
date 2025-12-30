<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'businesses';

    protected $fillable = [
        'name',
        'description',
        'niche',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function targetAudiences()
    {
        return $this->hasMany(TargetAudience::class);
    }

    public function suggestions()
    {
        return $this->hasMany(Suggestion::class);
    }
}
