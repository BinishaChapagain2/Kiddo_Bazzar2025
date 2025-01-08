<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('priority')->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'priority' => 'required|numeric',
            'name' => 'required|string|max:255|unique:categories,name',
            'photopath' => 'required|image',
        ]);

        //store picture
        $photo = $request->file('photopath');
        $photoname = time() . '.' . $photo->extension();
        $photo->move(public_path('images/categories'), $photoname);
        $data['photopath'] = $photoname;
        Category::create($data);
        // return redirect(route('category.index'));
        return redirect()->route('category.index')->with('success', 'Category Created Successfully');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'priority' => 'required|numeric',
            'name' => 'required',
            'photopath' => 'nullable',
        ]);
        $category = Category::find($id);

        $data['photopath'] = $category->photopath;
        if ($request->hasFile('photopath')) {
            //store picture
            $photo = $request->file('photopath');
            $photoname = time() . '.' . $photo->extension();
            $photo->move(public_path('images/categories'), $photoname);
            $data['photopath'] = $photoname;
            //delete old photo
            $oldphoto = public_path('images/categories/' . $category->photopath);
            if (file_exists($oldphoto)) {
                unlink($oldphoto);
            }
        }
        $category->update($data);
        return redirect()->route('category.index')->with('success', 'Category Updated Successfully');
    }

    public function destroy(Request $request)
    {
        $category = Category::find($request->dataid); // or $request->id based on the form name
        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Category not found.');
        }

        $products = Product::where('category_id', $request->dataid)->count();
        if ($products > 0) {
            return redirect()->route('category.index')->with('success', 'Category cannot be deleted, it has products');
        }

        // Check and delete category photo if it exists
        if ($category->photopath) {
            $photo = public_path('images/categories/' . $category->photopath);
            if (file_exists($photo)) {
                unlink($photo);
            }
        }

        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }


    //for bannner link
    // Method to display products by category
    public function showCategoryProducts(Category $category)
    {
        $products = Product::where('category_id', $category->id)
            ->where('status', 'show') // Ensure products are active
            ->latest()
            ->get();

        return view('category.index', compact('category', 'products'));
    }
}
