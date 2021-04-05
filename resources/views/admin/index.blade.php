[<a href="{{route('posts.create')}}">Criar novo Post</a>]
<hr>
@if (session('message'))
    <div>
        {{session('message')}}
    </div>
@endif
<h3>Listagem de Posts</h3>
@foreach ($posts as $post)
    <p>
        {{ $post->title }}
        [<a href="{{ route("posts.show", $post->id) }}">Ver Mais</a>]
    </p>
@endforeach


