<?php

namespace App\Http\Requests\Comments;

use App\DTO\Articles\IndexArticleDTO;
use App\DTO\Comments\IndexCommentDTO;
use Illuminate\Foundation\Http\FormRequest;

class IndexCommentRequest extends FormRequest
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
            'article' => ['integer', 'min:0', 'required', 'exists:articles,id'],
        ];
    }

    public function getDTO(): IndexCommentDTO
    {
        return IndexCommentDTO::fromArray($this->validated());
    }
}
