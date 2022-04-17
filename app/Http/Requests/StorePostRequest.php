<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            
                'title' => ['required', 'min:3','unique:posts'],
                'discription' => ['required', 'min:10'],           
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'title is required ',
            'title.min' => 'title must be at least 3 characters',
            'title.unique' => 'title must be unique',
            'discription.required' => 'description is required',
            'discription.min' => 'description must be at least 10 characters',
        ];
    }
}
