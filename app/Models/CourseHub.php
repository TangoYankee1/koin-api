<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseHub extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'university_id',
    ];

    /**
     * Get the university that owns the course hub.
     */
    public function university()
    {
        return $this->belongsTo(University::class);
    }

    /**
     * The users that belong to the course hub.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the resources for the course hub.
     */
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }
}
