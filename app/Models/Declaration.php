<?php

namespace App\Models;

use App\Enums\DeclarationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Declaration extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $casts = [
        'status' => DeclarationStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
