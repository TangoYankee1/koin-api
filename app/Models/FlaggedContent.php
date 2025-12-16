<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlaggedContent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content_id',
        'content_type',
        'user_id',
        'reason',
    ];

    /**
     * Get the user that flagged the content.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent content model (resource or resource review).
     */
    public function content()
    {
        return $this->morphTo();
    }
}
