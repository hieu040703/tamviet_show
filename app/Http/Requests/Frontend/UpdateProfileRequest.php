<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('web')->check();
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:50'],
            'birthday' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:1,2,3'],
            'email' => ['nullable', 'email', 'max:191'],
            'avatar' => ['nullable', 'image', 'max:5120'],
        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => 'Họ và tên',
            'birthday' => 'Ngày sinh',
            'gender' => 'Giới tính',
            'email' => 'Email',
            'avatar' => 'Ảnh đại diện',
        ];
    }
}
