<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class MovieController_QN extends Controller
{
    public function search(Request $request)
    {
        $keyword = trim((string) $request->input('keyword', ''));

        $movies = DB::select(
            "select * from movie where movie_name_vn like ?",
            ["%" . $keyword . "%"]
        );

        $genres = DB::select("select * from genre");

        return view('movie.search', [
            'movies' => $movies,
            'keyword' => $keyword,
            'genres' => $genres
        ]);
    }
}