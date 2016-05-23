<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArticleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required|unique:articles|min:4|max:250',
            'category_id'   => 'required',
            'content'       => 'required'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'El campo título es requerido',
            'title.min' => 'El campo título debe contener al menos 4 caracteres.',
            'content.required' => 'Debe agrega el texto del contenido para poder crear un artículo.'
        ];
    }
}
