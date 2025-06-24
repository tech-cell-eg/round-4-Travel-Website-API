<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'is_active',
    ];


    public function tours()
    {
        return $this->hasMany(Tour::class);
    }


    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
