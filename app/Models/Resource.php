<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'course_hub_id',
        'user_id',
        'title',
        'description',
        'file_path',
    ];

    /**
     * Get the course hub that owns the resource.
     */
    public function courseHub()
    {
        return $this->belongsTo(CourseHub::class);
    }

    /**
     * Get the user that owns the resource.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reviews for the resource.
     */
    public function reviews()
    {
        return $this->hasMany(ResourceReview::class);
    }
}
