<?php

namespace TheFramework\App;

use TheFramework\Helpers\Helper;

/**
 * Base Form Request with Auto-Validation
 * 
 * Form requests will automatically validate themselves when instantiated.
 * If validation fails, it will auto-redirect back with errors and old input.
 * 
 * Usage:
 * public function store(CreateUserRequest $request) {
 *     // No need to call validate()!
 *     // If we reach here, validation passed
 *     User::create($request->validated());
 * }
 */
abstract class FormRequest extends Request
{
    protected bool $autoValidate = true;
    protected bool $validated = false;
    protected array $validatedData = [];

    /**
     * Constructor - Auto validate on instantiation
     */
    public function __construct()
    {
        parent::__construct();

        if ($this->autoValidate && !$this->validated) {
            $this->performValidation();
        }
    }

    /**
     * Perform validation automatically
     */
    protected function performValidation(): void
    {
        // Check authorization first
        if (!$this->authorize()) {
            $this->failedAuthorization();
        }

        // Validate
        $validator = new Validator();
        $isValid = $validator->validate(
            $this->all(),
            $this->rules(),
            $this->labels()
        );

        if (!$isValid) {
            $this->failedValidation($validator->errors());
        }

        // Mark as validated
        $this->validated = true;

        // Store validated data
        $this->validatedData = array_intersect_key(
            $this->all(),
            $this->rules()
        );
    }

    /**
     * Handle failed authorization
     */
    protected function failedAuthorization(): void
    {
        Helper::redirect('/403', 'danger', 'Unauthorized access!');
        exit;
    }

    /**
     * Handle failed validation - Smart JSON Detection
     * Otomatis return JSON jika:
     * - AJAX request
     * - Accept: application/json
     * - Content-Type: application/json  
     * - Route dimulai dengan /api/
     * - Controller method return Helper::json() (detected from context)
     * - Debug mode enabled
     */
    protected function failedValidation(array $errors): void
    {
        // 1. Ambil semua input kecuali file (karena file tidak bisa di-old)
        $input = $this->all();
        $oldInput = array_filter($input, function ($value) {
            return !is_array($value) || !isset($value['tmp_name']);
        });

        // 2. Simpan Error & Input (Flash Session)
        Helper::set_flash('validation_errors', $errors);
        Helper::set_flash('old_input', $oldInput);

        // 3. Auto-detect JSON context
        if ($this->wantsJson()) {
            Helper::json([
                'status' => 'error',
                'message' => 'Validation Failed',
                'errors' => $errors,
                'input' => $oldInput
            ], 422);
            exit;
        }

        // 4. Fallback: Redirect Back (Production Web Form)
        $firstKey = array_key_first($errors);
        $firstMsg = is_array($errors[$firstKey]) ? $errors[$firstKey][0] : $errors[$firstKey];

        $redirectMsg = "Gagal Validasi: " . $firstMsg;
        if (count($errors) > 1) {
            $redirectMsg .= " (+" . (count($errors) - 1) . " error lainnya)";
        }

        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        Helper::redirect($referer, 'error', $redirectMsg, 5);
        exit;
    }

    /**
     * Deteksi otomatis apakah request ingin JSON response
     */
    protected function wantsJson(): bool
    {
        // 1. Cek manual flag (jika forceJson dipanggil)
        if ($this->forceJson) {
            return true;
        }

        // 2. AJAX request
        if (Helper::is_ajax()) {
            return true;
        }

        // 3. Accept header minta JSON
        if (isset($_SERVER['HTTP_ACCEPT']) && str_contains($_SERVER['HTTP_ACCEPT'], 'application/json')) {
            return true;
        }

        // 4. Content-Type adalah JSON
        $contentType = $_SERVER['CONTENT_TYPE'] ?? $_SERVER['HTTP_CONTENT_TYPE'] ?? '';
        if (str_contains(strtolower($contentType), 'application/json')) {
            return true;
        }

        // 5. Route pattern API (dimulai dengan /api/)
        $requestUri = $_SERVER['REQUEST_URI'] ?? '';
        $path = parse_url($requestUri, PHP_URL_PATH);
        if (str_starts_with($path, '/api/')) {
            return true;
        }

        // NOTE: Debug mode TIDAK otomatis force JSON
        // Biarkan controller yang tentukan via Helper::json() atau View::render()

        return false;
    }

    /**
     * Get the validated data.
     * Automatically returns validated data after auto-validation.
     */
    public function validated(): array
    {
        return $this->validatedData;
    }

    /**
     * Determine if the user is authorized to make this request.
     * Override this in child classes.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules.
     * Override this in child classes.
     */
    abstract public function rules(): array;

    /**
     * Get custom labels for validation errors.
     * Override this in child classes if needed.
     */
    public function labels(): array
    {
        return [];
    }
}
