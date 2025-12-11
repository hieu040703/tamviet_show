<?php


namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')->ignore($id),
            ],
            'canonical' => ['required', 'string', 'max:255', $canonicalRule,],
            'code' => ['nullable', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_keyword' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'note' => ['nullable', 'string'],
            'category_ids.*' => 'exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.max' => 'Văn bản quá dài',
            'name.unique' => 'Tên sản phẩm phải là duy nhất',

            'category_id.required' => 'Danh mục không được để trống',
            'category_id.exists' => 'Danh mục không hợp lệ',

            'brand_id.required' => 'Thương hiệu không được để trống',
            'brand_id.exists' => 'Thương hiệu không hợp lệ',

            'quantity.required' => 'Vui lòng nhập số lượng',
            'quantity.integer' => 'Số lượng phải là số nguyên',
            'quantity.min' => 'Số lượng phải lớn hơn 0',

            'canonical.required' => 'Đường dẫn không đươc để trống',
            'canonical.unique' => 'Đường dẫn đã tồn tại',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => $this->boolean('status'),
            'is_featured' => $this->boolean('is_featured'),
            'quantity' => $this->input('quantity', 0),
        ]);
    }
}
