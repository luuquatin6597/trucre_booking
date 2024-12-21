<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConferenceRoom extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Để true nếu không cần kiểm tra quyền
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
{
    return [
        'username' => 'required|string|max:255|unique:users,username',
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'dayofBirth' => 'required|date|before:'.now()->subYears(16)->toDateString(),
        'gender' => 'required|in:male,female',
        'password' => 'required|string|min:6|confirmed',
        'email' => 'required|email|max:255|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
        'phone' => 'required|regex:/^\d{10,11}$/',
        'photo' => 'nullable|image|max:2048',
        'address' => 'required|string|max:500',
        'country' => 'required|string|max:255',
        'role' => 'required|in:admin,user,manager',
        'point' => 'nullable|integer|min:0',
        'status' => 'required|in:active,inactive,banned',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'nullable|date',
        'updated_at' => 'nullable|date',
        'email_verified_at' => 'nullable|date',
    ];
}
public function messages(): array
{
    return [
        'username.required' => 'Username không được để trống.',
        'username.unique' => 'Username này đã tồn tại.',
        'firstName.required' => 'FirstName không được để trống.',
        'lastName.required' => 'LastName không được để trống.',
        'dayofBirth.required' => 'Ngày sinh là bắt buộc.',
        'dayofBirth.date' => 'Ngày sinh phải là định dạng ngày hợp lệ.',
        'dayofBirth.before' => 'Bạn phải đủ 16 tuổi để đăng ký.',
        'gender.required' => 'Giới tính là bắt buộc.',
        'password.required' => 'Mật khẩu là bắt buộc.',
        'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        'email.required' => 'Email không được để trống.',
        'email.unique' => 'Email này đã tồn tại.',
        'email.regex' => 'Email phải có đuôi @gmail.com.',
        'phone.required' => 'Số điện thoại là bắt buộc.',
        'phone.regex' => 'Số điện thoại phải là 10 hoặc 11 số.',
        'photo.image' => 'Photo phải là file ảnh.',
        'photo.max' => 'Photo không được lớn hơn 2MB.',
        'address.required' => 'Địa chỉ là bắt buộc.',
        'country.required' => 'Quốc gia là bắt buộc.',
        'role.required' => 'Vai trò là bắt buộc.',
        'status.required' => 'Trạng thái là bắt buộc.',
        'point.integer' => 'Điểm phải là số nguyên.',
        'point.min' => 'Điểm không được nhỏ hơn 0.',
        'remember_token.string' => 'Token phải là chuỗi ký tự.',
        'created_at.date' => 'Ngày tạo phải là định dạng ngày hợp lệ.',
        'updated_at.date' => 'Ngày cập nhật phải là định dạng ngày hợp lệ.',
        'email_verified_at.date' => 'Ngày xác minh email phải là định dạng ngày hợp lệ.',
    ];
}
}
