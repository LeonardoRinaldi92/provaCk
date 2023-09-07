<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AlcoolCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'unique:alcool_categories',
                'max:255',
                'min:3',
                'regex:/^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-]+$/',
            ],
        ];
    }
}

