<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required|string|min:10|max:20|regex:/^[0-9+\-\s()]*$/',
            'category_id' => 'required|integer|exists:categories,id',
            'hobbies' => 'required|array|min:1',
            'hobbies.*' => 'integer|exists:hobbies,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters',
            'name.max' => 'Name cannot exceed 255 characters',
            'profile_pic.image' => 'Profile picture must be an image',
            'profile_pic.mimes' => 'Profile picture must be jpeg, png, jpg, or gif',
            'profile_pic.max' => 'Profile picture size cannot exceed 2MB',
            'phone.required' => 'Phone number is required',
            'phone.min' => 'Phone number must be at least 10 digits',
            'phone.max' => 'Phone number cannot exceed 20 characters',
            'phone.regex' => 'Phone number format is invalid',
            'category_id.required' => 'Category is required',
            'category_id.exists' => 'Selected category is invalid',
            'hobbies.required' => 'At least one hobby is required',
            'hobbies.min' => 'Please select at least one hobby',
            'hobbies.*.exists' => 'Selected hobby is invalid',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], 422)
        );
    }
}
