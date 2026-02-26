<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAffectationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'agent_stagiare_id'=>'required',
           'ecole_stage_id'=>'required',
           'date_debut'=>'required',
            'date_fin'=>'required',
            'type_formations'=>'required',
            'affectation_id'=>'required',
           
        ];
    }

     public function messages():array
     {
         return  [
             'agent_stagiare_id.required'=>'Veuillez sélectionner un agent stagiaire.',
             'ecole_stage_id.required'=>'Veuillez sélectionner une école.',
             'date_debut.required'=>'La date de début est obligatoire.',
             'date_fin.required'=>'La date de fin est obligatoire.',
             'type_formations.required'=>'Le type de formation est obligatoire.',
             'affectation_id.required'=>'Affectation introuvable.',
        
         ];
     }
}
