<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function EpisodeAll()
    {
        $list_episode = Episode::with('movie')->orderBy('id', 'desc')->get();
        //return response()->json($list_episode);
        return view('admin.episode.episode_all', compact('list_episode'));
    }
    public function EpisodeAdd()
    {
        $list_movie = Movie::orderBy('id', 'desc')->get();
        return view('admin.episode.episode_add', compact('list_movie'));
    }
    public function EpisodeStore(Request $request)
    {
        $data = $request->all();
        $episode_check = Episode::where('episode', $data['episode'])->where('movie_id', $data['movie_id'])->count();
        if ($episode_check > 0) {
            return redirect()->back();
        } else {
            $episode = new Episode();
            $episode->movie_id = $data['movie_id'];
            $episode->linkphim = $data['linkphim'];
            $episode->episode = $data['episode'];
            $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $episode->save();
        }
        return redirect()->route('episode.index');
    }
    public function EpisodeEdit($id)
    {

        $list_movie = Movie::orderBy('id', 'desc')->get();
        $episode = Episode::find($id);

        return view('admin.episode.episode_edit', compact('list_movie', 'episode'));
    }
    public function EpisodeUpdate(Request $request)
    {
        $data = $request->all();
        $episode = Episode::find($request->id);
        $episode->movie_id = $data['movie_id'];
        $episode->linkphim = $data['linkphim'];
        $episode->episode = $data['episode'];
        $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->save();
        return redirect()->route('episode.index');
    }
    public function EpisodeDelete($id)
    {
        $episode = Episode::find($id)->delete();

        return redirect()->back();
    }

    public function SelectMovie()
    {
        $id = $_GET['id_phim'];
        $movie = Movie::find($id);
        $output = '<option value="">Chọn tập phim</option>';
        if ($movie->thuocphim == 'phimbo') {
            for ($i = 1; $i <= $movie->episode; $i++) {
                $output .= '<option value="' . $i . '">' . $i . '</option>';
            }
        } else {
            $output .= '<option value="FullHD">Full HD</option> <option value="HD">HD</option>';
        }
        echo $output;
    }
}
