<?php

namespace App\Http\Requests;

use App\Rules\YoutubeValidLink;
use Illuminate\Foundation\Http\FormRequest;

class VideoGalleryStoreRequest extends FormRequest {
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
        return [
            'title' => 'required',
            'video_link' => ['required', 'string', new YoutubeValidLink],
            'thumbnail' => 'required|mimes:jpg,jpeg,png',
        ];
    }
}
