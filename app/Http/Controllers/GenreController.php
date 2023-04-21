<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function GenreAll()
    {
        $genre = Genre::all();
        return view('admin.genre.genre_all' , compact('genre'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function GenreAdd()
    {
        return view('admin.genre.genre_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function GenreStore(Request $request)
    {
        $data = $request->all();
        $genre = new Genre();
        $genre->title = $data['title'];
        $genre->slug = $data['slug'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->save();
        return redirect()->route('genre.index');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function GenreEdit($id)
    {
        $editGenre = Genre::find($id);
        return view('admin.genre.genre_edit' , compact('editGenre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function GenreUpdate(Request $request)
    {
        $genre_id = $request->id;
        Genre::find($genre_id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'slug' => $request->slug
        ]);
        return redirect()->route('genre.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function GenreDelete($id)
    {
        Genre::find($id)->delete();
        return redirect()->back();
    }
}
