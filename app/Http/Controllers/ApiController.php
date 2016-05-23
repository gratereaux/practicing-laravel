<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Practicante;
use App\Article;
use App\Category;
use App\Tag;
use DB;

class ApiController extends Controller
{
    public function practicantes(){
		$practicantes = Practicante::all();
		return response()->json($practicantes);    	
    }

    public function byId($id){
    	$practicante = Practicante::find($id);
    	return response()->json($practicante);
    }

    public function articlesCat($cat){
    	$articles = Article::where('category_id', $cat)->get();
    	return response()->json($articles);
    }
    public function articlesTag($tag){
    	$withTags = DB::table('article_tag')->where('tag_id', $tag)->get(array('article_id'));
    	//Cleaning the array
    	$justTags = array();
    	foreach($withTags as $key => $value){
    		array_push($justTags, $value->article_id);
    	}

    	$articles = Article::whereIn('id', $justTags)->get();
    	return response()->json($articles);
    }

    public function categories(){
    	$categories = Category::all(array('id', 'name'));
    	return response()->json($categories);
    }

    public function tags(){
    	$tags = Tag::all(array('id', 'name'));
    	return response()->json($tags);
    }
}
