<!DOCTYPE html>
<html>

<head>
    <title>{{ $title ?? 'Movie QN' }}</title>
    <link rel="stylesheet" href="{{asset('library/bootstrap.min.css')}}">

    <script src="{{asset('library/jquery.slim.min.js')}}"></script>
    <script src="{{asset('library/popper.min.js')}}"></script>
    <script src="{{asset('library/bootstrap.bundle.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{asset('library/jquery-3.7.1.js')}}"></script>
    <style>
        .list-movie {
            display: grid;
            grid-template-columns: repeat(4, 25%);
        }

        .movie {
            margin: 10px;
            text-align: center;
            border-radius: 5px;
            border: 1px solid #dbdbdb;
            overflow: hidden;
            cursor: pointer;
            background: #fff;
        }

        .movie a {
            color: black;
            text-decoration: none;
        }

        .movie img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .banner {
            width: 100%;
            max-width: 1200px;
            height: 300px;
            background-size: cover;
            background-position: center;
            color: white;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .search-input {
            width: 90%;
            position: relative;
            margin: 20px auto;
        }

        .search-input input {
            width: 100%;
            height: 45px;
            border-radius: 30px;
            border: none;
            padding-left: 20px;
            outline: none;
        }

        .search-btn {
            width: 100px;
            height: 45px;
            color: white;
            background-image: linear-gradient(to right, rgba(30, 213, 169, 1) 0%, rgba(1, 180, 228, 1) 100%);
            border-radius: 30px;
            border: none;
            position: absolute;
            right: 0;
            top: 0;
        }

        .list-group-movie a {
            padding: 12px 20px;
            text-decoration: none;
            color: #ddd;
            display: block;
            border-bottom: 1px solid #333;
        }

        .list-group-movie a:hover {
            background: #e50914;
            color: white;
        }
    </style>
</head>

<body style="background-color: #f4f4f4;">
    <header style='text-align:center; background-color: #000;'>
        <div class='banner' style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url({{ asset('images/banner.jpg') }});">
            <div style="padding:0 20px">
                <h2 style="font-size: 3rem; font-weight: bold;">Welcome.</h2>
                <h3 style="font-size: 1.5rem;">Millions of movies, TV shows and people to discover.</h3>
            </div>
            <div class='search-input'>
                {{-- ĐÃ SỬA: method="get" để khớp với web.php --}}
                <form method="get" action="{{url('/timkiem')}}">
                    <input type="text" name='keyword' placeholder="Nhập tên bộ phim yêu thích để tìm kiếm..." value="{{ request('keyword') }}">
                    <button type="submit" class="search-btn">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </header>

    <main style="max-width:1200px; margin:30px auto;">
        <div class='row'>
            {{-- CỘT TRÁI: THỂ LOẠI --}}
            <div class='col-md-3 pr-0'>
                <div class="card" style="background-color:#222; color:white; border-radius: 10px; overflow: hidden;">
                    <div class="card-header" style="background-color: #333;">
                        <i class="fa fa-film" aria-hidden="true"></i> <b class="ml-2">Thể loại phim</b>
                    </div>
                    <div class="list-group list-group-flush list-group-movie">
                        @foreach($genre as $row)
                            {{-- ĐÃ SỬA: Kiểm tra tên cột trong DB, thường là genre_name --}}
                            <a href="{{url('/theloai/'.$row->id)}}">{{ $row->genre_name_vn ?? $row->genre_name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- CỘT PHẢI: NỘI DUNG --}}
            <div class='col-md-9'>
                {{$slot}}
            </div>
        </div>
    </main>
</body>

</html>