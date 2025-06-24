<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','slug','country','city'];


    public function tours() {
        return $this->hasMany(Tour::class);
    }

    public function scopeTrending($query, $limit = 10)
    {
        return $query->withAvg('tours', 'rating')
            ->withSum('tours', 'review_count')
            ->orderByDesc('tours_sum_review_count')  // عدد التقييمات الأعلى
            ->orderByDesc('tours_avg_rating')        // ثم الأعلى تقييمًا
            ->take($limit);
    }
}
