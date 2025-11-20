<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostCatalogueRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $postCatalogue = $this->route('post_catalogue');
        $id = $postCatalogue ? $postCatalogue->id : $this->route('id');

        $canonicalRule = Rule::unique('routers', 'canonical')
            ->where(function ($query) {
                $query->where('module', 'post_catalogue');
            });
        if ($id) {
            $canonicalRule->ignore($id, 'object_id');
        }

        $parentRules = ['nullable', 'integer'];
        if ($id) {
            $parentRules[] = 'not_in:' . $id;
        }

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('post_catalogues', 'name')->ignore($id),
            ],
            'canonical' => ['required', 'string', 'max:255', $canonicalRule],
            'parent_id'   => $parentRules,
            'description' => ['nullable', 'string'],
            'content'     => ['nullable', 'string'],
            'status'      => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'order'       => ['nullable', 'integer', 'min:0'],
            'seo_title'   => ['nullable', 'string', 'max:255'],
            'seo_keyword' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Tên nhóm bài viết không được để trống',
            'name.max'      => 'Văn bản quá dài',
            'name.unique'   => 'Tên nhóm bài viết phải là duy nhất',

            'canonical.required' => 'Đường dẫn không đươc để trống',
            'canonical.unique'   => 'Đường dẫn đã tồn tại',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status'      => $this->boolean('status'),
            'is_featured' => $this->boolean('is_featured'),
            'order'       => $this->input('order', 0),
            'parent_id'   => $this->input('parent_id', 0),
        ]);
    }
}
