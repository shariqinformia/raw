<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ImageSlide;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function show(Request $request, ImageSlide $slug)
    {
        // dd($slug->images);

        if ($request->isMethod('post')) {
            $password = $request->input('password');





            if ($password === $slug->password) {

                return view('frontend.view', [
                    'slug' => $slug,
                    'passwordValid' => true
                ]);
            } else {
                return redirect()->route('service.show', $slug->slug)
                    ->withErrors(['password' => 'Incorrect password.']);
            }
        }


        return view('frontend.view', [
            'slug' => $slug,
            'images' => $slug->images,
            'passwordValid' => false
        ]);
    }
}
