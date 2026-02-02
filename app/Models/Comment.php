<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $article_id
 * @property string $author_name
 * @property string $content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Comment extends Model
{
    use HasFactory;

    /** @use HasFactory<\Database\Factories\CommentFactory> */
    protected $fillable = [
        'article_id',
        'author_name',
        'content',
    ];

    protected $casts = [
        'article_id' => 'integer',
    ];

    public function article(): belongsTo
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }
}
