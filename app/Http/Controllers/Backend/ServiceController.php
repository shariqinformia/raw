<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ServiceController extends Controller
{
    // Display a listing of the services.
    public function index(Request $request)
    {
        $services = $services = Service::with('images')->paginate(10);
//        foreach($services->first()->service_images as $image){
//            dump($image->file_name);
//        }
//        dd('hg');
        return view('backend.services.index', compact('services'));
    }

    // Show the form for creating a new service.
    public function create()
    {
        $service = new Service();
        $idFormEdit = false;
        return view('backend.services.create', compact('service','idFormEdit'));
    }

    // Store a newly created service in the database.
    public function store(Request $request)
    {
        // Validate form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',  // Validating URL field
            'password' => 'required',
            'default_no_of_images' => 'required|integer',
            'images' => 'required',   // Ensure at least one image is uploaded
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each image file
        ]);

        // Store service data
        $service = new Service();
        $service->name = $validated['name'];
        $service->url = $validated['url'];
        $service->password = $validated['password'];
        $service->slug = $request->slug;
        $service->default_no_of_images = $validated['default_no_of_images'];
        $service->description = $request->description;
        $service->save();

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                // Generate a unique file name
                $filename = time() . '-' . $file->getClientOriginalName();
                // Save the file to a public folder
                $file->move(public_path('uploads/services'), $filename);

                // Optionally, save the file name to the database
                // For example, if you have a related images table:
                $service->images()->create([
                    'file_name' => $filename,
                ]);
            }
        }

        // Redirect to the index page with a success message
        return redirect()->route('backend.services.index')->with('success', 'Service created successfully!');
    }



    // Show the form for editing the specified service.
    public function edit(Service $service)
    {
        $idFormEdit = true;
        return view('backend.services.edit', compact('service','idFormEdit'));
    }

    // Update the specified service in the database.
    public function update(Request $request, Service $service)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'default_no_of_images' => 'required|integer',
            'password' => 'required',
            'images' => 'nullable|array',  // for multiple images
            'images.*' => 'nullable|mimes:jpg,jpeg,png,bmp|max:2048' // Max size per image
        ]);

        // Update service fields
        $service->name = $request->input('name');
        $service->url = $request->input('url');
        $service->slug = $request->input('slug');
        $service->password = $request->input('password');
        $service->default_no_of_images = $request->input('default_no_of_images');
        $service->save();

        // Delete old images if new ones are provided
        if ($request->hasFile('images')) {
            // Delete the old images from storage and database
            foreach ($service->images as $image) {
                // Full path to the image file in the public directory
                $fullPath = public_path('uploads/services/' . $image->file_name);

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
                    $file->move(public_path('uploads/services'), $filename);

                    // Optionally, save the file name to the database
                    // For example, if you have a related images table:
                    $service->images()->create([
                        'file_name' => $filename,
                    ]);
                }
        }

        // Redirect or return back with success message
        return redirect()->route('backend.services.index')
            ->with('success', 'Service updated successfully');
    }



    // Remove the specified service from the database.
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully!');
    }
}
