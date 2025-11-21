<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nama_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => 'required|accepted', // Validasi checkbox terms
        ];
    }

    public function messages()
    {
        return [
            'nama_user.required' => 'Nama lengkap harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'terms.required' => 'Anda harus menyetujui Syarat & Ketentuan.',
            'terms.accepted' => 'Anda harus menyetujui Syarat & Ketentuan.',
        ];
    }
}