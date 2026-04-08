<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    //
    public function index()
    {
        $movies = DB::table('movie')
            ->where('popularity', '>', 450)
            ->where('vote_average', '>', 7)
            ->where('status', 1)
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
            ->where('movie.status', 1)
            ->orderBy('movie.release_date', 'desc')
            ->limit(12)
            ->select('movie.*')
            ->get();
        $genre = DB::table('genre')->where('id', $id)->first();
        return view("movie.genre", compact('movies', 'genre'));
    }

    public function danhsachphim()
    {
        $movies = DB::table('movie')
            ->where('status', 1)
            ->orderBy('release_date', 'desc')
            ->get();
        return view("movie.list", compact('movies'));
    }

    public function delete($id)
    {
        DB::table('movie')
            ->where('id', $id)
            ->update(['status' => 0]);
        return redirect('/danh-sach-phim')->with('success', 'Đã xóa phim thành công');
    }

    public function create()
    {
        return view('movie.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_name' => 'required|string|max:255',
            'movie_name_vn' => 'required|string|max:255',
            'release_date' => 'required|date',
            'overview_vn' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Upload ảnh
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public');
            $imagePath = str_replace('public/', '', $imagePath);
        }

        // Thêm phim mới vào database
        DB::table('movie')->insert([
            'movie_name' => $request->movie_name,
            'movie_name_vn' => $request->movie_name_vn,
            'release_date' => $request->release_date,
            'overview_vn' => $request->overview_vn,
            'image' => $imagePath,
            'status' => 1,
            'popularity' => 0, // Mặc định
            'vote_average' => 0, // Mặc định
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/danh-sach-phim')->with('success', 'Đã thêm phim mới thành công');
    }

    public function search(Request $request)
    {
        $keyword = $request->get('keyword');

        if (!$keyword) {
            return redirect('/')->with('error', 'Vui lòng nhập từ khóa tìm kiếm');
        }

        $movies = DB::table('movie')
            ->where('status', 1)
            ->where(function ($query) use ($keyword) {
                $query->where('movie_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('movie_name_vn', 'LIKE', '%' . $keyword . '%');
            })
            ->orderBy('release_date', 'desc')
            ->get();

        return view('movie.search', compact('movies', 'keyword'));
    }
}
