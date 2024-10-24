<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function show(Service $slug)
    {
        return view('frontend.view',compact('slug'));
    }
}
