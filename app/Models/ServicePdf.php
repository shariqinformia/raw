<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePdf extends Model
{
    use HasFactory;

    protected $fillable = ['file_name'];

    public function pdf()
    {
        return $this->belongsTo(Pdf::class);
    }
}
