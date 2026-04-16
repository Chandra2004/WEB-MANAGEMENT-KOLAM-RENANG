<?php

namespace TheFramework\Http\Requests;

use TheFramework\App\FormRequest;

/**
 * Request validation untuk KontakRequest
 * 
 * Auto-validates when used in controller!
 * No need to call validate() manually.
 * 
 * Usage:
 * public function store(KontakRequest $request) {
 *     // Validation already done automatically
 *     // If we reach here, validation passed
 *     Model::create($request->validated());
 * }
 */
class KontakRequest extends FormRequest
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
            'nama_lengkap' => 'required|min:3|max:30|alpha',
            'email' => 'required|email',
            'subjek' => 'required|min:3',
            'pesan' => 'required|min:3',
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
            'nama_lengkap' => 'Nama Lengkap',
            'email' => 'Alamat Email',
            'subjek' => 'Subjek',
            'pesan' => 'Pesan'
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