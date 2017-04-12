<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class groupRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:group|max:255',
            'description_group' => 'required|max:1000',
            'logo' => 'mimes:png,jpeg,bmp'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vous devez saisir le nom du groupe',
            'description_group.required' => 'Vous devez donner une description à votre groupe, maximum 1000 Caractères',
            'logo.mimes'=>'l\'extention doit être : jpeg, png, ou bmp',
            'name.unique'=>'Un groupe existe déjà avec ce nom'
        ];
    }
}