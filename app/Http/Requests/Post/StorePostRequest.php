<?php

namespace App\Http\Requests\Post;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'unique:posts'],
            'author_id' => ['required', 'numeric'],
            'category_id' => ['required', 'numeric'],
            'slug' => ['required', 'string', 'unique:posts'],
            'body' => ['required', 'min:50']
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => 'category',
            'body' => 'content'
        ];
    }
}
