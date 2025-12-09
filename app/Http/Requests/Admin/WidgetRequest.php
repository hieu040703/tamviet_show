<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WidgetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('widget') ?? $this->route('id');

        return [
            'name' => ['required', 'string', 'max:191'],
            'keyword' => [
                'required',
                'string',
                'max:191',
                Rule::unique('widgets', 'keyword')->ignore($id),
            ],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
            'album' => ['nullable', 'string'],
            'model' => ['nullable', 'string'],
            'model_id' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên widget không được để trống',
            'name.max' => 'Tên widget quá dài (tối đa 191 ký tự)',

            'keyword.required' => 'Từ khóa không được để trống',
            'keyword.max' => 'Từ khóa quá dài (tối đa 191 ký tự)',
            'keyword.unique' => 'Từ khóa phải là duy nhất',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => $this->boolean('status'),
            'sort_order' => $this->input('sort_order', 0),
        ]);
    }
}
