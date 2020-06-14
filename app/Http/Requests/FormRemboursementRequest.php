<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRemboursementRequest extends FormRequest
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
             'date_remboursement' => 'required|date',
             
        ];
    }
}
