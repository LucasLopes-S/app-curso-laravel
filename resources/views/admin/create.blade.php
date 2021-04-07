@extends('admin.layouts.app')

@section('title','Criar Novo Post')

@section('content')

<h1>Cadastro</h1>

<form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
    @include('admin._partials.form')
</form>

@endsection
