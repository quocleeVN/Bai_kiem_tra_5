<x-movie-layout>
    <x-slot name="title">Thể loại: {{$genre->genre_name_vn}}</x-slot>
    <div class="list-movie">
        @foreach($movies as $movie)
        <div class="movie">
            <img src="{{asset('storage/'.$movie->image)}}" alt="{{$movie->movie_name_vn}}" style="width:100%; height:auto;">
            <h5>{{$movie->movie_name_vn}}</h5>
            <p>{{$movie->release_date}}</p>
        </div>
        @endforeach
    </div>
</x-movie-layout>