<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController_VA extends Controller
{
    public function detail($id)
    {
        $movie = DB::table('movie')
                    ->where('id', $id)
                    ->first();

        if (!$movie) {
            abort(404);
        }

        return view('movie.detail', compact('movie'));
    }
}