<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function home()
    {
        $phimhot = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('updated_at', 'desc')->get();
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
        $phimhot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
        $category = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $country = Country::orderBy('id', 'desc')->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $category_home = Category::with('movie')->orderBy('id', 'desc')->where('status', 1)->get();
        return view('pages.home', compact('category', 'genre', 'country', 'category_home', 'phimhot', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function category($slug)
    {
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
        $phimhot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
        $category = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $country = Country::orderBy('id', 'desc')->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $cate_slug = Category::where('slug', $slug)->first();
        $movie  = Movie::where('category_id', $cate_slug->id)->orderBy('updated_at', 'desc')->paginate(40);
        return view('pages.category', compact('category', 'genre', 'country', 'cate_slug', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function genre($slug)
    {
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
        $phimhot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
        $category = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $country = Country::orderBy('id', 'desc')->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $genre_slug = Genre::where('slug', $slug)->first();
        //Nhiều thể loại
        $movie_genre = Movie_genre::where('genre_id', $genre_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $item) {
            $many_genre[] = $item->movie_id;
        }

        $movie  = Movie::whereIn('id', $many_genre)->orderBy('updated_at', 'desc')->paginate(40);
        return view('pages.genre', compact('category', 'genre', 'country', 'genre_slug', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function country($slug)
    {
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
        $phimhot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
        $category = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $country = Country::orderBy('id', 'desc')->get();

        $genre = Genre::orderBy('id', 'desc')->get();
        $country_slug = Country::where('slug', $slug)->first();
        $movie  = Movie::where('country_id', $country_slug->id)->orderBy('updated_at', 'desc')->paginate(40);
        return view('pages.country', compact('category', 'genre', 'country', 'country_slug', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function movie($slug)
    {
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
        $phimhot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
        $category = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $country = Country::orderBy('id', 'desc')->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre')->where('slug', $slug)->where('status', 1)->first();
        $movie_related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        //Lấy 3 tập gần nhất
        $episode = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'desc')->take(3)->get();
        $episode_tapdau  = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'ASC')->take(1)->first();
        //Lấy tổng tập phim đã thêm
        $episode_current_list = Episode::with('movie')->where('movie_id', $movie->id)->get();
        $episode_current_list_count = $episode_current_list->count();

        return view('pages.movie', compact('category', 'genre', 'country', 'movie', 'movie_related', 'phimhot_sidebar', 'phimhot_trailer', 'episode', 'episode_tapdau', 'episode_current_list_count'));
    }

    public function year($year)
    {
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
        $phimhot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
        $category = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $country = Country::orderBy('id', 'desc')->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $year = $year;
        $movie  = Movie::where('year', $year)->orderBy('updated_at', 'desc')->paginate(40);
        return view('pages.year', compact('category', 'genre', 'country', 'year', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function TagName($tag)
    {
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
        $phimhot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
        $category = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $country = Country::orderBy('id', 'desc')->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $tag = $tag;
        $movie  = Movie::where('tags', 'LIKE', '%' . $tag . '%')->orderBy('updated_at', 'desc')->paginate(40);
        return view('pages.tag', compact('category', 'genre', 'country', 'tag', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
    }

    public function SearchMovie()
    {
        if (isset($_GET['search'])) {
            $search  = $_GET['search'];
            $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
            $phimhot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
            $category = Category::orderBy('id', 'desc')->where('status', 1)->get();
            $country = Country::orderBy('id', 'desc')->get();
            $genre = Genre::orderBy('id', 'desc')->get();

            $movie  = Movie::where('title', 'LIKE', '%' . $search . '%')->orderBy('updated_at', 'desc')->paginate(40);
            return view('pages.search', compact('category', 'genre', 'country', 'search', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
        } else {
            return redirect()->to('/');
        }
    }
    public function watch($slug, $tap)
    {


        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
        $phimhot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();

        $category = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $country = Country::orderBy('id', 'desc')->get();
        $genre = Genre::orderBy('id', 'desc')->get();

        $movie = Movie::with('category', 'genre', 'country', 'movie_genre', 'tapphim')->where('slug', $slug)->where('status', 1)->first();
        if (isset($tap)) {
            $tapphim = $tap;
            $tapphim = substr($tap, 4, 20);
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        } else {
            $tapphim = 1;
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        }
        $movie_related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        // return response()->json($movie->episode);
        return view('pages.watch', compact('category', 'genre', 'country', 'movie', 'phimhot_sidebar', 'phimhot_trailer', 'episode', 'tapphim', 'movie_related'));
    }
    public function episode()
    {
        return view('pages.episode');
    }

    public function FilterMovie()
    {
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();
        $phimhot_trailer = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'desc')->take(10)->get();

        $category = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $country = Country::orderBy('id', 'desc')->get();
        $genre = Genre::orderBy('id', 'desc')->get();

        $sapxep = $_GET['order'];
        $genre_fillter = $_GET['genre'];
        $country_filter = $_GET['country'];
        $year = $_GET['year_locphim'];
        if ($sapxep == '' &&  $genre_fillter == '' && $country_filter == '' && $year == '') {
            return redirect()->back();
        } else {
            $movie = Movie::where('country_id', '=', $country_filter)->orWhere('genre_id', '=', $genre_fillter)->orWhere('year', '=', $year)->orderBy('updated_at', 'desc')->paginate(40);
            return view('pages.filter_movie' ,compact('category', 'genre', 'country', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
        }
    }
}
