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
            'name' => 'required|unique:group|max:22|min:5',
            'description_group' => 'required|max:1000|min:10',
            'logo' => 'mimes:png,jpeg,bmp'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vous devez saisir le nom du groupe',
            'name.max'=>'Le nom du groupe doit avoir maximum 22 caractères',
            'name.min'=>'le nom du groupe doit avoir minimum 5 caractères',
            'description_group.min'=>'la description doit être au moins 10 caractères',
            'description_group.required' => 'Le champ description est obligatoire',
            'logo.mimes'=>'l\'extention doit être : jpeg, png, ou bmp',
            'name.unique'=>'Un groupe existe déjà avec ce nom'
        ];
    }
}