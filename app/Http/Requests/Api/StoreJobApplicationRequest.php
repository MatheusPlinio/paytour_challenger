<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'desired_position' => 'required|string|max:255',
            'education_level' => 'required|string|max:100',
            'observations' => 'nullable',
            'resume_path' => [
                'required',
                'mimes:doc,docx,pdf',
                'max:1048576',
            ],
        ];
    }
}
