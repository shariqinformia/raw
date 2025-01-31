<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ImageSlide;
use App\Models\Pdf;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PdfController extends Controller
{
    // Display a listing of the image_slides.
    public function index(Request $request)
    {
        $pdfs = Pdf::with('service_pdfs')->paginate(10);
        return view('backend.pdfs.index', compact('pdfs'));
    }

    // Show the form for creating a new service.
    public function create()
    {
        $pdf = new Pdf();
        $idFormEdit = false;
        return view('backend.pdfs.create', compact('pdf', 'idFormEdit'));
    }

    // Store a newly created service in the database.
    public function store(Request $request)
    {

        //dd($request->toArray());

        // Validate form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',  // Validating URL field
            'password' => 'required|integer',
            //'default_no_of_pdf' => 'required|integer',
            'pdfs' => 'required',   // Ensure at least one PDF is uploaded
            'pdfs.*' => 'mimes:pdf|max:2048', // Validate each file as PDF with max size 2MB
        ]);

        // Store service data
        $image_slide = new Pdf();
        $image_slide->name = $validated['name'];
        $image_slide->url = $validated['url'];
        $image_slide->password = $validated['password'];
        $image_slide->slug = $request->slug;

        $image_slide->description = $request->description;
        $totalPdfs = count($request->file('pdfs')); // Count the total images
        $image_slide->default_no_of_pdf = $totalPdfs / 2;
        $image_slide->save();

        // Handle image uploads
        if ($request->hasFile('pdfs')) {

            foreach ($request->file('pdfs') as $file) {
                // Generate a unique file name
                $filename = time() . '-' . $file->getClientOriginalName();
                // Save the file to a public folder
                $file->move(public_path('uploads/pdfs'), $filename);

                // Optionally, save the file name to the database
                // For example, if you have a related images table:
                $image_slide->service_pdfs()->create([
                    'file_name' => $filename,
                ]);
            }
        }


        // Redirect to the index page with a success message
        return redirect()->route('backend.pdf.index')->with('success', 'Pdf created successfully!');
    }


    // Show the form for editing the specified service.
    public function edit(Pdf $pdf)
    {
        $idFormEdit = true;
        return view('backend.pdfs.edit', compact('pdf', 'idFormEdit'));
    }

    // Update the specified service in the database.
    public function update(Request $request, Pdf $pdf)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required'
        ]);

        // Update service fields
        $pdf->name = $request->input('name');
        $pdf->url = $request->input('url');
        $pdf->slug = $request->input('slug');
        $pdf->password = $request->input('password');
        $pdf->update($request->all());

        // Delete old images if new ones are provided
        if ($request->hasFile('pdfs')) {


            foreach ($pdf->service_pdfs as $service_pdf) {
                $fullPath = public_path('uploads/pdfs/' . $service_pdf->file_name);

                // Check if the file exists and is a file, then delete
                if (file_exists($fullPath) && is_file($fullPath)) {
                    unlink($fullPath);
                }

                // Delete the image record from the database
                $service_pdf->delete();
            }

            // Handle image uploads

            foreach ($request->file('pdfs') as $file) {
                // Generate a unique file name
                $filename = time() . '-' . $file->getClientOriginalName();
                // Save the file to a public folder
                $file->move(public_path('uploads/pdfs'), $filename);

                // Optionally, save the file name to the database
                // For example, if you have a related images table:
                $pdf->service_pdfs()->create([
                    'file_name' => $filename,
                ]);
            }
        }

        // Redirect or return back with success message
        return redirect()->route('backend.pdf.index')
            ->with('success', 'Pdf updated successfully');
    }


    // Remove the specified service from the database.
    public function destroy(Pdf $pdf)
    {
        $pdf->delete();
        return redirect()->route('backend.pdf.index')->with('success', 'Pdf deleted successfully!');
    }
}
