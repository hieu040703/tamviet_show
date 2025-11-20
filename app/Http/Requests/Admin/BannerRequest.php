<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BannerRequest extends FormRequest
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
                Rule::unique('banners', 'name')->ignore($id),
            ],
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('banners', 'code')->ignore($id),
            ],
            'status' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên banner không được để trống',
            'name.max' => 'Văn bản quá dài',
            'name.unique' => 'Tên banner phải là duy nhất',

            'code.required' => 'Code banner không được để trống',
            'code.max' => 'Văn bản quá dài',
            'code.unique' => 'Code banner phải là duy nhất',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => $this->boolean('status')
        ]);
    }
}
