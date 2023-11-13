<?php declare(strict_types=1);

use App\Http\Controllers\HirotoController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CampanyController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OAuth\CallbackFromProviderController;
use App\Http\Controllers\OAuth\RedirectToProviderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('a', [HirotoController::class, 'maro']);

Route::get('/campanies', [CampanyController::class, 'index']);
Route::get('/campany', [CampanyController::class, 'new']);
Route::post('/campany/create', [CampanyController::class,'create']);
Route::get('/campany/{campany_id}', [CampanyController::class, 'show']);
Route::get('/campany/{campany_id}/edit', [CampanyController::class, 'edit']);
Route::patch('/campany/{campany_id}', [CampanyController::class, 'update']);
Route::delete('/campany/{campany_id}', [CampanyController::class, 'destroy']);

Route::get('/oauth/{provider}/redirect', RedirectToProviderController::class)->name('oauth.redirect');
Route::get('/oauth/{provider}/callback', CallbackFromProviderController::class)->name('oauth.callback');
Route::get('/post/myProfile', [PostController::class, 'myProfile'])->name('post.myProfile');
Route::get('/post/{user}/yourProfile', [PostController::class, 'yourProfile'])->name('post.yourProfile');
Route::get('/post/search', [PostController::class, 'search'])->name('post.search');
Route::post('post/comment/store', [CommentController::class, 'store'])->name('comment.store');
Route::get('post/mypost', [PostController::class, 'mypost'])->name('post.mypost');
Route::get('post/mycomment', [PostController::class, 'mycomment'])->name('post.mycomment');
Route::get('/post/info', [PostController::class, 'info'])->name('post.info');
Route::get('/post/report', [PostController::class, 'report'])->name('post.report');

Route::post('/favorites/{post}', [FavoriteController::class, 'store'])->name('favorites.store');
Route::delete('/favorites/{post}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
Route::get('/post/favorites', [FavoriteController::class, 'index'])->name('favorites.index');

Route::get('/post/hashtags/{hashtag}', [PostController::class, 'filterByHashtag'])->name('post.hashtag');

Route::resource('post', PostController::class);

Route::controller(ContactController::class)->group(function(){
    Route::get('contact/create/{post}', 'create')->name('contact.create');
    Route::post('contact/store', 'store')->name('contact.store');
});

Route::get('/', function () {
    return view('welcome');
})->name('top');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('profile/index', [ProfileController::class, 'index'])->name('profile.index');
});
require __DIR__.'/auth.php';
