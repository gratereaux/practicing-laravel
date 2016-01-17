<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;
use Laracasts\Flash\Flash;
use App\Http\Requests\TagRequest;

class TagsController extends Controller
{
    public function index(Request $request){

        $tags = Tag::search($request->name)->orderBy('id', 'DESC')->paginate(5);
    	return view('admin.tags.tags')->with('tags', $tags);

    }

    public function create(){
    	return view('admin.tags.create');
    }

    public function store(TagRequest $request){
    	$tag = new Tag($request->all());
		$tag->save();

		Flash::success("Se ha agregado el tag ".$tag->name." de manera exitosa!");
		
		return redirect()->route('admin.tags.index');
    }

    public function destroy($id){
    	$tag = Tag::find($id);
    	$nombre = $tag->name;

		$tag->delete();

		Flash::error("El Tag ".$nombre." ha sido eliminado de manera exitosa!");
		
		return redirect()->route('admin.tags.index');	

    }

    public function edit($id){

    	$tag = Tag::find($id);
		return view('admin.tags.edit')->with('tag', $tag);
    }

    public function update(TagRequest $request, $id){
    	$tag = Tag::find($id);

        $tag->name = $request->name;
        $tag->save();

        Flash::warning("El Tag ha sido editado de manera exitosa!");
		
		return redirect()->route('admin.tags.index');
    }
}
