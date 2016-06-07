<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Practicante;
use App\Article;
use App\Category;
use App\Tag;
use App\User;
use DB;
use Config;

class ApiController extends Controller
{

    public function __construct(){
        
    }

    public function practicantes(Request $request){
        $limit = $request->input('limit') ?: 20;
		$practicantes = Practicante::paginate($limit);
		
        return response()->json($practicantes, 200);    	
    }

    public function byId($id){
    	$practicante = Practicante::find($id);

        if (! $practicante){
            return response()->json(['error' => ['message' => 'Practicante no existe']], 404);
        }

    	return response()->json($practicante, 200);
    }

    public function articlesCat($cat){
    	$articles = Article::where('category_id', $cat)->get();

        if (count($articles) == 0){
            return response()->json(['error' => ['message' => 'No existen articulos en esta Categoría']], 404);
        }

    	return response()->json($articles, 200);
    }
    public function articlesTag($tag){
    	$withTags = DB::table('article_tag')->where('tag_id', $tag)->get(array('article_id'));

    	//Cleaning the array
    	$justTags = array();
    	foreach($withTags as $key => $value){
    		array_push($justTags, $value->article_id);
    	}

    	$articles = Article::whereIn('id', $justTags)->get();

        if (count($articles) == 0){
            return response()->json(['error' => ['message' => 'No existen articulos con esta etiqueta']], 404);
        }

    	return response()->json($articles, 200);
    }

    public function categories(){
    	$categories = Category::all(array('id', 'name'));
    	return response()->json($categories, 200);
    }

    public function tags(){
    	$tags = Tag::all(array('id', 'name'));
    	return response()->json($tags, 200);
    }

    public function users(){
        $users = User::all();
        return response()->json($users, 200);
    }

    public function user($id){
        $user = User::find($id);

        if (! $user){
            return response()->json(['error' => ['message' => 'Usuario no existe']], 404);
        }

        return response()->json($user, 200);
    }

    public function ranks(){
        return response()->json(Config::get('constants.ranks'), 200);
    }

    public function dojos(){
        return response()->json(Config::get('constants.dojos'), 200);
    }
}
