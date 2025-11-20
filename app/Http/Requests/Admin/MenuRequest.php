<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('menus', 'name')->ignore($id),
            ],
            'keyword' => [
                'required',
                'string',
                'max:255',
                Rule::unique('menus', 'keyword')->ignore($id),
            ],
            'status' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên menu không được để trống',
            'name.max' => 'Văn bản quá dài',
            'name.unique' => 'Tên menu phải là duy nhất',

            'keyword.required' => 'từ khóa menu không được để trống',
            'keyword.max' => 'Văn bản quá dài',
            'keyword.unique' => 'từ khóa menu phải là duy nhất',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => $this->boolean('status')
        ]);
    }
}
