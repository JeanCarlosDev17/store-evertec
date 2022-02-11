<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
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
    public function rules():array
    {
        return [
            'name'=>'required|min:3|max:150',
            'description'=>'required|min:5|max:255',
            'price'=>'required|integer|min:1|max:750000000000000',
            'quantity'=>'required|integer|min:0|max:16770200',
            'maker'=>'max:100',
            'images' => ['array'],
            //'images'=> 'image|max:2000|dimensions:min_width=100, max_width=800,min_height=200,max_height=400,ratio=3/2 '
            'images.*' => [
                'image',
                'max:2500',
                Rule::dimensions()->maxWidth(600)->maxHeight(600)->ratio(1),
                'mimes:jpg,jpeg,png,bmp'
            ]
        ];
    }

    public function attributes():array
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
