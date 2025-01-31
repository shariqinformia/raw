<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ImageSlide;
use App\Models\Pdf;
use App\Models\VideoSlide;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function show(Request $request, Pdf $pdf)
    {

        if ($request->isMethod('post')) {
            $password = $request->input('password');

            if ($password === $pdf->password) {

                return view('frontend.video_slides', [
                    'slug' => $pdf,
                    'passwordValid' => true
                ]);
            } else {
                return redirect()->route('video_slides.show', $pdf->slug)
                    ->withErrors(['password' => 'Incorrect password.']);
            }
        }


        return view('frontend.pdfs', [
            'slug' => $pdf,
            'pdf' => $pdf->service_pdfs,
            'passwordValid' => false
        ]);
    }
}
