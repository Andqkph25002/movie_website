<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
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

Route::get('/' , [IndexController::class , 'home'])->name('homepage');

Auth::routes();


Route::controller(DemoController::class)->group(function () {
    Route::get('/about', 'Index')->name('about.page')->middleware('check');
    Route::get('/contact', 'ContactMethod')->name('cotact.page');
});


// Admin All Route 
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');

    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');
});







Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');



Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::get('/danhmuc/{slug}', [IndexController::class, 'category'])->name('category');
Route::get('/the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');
Route::get('/phim/{slug}', [IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}', [IndexController::class, 'watch'])->name('watch');
Route::get('/tap-phim', [IndexController::class, 'episode'])->name('episode');
Route::get('/nam/{year}', [IndexController::class, 'year']);
Route::get('/tag/{tag}', [IndexController::class, 'TagName'])->name('movie.tag');
Route::get('/search', [IndexController::class, 'SearchMovie'])->name('search.movie');
Route::get('/loc-phim'  ,[IndexController::class , 'FilterMovie'])->name('filter.movie');


Route::controller(CategoryController::class)->group(function () {
    Route::get('/category/all', 'CategoryAll')->name('category.index');
    Route::get('/category/add', 'CategoryAdd')->name('category.add');
    Route::post('/category/store', 'CategoryStore')->name('category.store');
    Route::get('/category/edit/{id}', 'CategoryEdit')->name('category.edit');
    Route::post('/category/update', 'CategoryUpdate')->name('category.update');
    Route::get('/category/delete/{id}', 'CategoryDelete')->name('category.delete');
});


Route::controller(GenreController::class)->group(function () {
    Route::get('/genre/all', 'GenreAll')->name('genre.index');
    Route::get('/genre/add', 'GenreAdd')->name('genre.add');
    Route::post('/genre/store', 'GenreStore')->name('genre.store');
    Route::get('/genre/edit/{id}', 'GenreEdit')->name('genre.edit');
    Route::post('/genre/update', 'GenreUpdate')->name('genre.update');
    Route::get('/genre/delete/{id}', 'GenreDelete')->name('genre.delete');
});


Route::controller(CountryController::class)->group(function () {
    Route::get('/country/all', 'CountryAll')->name('country.index');
    Route::get('/country/add', 'CountryAdd')->name('country.add');
    Route::post('/country/store', 'CountryStore')->name('country.store');
    Route::get('/country/edit/{id}', 'CountryEdit')->name('country.edit');
    Route::post('/country/update', 'CountryUpdate')->name('country.update');
    Route::get('/country/delete/{id}', 'CountryDelete')->name('country.delete');
});

Route::controller(MovieController::class)->group(function () {
    Route::get('/movie/all', 'MovieAll')->name('movie.index');
    Route::get('/movie/add', 'MovieAdd')->name('movie.add');
    Route::post('/movie/store', 'MovieStore')->name('movie.store');
    Route::get('/movie/edit/{id}', 'MovieEdit')->name('movie.edit');
    Route::post('/movie/update', 'MovieUpdate')->name('movie.update');
    Route::get('/movie/delete/{id}', 'MovieDelete')->name('movie.delete');


    Route::post('/update/topview' , 'UpdateTopView')->name('update.topview');
    Route::post('/update/season' , 'UpdateSeason')->name('update.season');
    Route::post('/filter-topview-movie' , 'Filter_Topview');
    Route::get('/filter-topview-default' , 'Filter_Topview_Default');
 
});
Route::controller(EpisodeController::class)->group(function () {
    Route::get('/episode/all', 'EpisodeAll')->name('episode.index');
    Route::get('/episode/add', 'EpisodeAdd')->name('episode.add');
    Route::post('/episode/store', 'EpisodeStore')->name('episode.store');
    Route::get('/episode/edit/{id}', 'EpisodeEdit')->name('episode.edit');
    Route::post('/episode/update', 'EpisodeUpdate')->name('episode.update');
    Route::get('/episode/delete/{id}', 'EpisodeDelete')->name('episode.delete');
    Route::get('/select-movie' , 'SelectMovie')->name('select-movie');
});
