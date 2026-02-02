<?php

namespace App\Http\Requests\Comments;

use App\DTO\Articles\CreateArticleDTO;
use App\DTO\Comments\CreateCommentDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentsRequest extends FormRequest
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
            'article_id' => ['required', 'integer', 'min:0', 'exists:articles,id'],
            'author_name' => ['required', 'string'],
            'content' => ['required', 'string'],
        ];
    }

    public function getDTO(): CreateCommentDTO
    {
        return CreateCommentDTO::fromArray($this->validated());
    }
}
