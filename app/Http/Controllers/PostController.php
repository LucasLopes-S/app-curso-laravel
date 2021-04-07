<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePostRequests;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        $data = request()->all();
        if($request->image->isValid()){
            $nameFile = Str::of($request->title)->slug('-').'.'.$request->image->getClientOriginalExtension();
            $image = $request->image->storeAs('posts',$nameFile);
            $data['image'] = $image;
        }

        Post::create($data);

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
        if(Storage::exists($post->image)){
                Storage::delete($post->image);
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

        if(!$post = Post::find($id)){
            return redirect()->back();
        }

        $data = request()->all();

        if($request->image->isValid()){
            if(Storage::exists($post->image)){
                Storage::delete($post->image);
            }

            $nameFile = Str::of($request->title)->slug('-').'.'.$request->image->getClientOriginalExtension();
            $image = $request->image->storeAs('posts',$nameFile);
            $data['image'] = $image;
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('message', 'Post Alterado com sucesso!');
    }

    public function search(Request $request){
        $filters = $request->except('_token');

        $posts = Post::where('title','LIKE', "%{$request->search}%")
                ->orWhere('content','LIKE',"%{$request->search}%")
                ->paginate();

        return view('admin.index', compact('posts','filters'));
    }
}
