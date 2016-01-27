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
use App\Http\Requests\ArticleRequest;

use DB;
use Laracasts\Flash\Flash;


class ArticlesController extends Controller
{
    
	public function index(Request $request){

		$arts = Article::search($request->title)->orderBy('id', 'DESC')->paginate(5);

		$arts->each(function($arts){
			$arts->category;
			$arts->user;
		});

		return view('admin.articles.index')->with('arts', $arts);
	}


	public function create(){

		$categories = Category::orderBy('name', 'ASC')->lists('name', 'id');
		$tags = Tag::orderBy('name', 'ASC')->lists('name', 'id');

		return view('admin.articles.create')
					->with('categories', $categories)
					->with('tags', $tags);
	}


	public function edit($id){

		$article = Article::find($id);
		$article->category;
		$categories = Category::orderBy('name', 'ASC')->lists('name', 'id');
		$tags = Tag::orderBy('name', 'ASC')->lists('name', 'id');

		$my_tags = $article->tags->lists('id')->ToArray();

		return view('admin.articles.edit')
			->with('categories', $categories)
			->with('article', $article)
			->with('tags', $tags)
			->with('my_tags', $my_tags);

	}


	public function store(ArticleRequest $request){

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
		return redirect()->route('admin.articles.index');


	}

	public function update(Request $request, $id){

		$article = Article::find($id);
		$article->fill($request->all());
		$article->save();

		$article->tags()->sync($request->tags);

		Flash::warning('Se ha editado el articulo '. $article->title .' de manera exitosa.');
		return redirect()->route('admin.articles.index');
	}

	public function destroy($id){
		
		$art = Article::find($id);
		$titulo = $art->title;


		$art->delete();

		DB::table('images')->where('article_id', $id)->delete();
		DB::table('article_tag')->where('article_id', $id)->delete();

		Flash::error("El artículo ".$titulo." ha sido eliminada de manera exitosa!");
		
		return redirect()->route('admin.articles.index');	
	}

}
