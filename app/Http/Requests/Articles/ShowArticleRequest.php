<?php

namespace App\Http\Requests\Articles;

use App\DTO\Articles\IndexArticleDTO;
use App\DTO\Articles\ShowArticleDTO;
use Illuminate\Foundation\Http\FormRequest;

class ShowArticleRequest extends FormRequest
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
            'article' => ['integer', 'min:0', 'required', 'exists:articles,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'article' => $this->route('article'),
        ]);
    }

    public function getDTO(): ShowArticleDTO
    {
        return ShowArticleDTO::fromArray($this->validated());
    }
}
