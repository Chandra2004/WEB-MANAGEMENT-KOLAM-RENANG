<?php

namespace TheFramework\Http\Requests\Testing;

use TheFramework\App\FormRequest;

/**
 * Request validation untuk AllTestingRequest
 * 
 * Auto-validates when used in controller!
 * No need to call validate() manually.
 * 
 * Usage:
 * public function store(AllTestingRequest $request) {
 *     // Validation already done automatically
 *     // If we reach here, validation passed
 *     Model::create($request->validated());
 * }
 */
class AllTestingRequest extends FormRequest
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
            'foto_profil' => 'nullable|image|max:1024'
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
            'foto_profil' => 'Foto Profil'
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