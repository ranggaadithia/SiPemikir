<?php

namespace App\Http\Controllers;

use Share;
use App\Models\Post;
use Illuminate\Support\Facades\URL;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;

// OR
use Artesaos\SEOTools\Facades\TwitterCard;

class PostController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('SiPemikir');
        SEOTools::setDescription('Si Pemikir merupakan platform berbagi informasi berbasis website yang dikelola oleh Rangga Adithia &amp; Satrya Pudja. Informasi yang dibagikan akan sangat beragam seperti teknologi, sains tips &amp; trik dan masih banyak yang lain.');
        SEOTools::opengraph()->setUrl(URL::current());
        SEOTools::setCanonical('https://sipemikir.site/');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::jsonLd()->addImage(asset('img/Logo.svg'));

        return view('post.index', [
            'title' => 'Home',
            'posts' => $paginator = Post::with('author')->latest()->paginate(10),
            'page' => $paginator->currentPage()
        ]);
    }

    public function show(Post $post)
    {

        $tags = [];

        foreach ($post->tags as $tag) {
            $tags[] .= $tag->name;
        }


        SEOMeta::addKeyword($tags);
        JsonLdMulti::setTitle($post->title);
        JsonLdMulti::setDescription($post->excerpt);
        JsonLdMulti::setType('Article');
        JsonLdMulti::addImage(asset('storage/' . $post->image));
        if (!JsonLdMulti::isEmpty()) {
            JsonLdMulti::newJsonLd();
            JsonLdMulti::setType('Article');
            JsonLdMulti::setTitle($post->title . env('APP_NAME'));
        }

        OpenGraph::addProperty('locale', 'id');

        OpenGraph::addImage(asset('storage/' . $post->image));

        OpenGraph::setTitle($post->title)
            ->setDescription($post->excerpt)
            ->setType('article')
            ->setArticle([
                'published_time' => $post->created_at,
                'modified_time' => $post->updated_at,
                'author' => $post->author->name,
                'tag' => $tags
            ]);

        $title = $post->title;

        $share = Share::page(url()->current(), $title)
            ->facebook()
            ->twitter()
            ->whatsapp()
            ->telegram()
            ->getRawLinks();

        $suggestions = Post::withAnyTag([$tags])->latest()->get();

        $postSuggestions = $suggestions->whereNotIn('id', $post->id)->take(5)->all();

        return view('post.show', compact('title', 'post', 'share', 'postSuggestions'));
    }

    public function tag($tag)
    {
        $posts = Post::withAnyTag($tag)->latest()->get();
        $title = "Semua Post Dengan Tag $tag";
        return view('post.posts', compact('posts', 'title', 'tag'));
    }
}
