<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');
        $canonicalRule = Rule::unique('routers', 'canonical')
            ->where(function ($query) {
                $query->where('module', 'post_catalogue');
            });

        if ($id) {
            $canonicalRule->ignore($id, 'object_id');
        }
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('brands', 'name')->ignore($id),
            ],
            'canonical' => ['required', 'string', 'max:255', $canonicalRule,],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_keyword' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên thương hiệu không được để trống',
            'name.max' => 'Văn bản quá dài',
            'name.unique' => 'Tên thương hiệu phải là duy nhất',

            'canonical.required' => 'Đường dẫn không đươc để chống',
            'canonical.unique'   => 'Đường dẫn đã tồn tại',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => $this->boolean('status'),
            'is_featured' => $this->boolean('is_featured'),
            'order' => $this->input('order', 0),
        ]);
    }
}
