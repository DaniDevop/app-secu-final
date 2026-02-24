<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAgentStagiareRequest extends FormRequest
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
            'name'       => 'required|string|max:255',
        'prenom'     => 'required|string|max:255',
        'tel'        => 'required|unique:agent_stagiares,tel',
        'service_id' => 'required|exists:service_agents,id',
        'grade'      => 'required',
        'matricule'  => 'required|unique:agent_stagiares,matricule'
        ];
    }


    public function messages():array
    {
        return  [
            'name.required'      => 'Le nom de famille est obligatoire.',
            'prenom.required'    => 'Le prénom est obligatoire.',
            'tel.required'       => 'Le numéro de téléphone est requis.',
            'tel.unique'         => 'Ce numéro est déjà utilisé.',
            'matricule.unique'   => 'Ce matricule est déjà enregistré.',
            'service_id.required'=> 'Veuillez affecter un service.',
            'service_id.exists'  => 'Le service sélectionné est invalide.',
        ];
    }
}
