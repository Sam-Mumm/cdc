<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CDRequest extends FormRequest
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
            'cd_no' => 'required|integer|min:1'
        ];
    }
}