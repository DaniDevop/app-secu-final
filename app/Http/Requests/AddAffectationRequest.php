<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAffectationRequest extends FormRequest
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
            'agent_stagiare_id' => 'required|exists:agent_stagiares,id',
        'ecole_stage_id'    => 'required|exists:ecole_stages,id',
        'date_debut'        => 'required|date',
        'date_fin'          => 'required|date|after:date_debut',
        'type_formations'   => 'required|string|max:255'
        ];
    }

    public function messages():array
    {
        return  [
            'agent_stagiare_id.required' => 'Veuillez sélectionner un agent stagiaire.',
            'agent_stagiare_id.exists'   => 'L’agent sélectionné est invalide.',

            'ecole_stage_id.required'    => 'Veuillez sélectionner une école.',
            'ecole_stage_id.exists'      => 'L’école sélectionnée est invalide.',

            'date_debut.required'        => 'La date de début est obligatoire.',
            'date_debut.date'            => 'La date de début doit être valide.',

            'date_fin.required'          => 'La date de fin est obligatoire.',
            'date_fin.date'              => 'La date de fin doit être valide.',
            'date_fin.after'             => 'La date de fin doit être postérieure à la date de début.',

            'type_formations.required'   => 'Le type de formation est obligatoire.'
        ];
    }
}
