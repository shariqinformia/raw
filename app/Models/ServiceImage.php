<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    use HasFactory;

    protected $fillable = ['image_slide_id', 'file_name'];

    public function service()
    {
        return $this->belongsTo(ImageSlide::class);
    }
}
