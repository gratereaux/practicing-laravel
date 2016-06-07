<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Article;
use App\Tag;
use App\Practicante;
use Config;
use DB;

class TecnicasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $usr = Practicante::where('email', '=', $request->user()->email)->get();
        $actual_rank = Tag::where('name', Config::get('constants.ranks')[$usr[0]->actual_rank])->get()[0]->id;

        $withTags = DB::table('article_tag')->where('tag_id', $actual_rank)->get(array('article_id'));

        //Cleaning the array
        $justTags = array();
        foreach($withTags as $key => $value){
            array_push($justTags, $value->article_id);
        }

        $articles = Article::whereIn('id', $justTags)->get();

        return View('practicante.tecnicas.index')->with('articles', $articles)
                                                 ->with('actual_rank', $usr[0]->actual_rank)
                                                 ->with('ranks', Config::get('constants.ranks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
        $article = Article::find($id);
        $image = $article->images()->get();
        if (count($image) > 0){
            $article['image'] = $image[0]->name;    
        }
        return View('practicante.tecnicas.detalle')->with('article', $article);
    }

}
