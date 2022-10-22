<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomer extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'dni' => ['required', 'string', 'min:8', 'max:8', 'unique:customers', 'regex:/0-9/i'],
            'name' => 'required|string',
            'lastName' => 'required|string',
            'birthDate' => 'required|date',
            'address' => 'required|string',
            'email' => ['required', 'unique:customers', 'regex:/^.+@.+$/i'],
            'password' => 'required',
            'password_confirmation' => 'required',
        ];
    }
    public function attribute()
    {
        return [
            'name' => 'nombre',
            'lastName' => 'apellido',
            'birthDate' => 'fecha de nacimiento',
            'address' => 'dirección',
            'password' => 'contraseña',
        ];
    }
    public function messages()
    {
        return [
            'dni.required' => 'El DNI es obligatorio',
            'dni.min' => 'El DNI debe ser de 8 dígitos (solo números)',
            'dni.max' => 'El DNI debe ser de 8 dígitos (solo números)',
            'dni.unique' => 'El DNI ya se encuentra registrado',
            'name.required' => 'El nombre es obligatorio',
            'lastName.required' => 'El apellido es obligatorio',
            'birthDate.required' => 'La fecha de nacimiento es obligatoria',
            'address.required' => 'La dirección es obligatoria',
            'email.required' => 'El email ya se encuentra registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password_confirmation.required' => 'Confirme la contraseña',
        ];
    }
}
