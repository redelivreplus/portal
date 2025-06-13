<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    // Converte os checkboxes para booleanos antes da validação
    protected function prepareForValidation()
    {
        $this->merge([
            'show_bio' => $this->has('show_bio'),
            'show_interests' => $this->has('show_interests'),
        ]);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:100|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'birth_date' => 'nullable|date',
            'phone' => 'nullable|string|max:30',
            'whatsapp' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
            'neighborhood' => 'nullable|string|max:150',
            'city' => 'required|string|max:150',
            'state' => 'required|string|size:2',
            'bio' => 'nullable|string',
            'interests' => 'nullable|string',
            'facebook_profile_url' => 'nullable|url',
            'instagram_profile_url' => 'nullable|url',
            'twitter_profile_url' => 'nullable|url',
            'youtube_profile_url' => 'nullable|url',
            'profile_image' => 'nullable|image|max:2048',
            'show_bio' => 'boolean',
            'show_interests' => 'boolean',
        ];
    }
}
