<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingRequest extends FormRequest
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

        $fileRules = $this->isMethod('put') ? 'sometimes|file' : 'required|file';
        $imageRules = $fileRules . '|image|mimes:jpeg,png,jpg|max:2048';
        $videoRules = $fileRules . '|mimes:mp4|max:20480';

        return [
            'title' => 'required|string|max:255',
            'difficulty' => 'required|in:easy,intermediate,hard',
            'video_length' => 'required|numeric',
            'category' => 'required|string|max:255',
            'sub_category' => 'required|string|max:255',
            'number_workouts' => 'required|integer',
            'premium' => 'required|in:yes,no',
            'image' => $imageRules,
            'video' => $videoRules,
        ];
    }
}
