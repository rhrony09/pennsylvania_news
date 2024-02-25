<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        if (!auth()->check()) {
            $rules['name'] = 'required';
        }
        $rules['comment'] = 'required';
        return $rules;
    }

    public function messages(): array {
        return [
            'name.required' => 'অনুগ্রহ করে আপনার নাম লিখুন',
            'comment.required' => 'অনুগ্রহ করে মন্তব্য লিখুন',
        ];
    }
}
