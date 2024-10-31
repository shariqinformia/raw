<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ImageSlide;
use App\Models\User;
use App\Models\VideoSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VideoSlidesController extends Controller
{
    // Display a listing of the image_slides.
    public function index(Request $request)
    {
        $services = VideoSlide::with('videos')->paginate(10);
        return view('backend.video_slides.index', compact('services'));
    }

    // Show the form for creating a new service.
    public function create()
    {
        $video_slide = new VideoSlide();
        $idFormEdit = false;
        return view('backend.video_slides.create', compact('video_slide', 'idFormEdit'));
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
        $video_slide = new VideoSlide();
        $video_slide->name = $validated['name'];
        $video_slide->url = $validated['url'];
        $video_slide->password = $validated['password'];
        $video_slide->slug = $request->slug;

        $video_slide->description = $request->description;
        $totalImages = count($request->file('images')); // Count the total images
        $video_slide->default_no_of_videos = $totalImages / 2;
        $video_slide->save();

        // Handle image uploads
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $file) {
                // Generate a unique file name
                $filename = time() . '-' . $file->getClientOriginalName();
                // Save the file to a public folder
                $file->move(public_path('uploads/image_slides'), $filename);

                // Optionally, save the file name to the database
                // For example, if you have a related images table:
                $video_slide->videos()->create([
                    'file_name' => $filename,
                ]);
            }
        }


        // Redirect to the index page with a success message
        return redirect()->route('backend.video_slides.index')->with('success', 'Video Slide created successfully!');
    }


    // Show the form for editing the specified service.
    public function edit(VideoSlide $video_slide)
    {
        $idFormEdit = true;
        return view('backend.video_slides.edit', compact('video_slide', 'idFormEdit'));
    }

    // Update the specified service in the database.
    public function update(Request $request, VideoSlide $video_slide)
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
        $video_slide->name = $request->input('name');
        $video_slide->url = $request->input('url');
        $video_slide->slug = $request->input('slug');
        $video_slide->password = $request->input('password');
        $video_slide->update($request->all());

        // Delete old images if new ones are provided
        if ($request->hasFile('images')) {

            // Delete the old images from storage and database
            foreach ($video_slide->videos as $image) {
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
                $video_slide->images()->create([
                    'file_name' => $filename,
                ]);
            }
        }

        // Redirect or return back with success message
        return redirect()->route('backend.video_slides.index')
            ->with('success', 'VideoSlide updated successfully');
    }


    // Remove the specified service from the database.
    public function destroy(VideoSlide $video_slide)
    {
        $video_slide->delete();

        return redirect()->route('backend.video_slides.index')->with('success', 'Video Slide deleted successfully!');
    }
}
