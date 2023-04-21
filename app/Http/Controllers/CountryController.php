<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function CountryAll()
    {
        $country = Country::all();
        return view('admin.country.country_all' , compact('country'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function CountryAdd()
    {
        return view('admin.country.country_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function CountryStore(Request $request)
    {
        $data = $request->all();
        $country = new Country();
        $country->title = $data['title'];
        $country->slug = $data['slug'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        $country->save();
        return redirect()->route('country.index');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function CountryEdit($id)
    {
        $editCountry = Country::find($id);
        return view('admin.country.country_edit' , compact('editCountry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function CountryUpdate(Request $request)
    {
        $country_id = $request->id;
        Country::find($country_id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'slug' => $request->slug
        ]);
        return redirect()->route('country.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function CountryDelete($id)
    {
        Country::find($id)->delete();
        return redirect()->back();
    }
}
