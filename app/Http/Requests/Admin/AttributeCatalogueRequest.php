<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttributeCatalogueRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('id');

        return [
            'name' => [
                'required',
                Rule::unique('attribute_catalogues', 'name')->ignore($id),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên nhóm thuộc tính không được để trống',
            'name.unique'   => 'Tên nhóm thuộc tính đã tồn tại',
        ];
    }
}
