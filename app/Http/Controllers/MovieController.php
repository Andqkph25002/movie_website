<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_genre;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\Input;

class MovieController extends Controller
{


    public function MovieAll()
    {
        $list = Movie::with('category', 'movie_genre', 'country')->orderBy('id', 'desc')->get();
        $path = public_path() . "/json_file/";
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        File::put($path . 'movie.json', json_encode($list));

        $category = Category::all();

        return view('admin.movie.movie_all', compact('list','category'));
    }
    public function MovieAdd()
    {

        $category  = Category::all();
        $country  = Country::all();
        $genre  = Genre::all();

        return view('admin.movie.movie_add', compact('category', 'country', 'genre'));
    }
    public function MovieStore(Request $request)
    {

        $movie = new Movie();
        $data = $request->all();


        $image = $request->file('image');
        $fileName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save('upload/movie_images/' . $fileName);
        $save_url = 'upload/movie_images/' . $fileName;

        $movie->title = $data['title'];
        $movie->english_title = $data['english_title'];
        $movie->description = $data['description'];
        $movie->slug = $data['slug'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
        $movie->resolution = $data['resolution'];
        $movie->image = $save_url;
        $movie->phim_hot = $data['phim_hot'];
        $movie->phude = $data['phude'];
        $movie->episode = $data['episode'];
        $movie->thoi_luong = $data['thoi_luong'];
        $movie->trailer = $data['trailer'];
        $movie->year = $data['year'];
        $movie->tags = $data['tags'];
        $movie->thuocphim = $data['thuocphim'];
        $movie->genre_id = 1;
        $movie->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->save();
        $movie->movie_genre()->attach($request->genre_id);

        return redirect()->route('movie.index');
    }
    public function MovieEdit($id)
    {
        $category  = Category::all();
        $country  = Country::all();
        $genre  = Genre::all();
        $editMovie = Movie::findOrFail($id);
        $movie = Movie::find($id);
        $movie_genre = $movie->movie_genre;
        return view('admin.movie.movie_edit', compact('editMovie', 'category', 'country', 'genre', 'movie_genre'));
    }
    public function MovieUpdate(Request $request)
    {
        $data = $request->all();
        $movie_id = $request->id;
        $movie = Movie::findOrFail($movie_id);
        $movie->title = $data['title'];
        $movie->english_title = $data['english_title'];
        $movie->description = $data['description'];
        $movie->slug = $data['slug'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
        $movie->resolution = $data['resolution'];
        $movie->thuocphim = $data['thuocphim'];
        // $movie->image = $save_url;
        $movie->episode = $data['episode'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->phude = $data['phude'];

        $movie->thoi_luong = $data['thoi_luong'];
        $movie->trailer = $data['trailer'];
        $movie->year = $data['year'];
        $movie->tags = $data['tags'];
        $movie->created_at = Carbon::now('Asia/Ho_Chi_Minh');


        if ($request->file('image')) {
            $image = $request->file('image');
            $old_image = Movie::findOrFail($movie_id)->image;
            unlink($old_image);
            $fileName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('upload/movie_images/' . $fileName);
            $save_url = 'upload/movie_images/' . $fileName;
            $movie->image = $save_url;
        }
        $movie->save();
        $movie->movie_genre()->sync($data['genre_id']);
        return redirect()->route('movie.index');
    }
    public function MovieDelete($id)
    {
        $old_image = Movie::findOrFail($id)->image;
        unlink($old_image);
        Movie_genre::whereIn('movie_id', [$id])->delete();
        Episode::whereIn('movie_id', [$id])->delete();
        Movie::findOrFail($id)->delete();

        return redirect()->route('movie.index');
    }

    public function UpdateTopView(Request $request)
    {
        $id = $request->id;
        Movie::findOrFail($id)->update([
            'topview' => $request->topview,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        return redirect()->back();
    }
    public function UpdateSeason(Request $request)
    {
        $id = $request->id;
        Movie::findOrFail($id)->update([
            'season' => $request->season,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        return redirect()->back();
    }

    public function Filter_Topview(Request $request)
    {
        $data = $request->all();
        $movie = Movie::where('topview', $data['value'])->orderBy('updated_at', 'desc')->take(10)->get();
        $output = '';
        foreach ($movie as $key => $item) {
            if ($item->resolution == 0) {
                $text = 'HD';
            } else if ($item->resolution == 1) {
                $text = 'SD';
            } else if ($item->resolution == 2) {
                $text = 'HD Cam';
            } else if ($item->resolution == 3) {
                $text = 'Full HD';
            } else if ($item->resolution == 4) {
                $text = 'Trailer';
            }

            $output .= ' <div class="item post-37176">
                <a href="' . url('phim/' . $item->slug) . '" title="' . $item->title . '">
                   <div class="item-link">
                      <img src="' . $item->image . '" class="lazy post-thumb" alt="' . $item->title . '" title="' . $item->title . '" />
                      <span class="is_trailer">' . $text . '</span>
                   </div>
                   <p class="title">' . $item->title . '</p>
                </a>
                <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                <div style="float: left;">
                   <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                   <span style="width: 0%"></span>
                   </span>
                </div>
             </div>';
        }
        echo $output;
    }

    public function Filter_Topview_Default(Request $request)
    {
        $data = $request->all();
        $movie = Movie::where('topview', 0)->orderBy('updated_at', 'desc')->take(10)->get();
        $output = '';
        foreach ($movie as $key => $item) {
            if ($item->resolution == 0) {
                $text = 'HD';
            } else if ($item->resolution == 1) {
                $text = 'SD';
            } else if ($item->resolution == 2) {
                $text = 'HD Cam';
            } else if ($item->resolution == 3) {
                $text = 'Full HD';
            } else if ($item->resolution == 4) {
                $text = 'Trailer';
            }

            $output .= ' <div class="item post-37176">
                <a href="' . url('phim/' . $item->slug) . '" title="' . $item->title . '">
                   <div class="item-link">
                      <img src="' . $item->image . '" class="lazy post-thumb" alt="' . $item->title . '" title="' . $item->title . '" />
                      <span class="is_trailer">' . $text . '</span>
                   </div>
                   <p class="title">' . $item->title . '</p>
                </a>
                <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                <div style="float: left;">
                   <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                   <span style="width: 0%"></span>
                   </span>
                </div>
             </div>';
        }
        echo $output;
    }
}
