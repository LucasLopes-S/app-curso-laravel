@extends('admin.layouts.app')

@section('title','Detalhe do Post')

@section('content')

<h1>Detalhes do Post: {{$post->title}}</h1>

<ul>
    <li> <strong>Titulo: </strong>
        {{$post->title }}
    </li>
    <li>
        <strong>Conteúdo: </strong>
        {{$post->content}}
    </li>
</ul>

<form action="{{ route('posts.destroy', $post->id) }}" method="post">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" name="delete">Deletar o Post: {{$post->title }}</button>
</form>

@endsection
