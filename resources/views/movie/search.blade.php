<x-movie-layout>
   
    {{-- Thêm dòng này để truyền giá trị cho biến $title --}}
    <x-slot name="title">Kết quả tìm kiếm phim</x-slot>


    <div style="padding: 20px;">
       

        {{-- Requirement: Sử dụng class list-movie [cite: 11] --}}
        <div class='list-movie'>
            @if(count($movies) > 0)
                @foreach($movies as $mv)
                {{-- Requirement: Sử dụng class movie [cite: 11] --}}
                <div class='movie'>
                    {{-- Requirement: Sử dụng dữ liệu tại cột image và lưu tại storage/app/public [cite: 3, 12] --}}
                    <img src="{{ asset('storage/' . $mv->image) }}" alt="{{ $mv->movie_name_vn }}">
                    
                    {{-- Requirement: Sử dụng class movie-info [cite: 11] --}}
                    <div class="movie-info">
                        {{-- Requirement: Hiển thị tên bộ phim và ngày phát hành [cite: 7] --}}
                        <b>{{ $mv->movie_name_vn }}</b><br />
                        <small class="text-muted">{{ $mv->release_date }}</small>
                    </div>
                </div>
                @endforeach
            @else
                <p>Không tìm thấy bộ phim nào phù hợp với từ khóa.</p>
            @endif
        </div>
    </div>
</x-movie-layout>


<style>
    .search-title {
        margin-bottom: 20px;
        color: #111;
        font-weight: 700;
    }

    .list-movie {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
    }

    .movie {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
    }

    .movie:hover {
        transform: translateY(-4px);
    }

    .movie img {
        width: 100%;
        height: 270px;
        object-fit: cover;
        display: block;
    }

    .movie-info {
        padding: 10px;
        min-height: 78px;
        line-height: 1.35;
    }

    @media (max-width: 992px) {
        .list-movie {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 576px) {
        .list-movie {
            grid-template-columns: 1fr;
        }
    }
</style>