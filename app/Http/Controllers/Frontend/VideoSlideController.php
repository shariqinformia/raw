<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ImageSlide;
use App\Models\VideoSlide;
use Illuminate\Http\Request;

class VideoSlideController extends Controller
{
    public function show(Request $request, VideoSlide $slug)
    {

        if ($request->isMethod('post')) {
            $password = $request->input('password');

            if ($password === $slug->password) {

                return view('frontend.video_slides', [
                    'slug' => $slug,
                    'passwordValid' => true
                ]);
            } else {
                return redirect()->route('video_slides.show', $slug->slug)
                    ->withErrors(['password' => 'Incorrect password.']);
            }
        }


        return view('frontend.video_slides', [
            'slug' => $slug,
            'videos' => $slug->videos,
            'passwordValid' => false
        ]);
    }
}
