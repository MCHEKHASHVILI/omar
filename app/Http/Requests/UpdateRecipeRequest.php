<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:500',
            'difficulty' => 'required|in:easy,intermediate,hard',
            'video_length' => 'required|numeric',
            'category' => 'required|string|max:255',
            'sub_category' => 'required|string|max:255',
            'calories' => 'required|in:yes,no',
            'premium' => 'required|in:yes,no',
            'image' => $this->isMethod('put') ? 'sometimes|file|image|mimes:jpeg,png,jpg|max:2048' : 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'video' => $this->isMethod('put') ? 'sometimes|file|mimes:mp4|max:20480' : 'required|file|mimes:mp4|max:20480',
        ];
    }
}
