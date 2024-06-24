<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', Rule::unique('users')->ignore($this->user(), ),],
            'bio' => ['nullable'],
            'image' => 'image',
            'name' => 'required',
            'email' => ['required ', 'email'],
            'password' => ['min:8', 'nullable', 'confirmed'],
        ];
    }
}
