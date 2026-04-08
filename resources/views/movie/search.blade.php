<x-movie-layout>
    <style>
        .search-results {
            margin-bottom: 30px;
        }

        .search-title {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .search-keyword {
            color: #0066cc;
            font-weight: bold;
        }

        .search-count {
            color: #666;
            font-size: 14px;
        }

        .no-results {
            text-align: center;
            padding: 50px 20px;
            color: #666;
        }

        .no-results i {
            font-size: 48px;
            margin-bottom: 20px;
            color: #ccc;
        }

        .movie-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .movie-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            background: white;
        }

        .movie-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .movie-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .movie-info {
            padding: 15px;
        }

        .movie-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
            display: block;
            text-decoration: none;
        }

        .movie-title:hover {
            color: #0066cc;
        }

        .movie-date {
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .movie-rating {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }

        .rating-high {
            background-color: #28a745;
        }

        .rating-low {
            background-color: #dc3545;
        }

        .movie-overview {
            color: #555;
            font-size: 13px;
            line-height: 1.4;
            margin-top: 10px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #0066cc;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>

    <div class="search-results">
        <a href="{{url('/')}}" class="back-link">← Quay lại trang chủ</a>

        <h1 class="search-title">
            Kết quả tìm kiếm cho: <span class="search-keyword">"{{ $keyword }}"</span>
        </h1>

        <div class="search-count">
            Tìm thấy {{ $movies->count() }} bộ phim
        </div>
    </div>

    @if($movies->count() > 0)
    <div class="movie-grid">
        @foreach($movies as $movie)
        <div class="movie-card">
            @if($movie->image)
            <img src="{{asset('storage/'.$movie->image)}}" alt="{{ $movie->movie_name_vn }}" class="movie-image">
            @else
            <div style="width: 100%; height: 300px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; color: #999;">
                <i class="fa fa-image" style="font-size: 48px;"></i>
            </div>
            @endif

            <div class="movie-info">
                <a href="{{url('/detail/'.$movie->id)}}" class="movie-title">{{ $movie->movie_name_vn }}</a>
                <div class="movie-date">{{ \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') }}</div>

                @if($movie->vote_average >= 7)
                <span class="movie-rating rating-high">{{ $movie->vote_average }}</span>
                @else
                <span class="movie-rating rating-low">{{ $movie->vote_average }}</span>
                @endif

                <div class="movie-overview">
                    {{ Str::limit($movie->overview_vn, 100) }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="no-results">
        <i class="fa fa-search"></i>
        <h3>Không tìm thấy kết quả</h3>
        <p>Không có bộ phim nào phù hợp với từ khóa "<strong>{{ $keyword }}</strong>"</p>
        <p>Hãy thử tìm kiếm với từ khóa khác hoặc <a href="{{url('/')}}" style="color: #0066cc;">quay lại trang chủ</a></p>
    </div>
    @endif
</x-movie-layout>