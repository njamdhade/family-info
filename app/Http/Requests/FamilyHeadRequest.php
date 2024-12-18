<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FamilyHeadRequest extends FormRequest
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
            'surname' => 'required|string|max:255',
            'birth_date' => 'required|date|before:' . now()->subYears(21)->format('Y-m-d'),
            'mobile_no' => 'required|digits:10|unique:family_heads,mobile_no',
            'address' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'pincode' => 'required|digits:6', 
            'marital_status' => 'required|in:Married,Unmarried',
            'wedding_date' => 'nullable|date|required_if:marital_status,Married',
            'hobbies' => 'nullable|array',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }
}
