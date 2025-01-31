<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdf extends Model
{
    use HasFactory;

    protected $fillable = ['name','url','slug','password','default_no_of_pdf','description'];

    public function service_pdfs()
    {
        return $this->hasMany(ServicePdf::class);  // Assuming one service has many images
    }


}
