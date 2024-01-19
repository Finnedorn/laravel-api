<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name'=> ['required', 'min:3', 'max:200', 'unique:categories']
        ];
    }

    public function messages() {
        return [
            'name.required'=> 'Il campo Nome della Categoria è obbligatorio',
            'name.min'=>'Il campo Nome della Categoria deve avere almeno :min caratteri',
            'name.max'=>'Il campo Nome della Categoria deve avere un massimo di :max caratteri',
            'name.unique'=>'Inserisci un campo differente',
        ];
    }
}
