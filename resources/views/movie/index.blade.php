<x-movie-layout>
    <x-slot name="title">
        Movie
    </x-slot>
    <div class="list-movie">
        @foreach($movies as $movie)
        <a href="{{ url('/detail/'.$movie->id) }}" style="text-decoration: none; color: black;">
            <div class="movie">
                <img src="{{asset('storage/'.$movie->image)}}" alt="{{$movie->movie_name_vn}}" style="width:100%; height:auto;">
                <h5>{{$movie->movie_name_vn}}</h5>
                <p>{{$movie->release_date}}</p>
            </div>
        </a>
        @endforeach
    </div>
</x-movie-layout>