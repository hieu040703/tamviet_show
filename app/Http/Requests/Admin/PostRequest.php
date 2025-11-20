<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
            'description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'album' => ['nullable'],
            'status' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_keyword' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'post_catalogue_id' => ['required', 'integer', 'exists:post_catalogues,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên bài viết không được để trống',
            'name.max' => 'Văn bản quá dài',
            'name.unique' => 'Tên bài viết phải là duy nhất',

            'post_catalogue_id.required' => 'nhóm bài viết không được để trống',
            'post_catalogue_id.exists' => 'nhóm bài viết không hợp lệ',

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
