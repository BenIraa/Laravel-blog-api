<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $post = Blogs::all();
        return response()->json([
            'message' => 'success',
            'blogs' => $post
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # code...
        $this->validate(
            $request,
            [
                'title' => 'required|max:200',
                'description' => 'required|min:10',
                'image' => 'required'
            ]
        );
        $imagePath = $request->image->store('/uploads', 'public');
        $post = $request->user()->blogs()->create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imagePath
            ]
        );

        return response()->json([
            'message' => 'success',
            'blogs' => $post
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Blogs::findOrFail($id);
        return response()->json([
            'message' => 'success',
            'blogs' => $post
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate(
            $request,
            [
                'title' => 'required|max:200',
                'description' => 'required|min:10',
                'image' => 'required'
            ]
        );
        $post = Blogs::findOrFail($id);
        if ($request->hasFile('image')) {
            $imagePath = $request->image->store('/uploads', 'public');
            $post->image = $imagePath;
        }
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
        return response()->json([
            'message' => 'success',
            'blogs' => $post
        ], 200);
        return response()->json([
            'message' => 'success',
            'blog' => $post
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Blogs::findOrFail($id);
        $post->delete();
        return response()->json([
            'message' => 'success',
            'blog' => $post
        ], 200);
        return response()->json([
            'message' => 'success',
            'blog' => $post
        ], 200);
    }
}