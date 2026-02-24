<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAgentStagiareRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'prenom'=>'required',
            'tel'=>'required',
            'service_id' => 'required',
            'grade'=>'required',
            'matricule'=>'required',
            'id'=>'required'
        ];
    }

    public function messages():array
    {
        return  [
            'name.required' => 'Le nom de famille est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'tel.required' => 'Le numéro de téléphone est requis.',
            'service_id.required' => 'Veuillez affecter un service.',
             'grade.required' => 'Le grade est requis.',
             'matricule.required' => 'Le matricule est requis.',
             'id.required' => 'ID de l’agent stagiaire est requis.'
        ];
     }
}
