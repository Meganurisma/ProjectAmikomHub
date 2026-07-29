<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Partner;
use App\Models\Review;

class Event extends Model
{
    protected $fillable = [
 'category_id', 'partner_id', 'title', 'description', 'date',
 'location', 'price', 'stock', 'poster_path'
];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
