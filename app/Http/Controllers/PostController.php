<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePostRequests;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $posts = Post::orderBy('id')->paginate();

        return view('admin.index', compact('posts'));
    }

    public function create(){
        return view('admin.create');
    }

    public function store(StoreUpdatePostRequests $request){

        $post = Post::create($request->all());

        return redirect()->route('posts.index');
    }

    public function show($id){
        // $post = Post::where('id', $id)->first(); -- Metodo utilizando o where por pesquisa e retornando a primeira ocorrência
        $post = Post::find($id);
        if(!$post){
            return redirect()->route('posts.index');
        }

        return view('admin.show', compact('post'));
    }

    public function destroy($id){
        $post = Post::find($id);
        if(!$post){
            return redirect()->route('posts.index');
        }
        $post->delete();

        return redirect()->route('posts.index')->with('message', 'Excluido com Sucesso!');
    }

    public function edit($id){
        $post = Post::find($id);
        if(!$post){
            return redirect()->back();
        }

        return view('admin.edit', compact('post'));
    }

    public function update(StoreUpdatePostRequests $request, $id){

        $post = Post::find($id);
        if(!$post){
            return redirect()->back();
        }
        $post->update($request->all());
        return redirect()->route('posts.index')->with('message', 'Post Alterado com sucesso!');
    }

}
