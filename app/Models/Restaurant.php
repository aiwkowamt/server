<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeByName(Builder $query, ?string $name): void
    {
        if ($name !== null) {
            $query->where('name', 'like', '%' . $name . '%');
        }
    }

    public function scopeWithAverageRating(Builder $query): void
    {
        $query->leftJoin('orders', 'restaurants.id', '=', 'orders.restaurant_id')
            ->leftJoin('comments', 'orders.comment_id', '=', 'comments.id')
            ->select('restaurants.*',
                DB::raw('AVG(comments.grade) AS average_rating'),
                DB::raw('COUNT(comments.id) AS comments_count'))
            ->groupBy('restaurants.id');
    }

    public function scopeByCategories(Builder $query, ?array $categories): void
    {
        if ($categories !== null && count($categories) > 0) {
            $query->whereHas('dishes', function ($q) use ($categories) {
                $q->whereIn('category_id', $categories);
            });
        }
    }

    public function scopeSortBy(Builder $query, ?string $sortBy): void
    {
        if ($sortBy !== null) {
            switch ($sortBy) {
                case 'rating':
                    $query->orderByDesc('average_rating');
                    break;
                case 'orders_count':
                    $query->withCount('orders')->orderByDesc('comments_count');
                    break;
                default:
                    break;
            }
        }
    }
}
