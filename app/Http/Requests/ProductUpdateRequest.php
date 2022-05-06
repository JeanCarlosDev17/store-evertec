<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
    public function rules(): array
    {
        return [
            'name'=>'required|min:3|max:150',
            'description'=>'required|min:5|max:255',
            'price'=>'required|integer|min:1|max:750000000000000',
            'quantity'=>'required|integer|min:0|max:16770200',
            'maker'=>'max:100',
            'images' => ['required', 'array'],
            'images.*' => [
                'image',
                'max:2500',
                Rule::dimensions()->maxWidth(600)->maxHeight(600),
                'mimes:jpg,jpeg,png,bmp',
            ],
        ];
    }

    public function attributes(): array
    {
        $files = [];
        $msg = [
            'name'=>'Nombre del producto',
            'description'=>'Descripción',
            'maker'=>'Marca',
            'price'=>'Precio',
            'quantity'=>'Cantidad en Stock',
        ];
        if (isset($this->images) && is_array($this->images)) {
            foreach ($this->images as $key => $val) {
                $files += ['images.' . $key => $val->getClientOriginalName()];
            }
        }
        $msg += $files;
        return $msg;
    }

    public function replace($string)
    {
        $pos = strpos($string, '.');
        $string[$pos] = ' ';
        $string[$pos + 1] = $string[$pos + 1] + 1;
        return str_replace('images', 'imagen #', $string);
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->wantsJson()) {
            $response = response()->json([
                'success' => false,
                'message' => 'Ops! Some errors occurred',
                'errors' => $validator->errors()->all(),
            ], 400);
        } else {
            $response = redirect()
                ->back()
                ->with('message', 'Ops! Some errors occurred')
                ->withErrors($validator)
                ->withInput();
        }

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
