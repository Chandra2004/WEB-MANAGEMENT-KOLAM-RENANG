<?php

namespace TheFramework\Http\Requests;

use TheFramework\App\FormRequest;

/**
 * Request validation untuk UserRequest
 * 
 * Auto-validates when used in controller!
 * No need to call validate() manually.
 * 
 * Usage:
 * public function store(UserRequest $request) {
 *     // Validation already done automatically
 *     // If we reach here, validation passed
 *     Model::create($request->validated());
 * }
 */
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Return false to deny access (403 Forbidden).
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * 
     * Available rules: required, email, min, max, unique, exists,
     * alpha, numeric, confirmed, in, between, mimes, image, etc.
     * 
     * @return array
     */
    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required|string|max:255',
            'no_telepon' => 'required|numeric',
            'email' => 'required|email',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:L,P',
            'password' => ($_SERVER['REQUEST_METHOD'] === 'POST' && str_contains($_SERVER['REQUEST_URI'], 'create')) ? 'required|alpha_num|min:6' : 'nullable|alpha_num|min:6',
            'password_confirm' => 'nullable|same:password',
            'checkbox' => 'required',
            'alamat' => 'nullable|string|max:255',
            'nama_klub' => 'nullable|string|max:255',
            'foto_profil' => 'nullable|image|max:2560',
            'foto_ktp' => 'nullable|image|max:2560',
            'is_active' => 'nullable',
            'uid_role' => 'required'
            // Example: 'email' => 'required|email|unique:users,email',
            // Example: 'password' => 'required|min:8|confirmed',
            // Example: 'age' => 'nullable|numeric|between:13,120',
        ];
    }

    /**
     * Get custom labels for validation error messages.
     * Makes error messages more user-friendly in your language.
     * 
     * @return array
     */
    public function labels(): array
    {
        return [
            'nama_lengkap' => 'nama lengkap',
            'no_telepon' => 'nomor telepon',
            'email' => 'email',
            'tanggal_lahir' => 'tanggal lahir',
            'jenis_kelamin' => 'jenis kelamin',
            'alamat' => 'alamat',
            'password' => 'kata sandi',
            'password_confirm' => 'konfirmasi kata sandi',
            'checkbox' => 'check box',
            'foto_profile' => 'foto profile',
            'foto_ktp' => 'foto ktp',
            'nama_klub' => 'nama klub',
            'is_active' => 'status',
            'uid_role' => 'role'
            // Example: 'email' => 'Alamat Email',
            // Example: 'password' => 'Kata Sandi',
        ];
    }

    /**
     * (OPTIONAL) Override this method to force JSON response on validation errors.
     * Uncomment the code below to always return JSON (useful for API endpoints).
     * 
     * @param array $errors
     * @return void
     */
    // protected function failedValidation(array $errors): void
    // {
    //     \TheFramework\Helpers\Helper::json([
    //         'status' => 'error',
    //         'errors' => $errors,
    //         'input' => $this->all()
    //     ], 422);
    //     exit;
    // }
}