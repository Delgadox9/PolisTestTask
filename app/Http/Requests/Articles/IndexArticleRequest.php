<?php

namespace App\Http\Requests\Articles;

use App\DTO\Articles\IndexArticleDTO;
use Illuminate\Foundation\Http\FormRequest;

class IndexArticleRequest extends FormRequest
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
            'page' => 'integer|required',
        ];
    }

    public function getDTO(): IndexArticleDto
    {
        return IndexArticleDto::fromArray($this->validated());
    }
}
