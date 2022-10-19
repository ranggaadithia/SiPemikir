<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostImageController extends Controller
{
    public function store()
    {
        $post = new Post();
        $post->id = 0;
        $post->exists = true;
        $image = $post->addMediaFromRequest('upload')->toMediaCollection('images');

        return response()->json([
            'url' => $image->getUrl()
        ]);
    }
}
