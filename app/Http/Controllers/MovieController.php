<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class MovieController extends Controller
{
    public function index()
    {
        return Movie::all();
    }

    public function store(Request $request)
    {
        $movie = new Movie();

        $movie->title = $request->input('title');
        $movie->director = $request->input('director');
        $movie->imageUrl = $request->input('imageUrl');
        $movie->duration = $request->input('duration');
        $movie->releaseDate = $request->input('releaseDate');
        $movie->genre = $request->input('genre');

        $movie->save();

        return $movie;
    }

    public function show($id)
    {
        return Movie::find($id);
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);

        $movie->title = $request->input('title');
        $movie->director = $request->input('director');
        $movie->imageUrl = $request->input('imageUrl');
        $movie->duration = $request->input('duration');
        $movie->releaseDate = $request->input('releaseDate');
        $movie->genre = $request->input('genre');

        $movie->save();

        return $movie;
    }

    public function destroy($id)
    {
        $movie = Movie::find($id);

        $movie->delete();

        return response()->json(['success' => 'uspesno obrisano']);
    }

}
