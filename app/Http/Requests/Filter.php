<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Filter extends FormRequest
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
            'initialDate'=>'required',
            'finalDate' =>'required|after:initialDate',
        ];
    }

public function messages()
{
    return [
        'initialDate.required'   => 'La fecha inicial es obligatoria',

        'finalDate.required'   => 'La fecha final es obligatoria',
        'finalDate.after' => 'La fecha final debe ser menor',
    ];
}
}
