<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'project_title'=>['required', 'min:3', 'max:200', 'unique:projects'],
            'repo_name'=>['required', 'min:3', 'max:200', 'unique:projects'],
            'preview'=>['nullable', 'image', 'max:3072'],
            'repo_link'=>['required', 'url', 'unique:projects'],
            'description'=>['nullable'],
            // dev'essere una delle categorie id disponibili della select
            'category_id'=>['nullable', 'exists:categories,id'],
            'technologies'=>['exists:technologies,id']
        ];
    }

    public function messages() {
        return[
            'project_title.required'=> 'Il campo Titolo del Progetto è obbligatorio',
            'project_title.min'=>'Il campo Titolo del Progetto deve avere almeno :min caratteri',
            'project_title.max'=>'Il campo Titolo del Progetto deve avere un massimo di :max caratteri',
            'project_title.unique'=>'questo Titolo esiste già',
            'repo_name.required'=> 'Il campo Titolo del Progetto è obbligatorio',
            'repo_name.min'=>'Il campo Nome della Repository deve avere almeno :min caratteri',
            'repo_name.max'=>'Il campo Nome della Repository deve avere un massimo di :max caratteri',
            'repo_name.unique'=>'questo Nome esiste già',
            'repo_link.required'=>'Il campo Link alla Repository è obbligatorio',
            'repo_link.url'=>'Inserisci un Url valido',
            'repo_link.unique'=>'questo Link esiste già',
            'preview.image'=>'Il campo Preview deve contenere un file immagine valido',
            'preview.max:3072'=>'Il campo Preview deve contenere un file di dimensioni non superiori ai 3MB',
        ];
    }
}
