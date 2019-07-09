<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Validation\Rule;


class MovieController extends Controller
{
    public function index(Request $request)
    {
        $title = request()->input('title');
        $skip = request()->input('skip', 0);
        $take = request()->input('take', Movie::get()->count());

        if ($title) {
            return Movie::filter($title, $skip, $take);
        } else {
            return Movie::skip($skip)->take($take)->get();
        }
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => [
                'required', 
              Rule::unique('movies')
                  ->where('releaseDate', request('releaseDate'))
            ],  
            'director' => 'required',
            'duration' => 'required|integer|between:1,500',
            'releaseDate' => 'required',
            'imageUrl' => 'URL',
            ]);

            $movie = new Movie();
    }

    public function show($id)
    {
        return Movie::find($id);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => [
            'required', 
                Rule::unique('movies')
                    ->where('releaseDate', request('releaseDate'))->ignore($request->id) 
                ],  
            'director' => 'required',
            'duration' => 'required|integer|between:1,500',
            'releaseDate' => 'required',
            'imageUrl' => 'URL',
            ]);
    }

    public function destroy($id)
    {
        $movie = Movie::find($id);

        $movie->delete();

        return response()->json(['success' => 'uspesno obrisano']);
    }

}
