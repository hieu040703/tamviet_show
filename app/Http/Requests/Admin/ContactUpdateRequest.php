<?php

namespace App\Http\Requests\Admin;

use App\Models\ContactRequest;
use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $statusKeys = implode(',', array_keys(ContactRequest::statusList()));

        return [
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'note' => 'nullable|string',
            'status' => 'required|in:' . $statusKeys,
            'save_info' => 'nullable|boolean',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'tên khách hàng',
            'phone' => 'số điện thoại',
            'address' => 'địa chỉ',
            'note' => 'ghi chú',
            'status' => 'trạng thái',
            'save_info' => 'lưu thông tin khách hàng',
        ];
    }
}
