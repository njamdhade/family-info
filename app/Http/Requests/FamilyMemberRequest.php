<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FamilyMemberRequest extends FormRequest
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
            'm_birth_date' => 'required|date',
            'marital_status' => 'required|in:Married,Unmarried',
            'wedding_date' => 'nullable|date|required_if:marital_status,Married',
            'education' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }
}
