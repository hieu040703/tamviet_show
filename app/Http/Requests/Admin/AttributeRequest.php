<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttributeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('attributes', 'name')
                    ->where(function ($query) {
                        return $query->where(
                            'attribute_catalogue_id',
                            $this->attribute_catalogue_id
                        );
                    })
                    ->ignore($id),
            ],
            'attribute_catalogue_id' => [
                'required',
                'integer',
                'exists:attribute_catalogues,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên thuộc tính không được để trống',
            'name.max' => 'Tên thuộc tính tối đa 255 ký tự',
            'name.unique' => 'Tên thuộc tính đã tồn tại',

            'attribute_catalogue_id.required' => 'Vui lòng chọn nhóm thuộc tính',
            'attribute_catalogue_id.exists' => 'Nhóm thuộc tính không tồn tại',
        ];
    }
}
