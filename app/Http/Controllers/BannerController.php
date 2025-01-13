<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    // Method to show the list of banners
    public function index()
    {
        // Fetch all banners with their associated category, ordered by priority
        $banner = Banner::with('category')->orderBy('priority')->get();

        // Pass banners data to the view
        return view('banner.index', compact('banner'));
    }

    // Method to show the create banner form
    public function create()
    {
        // Get all categories to display in the category dropdown
        $categories = Category::all();

        // Return the create view with categories
        return view('banner.create', compact('categories'));
    }

    // Method to handle storing a new banner
    public function store(Request $request)
    {
        // Validate the incoming request data
        $data = $request->validate([
            'priority' => 'required|numeric', // Priority must be numeric
            'name' => 'required|string|max:255', // Banner name should be a string, max 255 characters
            'photopath' => 'required|image', // The photo must be an image
            'description' => 'nullable|string', // Description is optional
            'category_id' => 'nullable|exists:categories,id|unique:banners,category_id', // Ensure the category_id is unique in the banners table            'buttonaction' => 'nullable|string', // Button action is optional
        ]);

        // Store the uploaded image
        $photo = $request->file('photopath');
        $photoname = time() . '.' . $photo->extension(); // Generate a unique name for the image
        $photo->move(public_path('images/banners'), $photoname); // Move the image to the specified folder
        $data['photopath'] = $photoname; // Add the photo path to data

        // Create a new banner in the database
        Banner::create($data);

        // Redirect to the banner index page with a success message
        return redirect()->route('banner.index')->with('success', 'Banner Created Successfully');
    }

    // Method to show the edit banner form
    public function edit($id)
    {
        // Find the banner by ID or fail if not found
        $banner = Banner::findOrFail($id);

        // Get all categories to display in the category dropdown
        $categories = Category::all();

        // Return the edit view with banner and categories data
        return view('banner.edit', compact('banner', 'categories'));
    }

    // Method to handle updating an existing banner
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $data = $request->validate([
            'priority' => 'required|numeric', // Priority must be numeric
            'name' => 'required|string|max:255', // Banner name should be a string, max 255 characters
            'photopath' => 'nullable|image', // The photo is optional for update
            'description' => 'nullable|string', // Description is optional
            'category_id' => 'nullable|exists:categories,id', // Category ID must exist in categories table
            'buttonaction' => 'nullable|string', // Button action is optional
        ]);

        // Find the banner by ID
        $banner = Banner::findOrFail($id);

        // Check if a new photo was uploaded
        if ($request->hasFile('photopath')) {
            // Store the new uploaded photo
            $photo = $request->file('photopath');
            $photoname = time() . '.' . $photo->extension(); // Generate a unique name for the image
            $photo->move(public_path('images/banners'), $photoname); // Move the image to the specified folder

            // Optionally, delete the old photo if it exists
            $oldPhotoPath = public_path('images/banners') . '/' . $banner->photopath;
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath); // Delete the old photo
            }

            // Add the new photo path to the data array
            $data['photopath'] = $photoname;
        }

        // Update the banner with new data
        $banner->update($data);

        // Redirect to the banner index page with a success message
        return redirect()->route('banner.index')->with('success', 'Banner Updated Successfully');
    }

    // Method to handle deleting a banner
    public function destroy($id)
    {
        $banner = Banner::find($id);
        $photo = public_path('images/banners/' . $banner->photopath);
        if (file_exists($photo)) {
            unlink($photo);
        }
        $banner->delete();
        return redirect()->route('banner.index')->with('success', 'Banner Deleted Successfully');
    }
}
