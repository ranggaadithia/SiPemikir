<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::check()) {
            return abort(403);
        };

        return view('dashboard.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'slug' => 'required|unique:posts',
            'tags' => 'required',
            'image' => 'image|file|max:25000',
            'body' => 'required',
        ]);

        $validated['excerpt'] = Str::limit(strip_tags($request->body), 100);
        $validated['user_id'] = auth()->user()->id;
        if($request->file('image')) {
            $validated['image'] = $request->file('image')->store('img');
        }
        $validated['published_at'] = now();

        $tags = explode(",", $request->tags);

        $post = Post::create($validated);

        $post->tag($tags);

        return redirect('/dashboard/posts')->with('success', 'Post Has Been Created');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        

        // return $post->tags[4]->name; 
        // $post->tags->count();
        $tags = "";
       
        for($i = 0;$i < $post->tags->count();$i++)
        {
            $tags .= $post->tags[$i]->name . ',';
        }
        return view('dashboard.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
    
        $rules = [
            'title' => 'required|max:255',
            'image' => 'image|file|max:25000',
            'body' => 'required',
        ];

        if($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validated = $request->validate($rules);

        if($request->file('image')) {

            if($post->image) {
                Storage::delete($post->image);
            }

            $validated['image'] = $request->file('image')->store('img');
        }

        $validated['user_id'] = auth()->user()->id;
        $validated['excerpt'] = Str::limit(strip_tags($request->body), 200);


        $tagIds = $request->input('tags');
        $tagNames = explode(",", $tagIds);
        $post->retag($tagNames);

        Post::where('id', $post->id)->update($validated);

        
        return redirect('/dashboard/posts')->with('success', 'Post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->image) {
            Storage::delete($post->image);
        }
        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Post has been deleted');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }
}
