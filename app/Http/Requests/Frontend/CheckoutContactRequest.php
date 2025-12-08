<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutContactRequest extends FormRequest
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
        return [
            'note' => 'nullable|string|max:150',
            'name' => 'required|string|max:191',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:300',
            'save_info' => 'nullable|boolean',
            'customer_id' => ['nullable', 'integer', 'exists:customers,id'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập họ và tên.',
            'name.string' => 'Họ và tên không hợp lệ.',
            'name.max' => 'Họ và tên không được vượt quá 191 ký tự.',

            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.string' => 'Số điện thoại không hợp lệ.',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',

            'address.required' => 'Vui lòng nhập địa chỉ nhận hàng.',
            'address.string' => 'Địa chỉ không hợp lệ.',
            'address.max' => 'Địa chỉ không được vượt quá 300 ký tự.',

            'note.string' => 'Ghi chú không hợp lệ.',
            'note.max' => 'Ghi chú không được vượt quá 150 ký tự.',
        ];
    }
}
