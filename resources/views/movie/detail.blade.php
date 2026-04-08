<x-movie-layout>
    <x-slot name="title">
        {{ $movie->movie_name_vn }}
    </x-slot>

    <div class="p-3" style="background:#f5f5f5; border-radius:5px;">
        <div class="row">

            <!-- ẢNH -->
            <div class="col-md-3">
                <img src="{{ asset('storage/'.$movie->image) }}" 
                     style="width:100%; border-radius:5px;">
            </div>

            <!-- THÔNG TIN -->
            <div class="col-md-9">
                <h4>
                    {{ $movie->movie_name_vn }} 
                    - {{ $movie->movie_name }}
                </h4>

                <p><b>Ngày phát hành:</b> {{ $movie->release_date }}</p>
                <p><b>Quốc gia:</b> {{ $movie->country_name }}</p>
                <p><b>Thời gian:</b> {{ $movie->runtime }} phút</p>
                <p><b>Doanh thu:</b> {{ number_format($movie->revenue) }}</p>

                <p><b>Mô tả:</b></p>
                <p>{{ $movie->overview_vn }}</p>

                @if($movie->trailer)
                    <a href="{{ $movie->trailer }}" target="_blank" 
                       class="btn btn-success">
                        Xem trailer
                    </a>
                @endif
            </div>

        </div>
    </div>
</x-movie-layout>