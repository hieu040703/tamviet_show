<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('customers', 'email')->ignore($id),
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('customers', 'phone')->ignore($id),
            ],
            'birthday' => ['nullable', 'date'],
            'address' => ['nullable', 'string', 'max:500'],
            'password' => $id ? ['nullable', 'string', 'min:6', 'confirmed'] : ['required', 'string', 'min:6', 'confirmed'],
            'status' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên khách hàng không được để trống',
            'name.max' => 'Tên quá dài',

            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email quá dài',
            'email.unique' => 'Email đã tồn tại',

            'phone.required' => 'Số điện thoại không được để trống',
            'phone.max' => 'Số điện thoại quá dài',
            'phone.unique' => 'Số điện thoại đã tồn tại',

            'birthday.date' => 'Ngày sinh không hợp lệ',

            'address.max' => 'Địa chỉ quá dài',

            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải từ 6 ký tự trở lên',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => $this->boolean('status'),
        ]);
    }
}
