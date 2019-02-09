<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(){
        return [
            'name' => 'required|min:3|max:100',
            'number' => 'required|numeric',
            'category' => 'required',
            'description' => 'min:3|max:1000'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'O campo Nome é de preenchimento obrigatório!',
            'number.numeric' => "No campo Número, digite apenas números!",
            'number.required' => 'O campo Número é de preenchimento obrigatório!',
        ];
    }
}
