<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name'=>'required|min:3|max:150',
            'description'=>'required|min:5|max:255',
            'price'=>'required|integer|min:1|max:750000000000000',
            'quantity'=>'required|integer|min:0|max:16770200',
            'maker'=>'max:100'
//            'image'=> 'image|max:2000|dimensions:min_width=100, max_width=800,min_height=200,max_height=400,ratio=3/2 '
        ];
    }

    public function attributes()
    {
        return [
            'name'=>'Nombre del producto',
            'description'=>'Descripción',
            'maker'=>'Marca',
            'price'=>'Precio',
            'quantity'=>'Cantidad en Stock'
        ];
    }
}
