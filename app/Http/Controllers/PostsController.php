<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $subsubcategories = Subsubcategory::all();

        return view('posts.create', compact('categories', 'subcategories', 'subsubcategories'));
    }

    public function review(Request $request)
    {
        // Retrieve the form data from the request
        $data = $request->all();

        // Return the review.blade view with the form data
        return view('posts.review', compact('data'));
    }


    public function store(StorePostRequest $request)
    {

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->price = $request->price;
        $post->category_id = $request->category_id;
        $post->subcategory_id = $request->subcategory_id;
        $post->subsubcategory_id = $request->subsubcategory_id;
        $post->user_id = Auth::id();
        $post->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $post->addMedia($image)->toMediaCollection('images');
            }
        }

        return redirect()->route('post.show', $post->id);
    }
}
