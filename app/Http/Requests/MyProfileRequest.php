<?php

namespace TheFramework\Http\Requests;

use TheFramework\App\FormRequest;

/**
 * Request validation untuk MyProfileRequest
 * 
 * Auto-validates when used in controller!
 * No need to call validate() manually.
 * 
 * Usage:
 * public function store(MyProfileRequest $request) {
 *     // Validation already done automatically
 *     // If we reach here, validation passed
 *     Model::create($request->validated());
 * }
 */
class MyProfileRequest extends FormRequest
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
            'nama_lengkap' => 'required|string|max:100',
            'no_telepon' => 'nullable|numeric|max:15',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'nama_klub' => 'nullable|string|max:100',
            'alamat' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6',
            'foto_profil' => 'nullable|image|max:2560',
            'foto_ktp' => 'nullable|image|max:2560',
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
            'tanggal_lahir' => 'tanggal lahir',
            'jenis_kelamin' => 'jenis kelamin',
            'nama_klub' => 'nama klub',
            'alamat' => 'alamat',
            'password' => 'kata sandi',
            'foto_profile' => 'foto profile',
            'foto_ktp' => 'foto ktp'
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