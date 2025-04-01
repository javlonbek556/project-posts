<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
{
    // Validate the request
    $validated = $request->validated();

    // Create a new post
    $post = Post::create([
        'name' => $validated['name'],
        'title' => $validated['title'], // Agar kerak bo‘lsa, 'body' qilib o‘zgartiring
    ]);

    // Check if an image is uploaded
    if ($request->hasFile('image')) {
        $file = $request->file('image'); // Faylni olish
        $fileName = uniqid().'.'.$file->getClientOriginalExtension();
        $filePath = $file->storeAs('images', $fileName, 'public');

        $post->image = $filePath;
        $post->save();
    }

    return redirect()->route('posts.index')->with('success', 'Post created successfully!');
}

       

    /**}
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    
   
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id); // findOrFail() to‘g‘ri ishlaydi
        return view('posts.edit', compact('post')); // O‘zgaruvchi nomi bilan moslik
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
    
        // Faqat kerakli maydonlarni yangilash
        $post->update($request->only(['name', 'title'])); 
    
        // Agar yangi rasm yuklangan bo‘lsa
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid().'.'.$file->getClientOriginalExtension();
            $filePath = $file->storeAs('images', $fileName, 'public');
    
            // Eski rasmni o‘chirish (agar kerak bo‘lsa)
            if ($post->image) {
                \Storage::disk('public')->delete($post->image);
            }
    
            // Yangi rasmni saqlash
            $post->image = $filePath;
            $post->save();
        }
    
        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $post = Post::findOrFail($id);

    // Rasmni ham o‘chirish
    if ($post->image) {
        \Storage::disk('public')->delete($post->image);
    }

    $post->delete();

    return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
}

}
