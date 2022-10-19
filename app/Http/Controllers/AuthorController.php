<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use App\Models\Post;
use App\Models\User;

class AuthorController extends Controller
{
    public function index(User $author)
    {


        JsonLdMulti::setTitle($author->name . env('APP_NAME'));
        JsonLdMulti::setDescription($author->bio);
        JsonLdMulti::setType('Profile');
        JsonLdMulti::addImage(asset('storage/' . $author->profile_picture));
        if (!JsonLdMulti::isEmpty()) {
            JsonLdMulti::newJsonLd();
            JsonLdMulti::setType('Profile');
            JsonLdMulti::setTitle($author->name . env('APP_NAME'));
        }

        OpenGraph::addProperty('locale', 'id');
        OpenGraph::addImage(asset('storage/' . $author->profile_picture));
        OpenGraph::setTitle($author->name)
            ->setDescription($author->bio)
            ->setType('Author')
            ->setProfile([
                'first_name' => $author->name,
                'username' => $author->username,
                'gender' => 'male'
            ]);


        return view('post.author', [
            'title' => $author->name,
            'author' => $author,
            'posts' => Post::where('user_id', $author->id)->with('author')->latest()->paginate(20)
        ]);
    }
}
