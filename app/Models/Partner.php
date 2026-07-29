<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use App\Models\Review;

class Partner extends Model
{
    protected $fillable = ['name', 'logo_url'];

    public function events()
    {
        return $this->hasMany(Event::class);
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
