<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'excerpt',
        'slug'
    ];
    protected $guarded = [
        'created_at',
        'updated_at',
        'published_at'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false,
            fn($query, $search) => $query->where(fn($query) => $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')));

        $query->when($filters['category'] ?? false,
            fn($query, $category) => $query->whereHas('category',
                fn($query) => $query->where('slug', $category))
        );

        $query->when($filters['author'] ?? false,
            fn($query, $author) => $query->whereExists(fn(Builder $query) => $query
                ->from('users')
                ->where('users.username', $author)
                ->whereColumn('users.id', 'posts.user_id')
            )
        );
    }

    public function comments()
    {

        return $this->hasMany(Comment::class);
    }

}
