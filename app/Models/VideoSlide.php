<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoSlide extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function videos()
    {
        return $this->hasMany(ServiceVideo::class);  // Assuming one service has many images
    }


}
