<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use Laracasts\Flash\Flash;
use App\Http\Requests\CategoryRequest;


class CategoriesController extends Controller
{
    
    public function index(){
		$cats = Category::orderBy('id', 'DESC')->paginate(5);

		return view('admin.categories.categories')->with('cats', $cats);
	}

	public function create(){

		return view('admin.categories.create');
	
	}


	public function store(CategoryRequest $request){

		$cat = new Category($request->all());
		$cat->save();

		Flash::success("Se ha registrado una nueva categoría ".$cat->name." de manera exitosa!");
		
		return redirect()->route('admin.categories.index');

	}

	public function destroy($id){
		
		$cat = Category::find($id);
		$nombre = $cat->name;

		$cat->delete();

		Flash::error("La Categoría ".$nombre." ha sido eliminada de manera exitosa!");
		
		return redirect()->route('admin.categories.index');	
	}


	public function edit($id){

		$cat = Category::find($id);
		return view('admin.categories.edit')->with('cat', $cat);

	}

	public function update(CategoryRequest $request, $id)
    {
        $cat = Category::find($id);

        $cat->name = $request->name;
        $cat->save();

        Flash::warning("La Categoría ha sido editada de manera exitosa!");
		
		return redirect()->route('admin.categories.index');

    }


}
