<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Tag;
use App\Article;
use App\Image;

use Laracasts\Flash\Flash;


class ArticlesController extends Controller
{
    
	public function index(){
		return view('admin.articles.index');
	}


	public function create(){

		$categories = Category::orderBy('name', 'ASC')->lists('name', 'id');
		$tags = Tag::orderBy('name', 'ASC')->lists('name', 'id');

		return view('admin.articles.create')
					->with('categories', $categories)
					->with('tags', $tags);
	}

	public function store(Request $request){

		if($request->file('image')){
			//Manipulacion de imagenes
			$file = $request->file('image');
			$name = substr($file->getClientOriginalName(), 0, -4) . "_" . time() . '_image.' . $file->getClientOriginalExtension();

			$path = base_path() . '/public/images/articles/';

			$file->move($path, $name);
		}

		$article = new Article($request->all());
		$article->user_id = \Auth::user()->id;
		$article->save();

		$article->tags()->sync($request->tags);

		$image = new Image();
		$image->name = $name;
		$image->article_id = $article->id;
		//$image->article()->associate(); 
		$image->save();

		Flash::success('Se ha agregado el articulo '. $article->title . ' de forma satisfactoria.');
		redirect()->route('admin.articles.index');
	}

}
