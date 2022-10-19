<?php

use App\Models\Post;
use App\Models\User;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\SosmedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\DashboardPostController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::domain('{author:username}.' . env('APP_DOMAIN'))->group(function () {
  Route::get('/', [AuthorController::class, 'index']);
});

Route::get('/', [PostController::class, 'index']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('post.show');
Route::get('tag/{tag:slug}', [PostController::class, 'tag'])->name('tag');
Route::get('/profile/{author:username}', [AuthorController::class, 'index'])->name('profile');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::middleware('auth')->group(function () {
  Route::get('/dashboard', function () {
    return redirect('/dashboard/posts');
  });
  Route::get('/dashboard/posts/checkSlug', [DashboardController::class, 'checkSlug']);
  Route::resource('/dashboard/posts', DashboardController::class);
  Route::resource('/dashboard/users', UserController::class)->only(['edit', 'update']);
  Route::post('images', [PostImageController::class, 'store'])->name('images.store');
});

Route::get('generate', function () {
  Artisan::call('storage:link');
  echo 'ok';
});

Route::get('/sitemap', function () {
  return public_path();
  $sitemap = Sitemap::create();

  $post = Post::all();
  foreach ($post as $post) {
    $sitemap->add(Url::create("/post/{$post->slug}"));
  }
  $sitemap->writeToFile(public_path('sitemap.xml'));
});
