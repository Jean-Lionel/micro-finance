<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDecouvertRequest extends FormRequest
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
            'montant' => 'required|numeric|min:0',
             'compte_name' => 'required|exists:comptes,name',
             'interet' => 'required|numeric|min:5',
             'periode' => 'required|numeric|min:3',
        ];
    }
}
