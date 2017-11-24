<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameUpdateForm extends FormRequest
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
            'title' => 'required|min:3',
            'platform' => 'required',
            'genre' => 'required',
            'price' => 'required',
            'description' => 'required|min:3',
            'duration' => 'required',
            'release_year' => 'required'
        ];
    }
}
