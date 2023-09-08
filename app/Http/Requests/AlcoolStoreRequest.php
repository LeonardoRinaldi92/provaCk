<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlcoolStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function true()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|max:255|min:3|regex:/^[A-Za-z0-9À-Åà-åÈ-Ëè-ëÌ-Ïì-ïÒ-Öò-öÙ-Üù-üéèà&\-\s]+$/',
            'ABV' => 'required|numeric|between:0,100',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'alcool_categories_id' => 'required|exists:alcool_categories,id',
        ];
    }
}
