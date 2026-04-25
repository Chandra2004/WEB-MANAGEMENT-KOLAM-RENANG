<?php

namespace TheFramework\Http\Requests;
use TheFramework\App\FormRequest;

class GalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Return false to deny access (403 Forbidden).
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uid_event' => 'required|string',
            'foto_event' => 'required', // Validation moved to controller for multiple support
        ];
    }

    public function labels(): array
    {
        return []; // Labels can be empty if messages are already descriptive
    }
}
