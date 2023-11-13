<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'image'=> 'required|image|mimes:jpeg,png,gif',
            'title'=> 'required|string|max:255',
            'Description'=> 'required|string|max:255',
            'price'=> 'required|max:255',
            'Quantity'=> 'required|max:255',
            'Category'=> 'required|string|max:255',
            'Discount'=> 'required|max:255',

        ];
    }
}
