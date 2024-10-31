<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ImageSlide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ImageSlidesController extends Controller
{
    // Display a listing of the image_slides.
    public function index(Request $request)
    {
        $services = $services = ImageSlide::with('images')->paginate(10);
        return view('backend.image_slides.index', compact('services'));
    }

    // Show the form for creating a new service.
    public function create()
    {
        $image_slide = new ImageSlide();
        $idFormEdit = false;
        return view('backend.image_slides.create', compact('image_slide', 'idFormEdit'));
    }

    // Store a newly created service in the database.
    public function store(Request $request)
    {
        // Validate form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',  // Validating URL field
            'password' => 'required|integer',
            //'default_no_of_images' => 'required|integer',
            'images' => 'required',   // Ensure at least one image is uploaded
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each image file
        ]);

        // Store service data
        $image_slide = new ImageSlide();
        $image_slide->name = $validated['name'];
        $image_slide->url = $validated['url'];
        $image_slide->password = $validated['password'];
        $image_slide->slug = $request->slug;

        $image_slide->description = $request->description;
        $totalImages = count($request->file('images')); // Count the total images
        $image_slide->default_no_of_images = $totalImages / 2;
        $image_slide->save();

        // Handle image uploads
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $file) {
                // Generate a unique file name
                $filename = time() . '-' . $file->getClientOriginalName();
                // Save the file to a public folder
                $file->move(public_path('uploads/image_slides'), $filename);

                // Optionally, save the file name to the database
                // For example, if you have a related images table:
                $image_slide->images()->create([
                    'file_name' => $filename,
                ]);
            }
        }


        // Redirect to the index page with a success message
        return redirect()->route('backend.image_slides.index')->with('success', 'ImageSlide created successfully!');
    }


    // Show the form for editing the specified service.
    public function edit(ImageSlide $image_slide)
    {
        $idFormEdit = true;
        return view('backend.image_slides.edit', compact('image_slide', 'idFormEdit'));
    }

    // Update the specified service in the database.
    public function update(Request $request, ImageSlide $image_slide)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
          //  'default_no_of_images' => 'required|integer',
            'password' => 'required',
            'images' => 'nullable|array',  // for multiple images
            'images.*' => 'nullable|mimes:jpg,jpeg,png,bmp|max:2048' // Max size per image
        ]);

        // Update service fields
        $image_slide->name = $request->input('name');
        $image_slide->url = $request->input('url');
        $image_slide->slug = $request->input('slug');
        $image_slide->password = $request->input('password');
        //$image_slide->default_no_of_images = $request->input('default_no_of_images');
        $image_slide->update($request->all());

        // Delete old images if new ones are provided
        if ($request->hasFile('images')) {

            // Delete the old images from storage and database
            foreach ($image_slide->images as $image) {
                // Full path to the image file in the public directory
                $fullPath = public_path('uploads/image_slides/' . $image->file_name);

                // Check if the file exists and is a file, then delete
                if (file_exists($fullPath) && is_file($fullPath)) {
                    unlink($fullPath);
                }

                // Delete the image record from the database
                $image->delete();
            }

            // Handle image uploads

            foreach ($request->file('images') as $file) {
                // Generate a unique file name
                $filename = time() . '-' . $file->getClientOriginalName();
                // Save the file to a public folder
                $file->move(public_path('uploads/image_slides'), $filename);

                // Optionally, save the file name to the database
                // For example, if you have a related images table:
                $image_slide->images()->create([
                    'file_name' => $filename,
                ]);
            }
        }

        // Redirect or return back with success message
        return redirect()->route('backend.image_slides.index')
            ->with('success', 'ImageSlide updated successfully');
    }


    // Remove the specified service from the database.
    public function destroy(ImageSlide $image_slide)
    {
        $image_slide->delete();

        return redirect()->route('backend.image_slides.index')->with('success', 'ImageSlide deleted successfully!');
    }
}
