<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    //
    public function index()
    {
        $movies = DB::table('movie')
            ->where('popularity', '>', 450)
            ->where('vote_average', '>', 7)
            ->orderBy('release_date', 'desc')
            ->limit(12)
            ->get();
        return view("movie.index", compact('movies'));
    }

    public function showByGenre($id)
    {
        $movies = DB::table('movie')
            ->join('movie_genre', 'movie.id', '=', 'movie_genre.id_movie')
            ->where('movie_genre.id_genre', $id)
            ->orderBy('movie.release_date', 'desc')
            ->limit(12)
            ->select('movie.*')
            ->get();
        $genre = DB::table('genre')->where('id', $id)->first();
        return view("movie.genre", compact('movies', 'genre'));
    }
}
