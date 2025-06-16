<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEquipementRequest extends FormRequest
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
            //
            'nom' => 'required|string|max:255',
            'etat' => 'required|in:disponible,usagé,en panne,réparé',
            'marque' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'date_acquisition' => 'required|date',
            'image_path' => 'nullable|image|max:2048', // 
        ];
    }
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de l’équipement est obligatoire.',
            'decription.required' => 'La description est  obligatoire.',
            'etat.required' => 'Veuillez sélectionner un état pour l’équipement.',
            'etat.in' => 'L’état sélectionné est invalide.',
            'categorie_id.required' => 'Veuillez choisir une catégorie.',
            'categorie_id.exists' => 'La catégorie sélectionnée est invalide.',
            'image_path.image' => 'Le fichier doit être une image valide.',
            'image_path.max' => 'L’image ne doit pas dépasser 2 Mo.',
            'date_acquisition.required' => "La date d'aquistion est requis"
        ];
    }
}
