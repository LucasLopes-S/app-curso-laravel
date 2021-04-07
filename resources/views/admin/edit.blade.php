@extends('admin.layouts.app')

@section('title','Atualizar Post')

@section('content')

<h1>Edição de Posts <strong>{{ $post->title }}</strong></h1>

<form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
    @method('put')
    @include('admin._partials.form')
</form>

@endsection
