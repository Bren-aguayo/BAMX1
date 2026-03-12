<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreregistroRequest extends FormRequest
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
             
        'nombre' => 'required|string|min:2',
        'apellido_p' => 'required|string',
        'apellido_m' => 'required|string',
        'genero' => 'required|string',
        'nac' => 'required|date',
        'ine' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        'domicilio' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        'calle' => 'required|string',
        'colonia' => 'required|string',
        'municipio' => 'required|string',
        'codigop' => 'required|string',
        'certificadom' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        'acuerdo' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        'autorizacion' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        'reglamento' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        'contactoemergencia' => 'required|string',
        'telefonoemergencia' => 'required|string',
        'fechaingreso' => 'required|date',
        'principal' => 'required|exists:areas,id',
        'alternativa_uno' => 'required|exists:areas,id',
        'alternativa_dos' => 'required|exists:areas,id',
        'especiales' => 'required|string',
        'foto' => 'nullable|file|mimes:jpg,jpeg,png',
    
        ];
    }
}
