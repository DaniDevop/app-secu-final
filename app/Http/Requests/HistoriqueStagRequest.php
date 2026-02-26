<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoriqueStagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validatio,n rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array

    {
        return [
            'mention'=>'required',
            'commentaire'=>'required',
            'date_fin'=>'required',
            'affectation_id'=>'required|exists:affection_agents,id',
            "moyenne"=>'nullable|numeric|min:0|max:20'
        ];
    }

    public function messages():array
    {
        return [
        'commentaire.required'=>'Le commentaire est requis dans le formulaire',
            'date_fin.required'=>'Veuillez préciser la fin de stage',
            'affect_id.required'=>'Ce stage est inexsitant',
            'affect_id.exists'=>'Ce stage est inexsitant',
            'mention.required'=>'Veuillez préciser la mention du stage',
             'moyenne.numeric'=>'La moyenne doit être un nombre',
             'moyenne.min'=>'La moyenne doit être au moins 0',
             'moyenne.max'=>'La moyenne ne peut pas dépasser 20'
        ];
    }
}
