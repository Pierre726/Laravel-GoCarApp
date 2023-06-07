<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name"=>['required', 'string'],
            "email"=>['required', 'email'],
            "adress"=>['required', 'string'],
            "country"=>['required', 'string'],
            "code_postal"=>['required', 'string', 'min:5', 'max:5'],
            "telephone"=>['required', 'string', 'min:8', 'max:8'],
            "carte_grise"=>[ 'string', 'nullable'],
            "num_permis"=>[ 'string', 'nullable'],
            "date_emission_permis"=>[ 'date', 'nullable'],
            "date_expiration_permis"=>[ 'date', 'nullable'],
            "photo_permis"=>[ 'binary', 'nullable'],
            "num_identite"=>[ 'string', 'nullable'],
            "date_emission_identite"=>[ 'date', 'nullable'],
            "date_expiration_identite"=>[ 'date', 'nullable'],
            "photo_identite"=>[ 'binary', 'nullable'],
            "annee_experience_conducteur"=>[ 'string', 'nullable'],
        ];
    }
}
