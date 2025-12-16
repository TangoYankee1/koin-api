<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'university_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the university associated with the user.
     */
    public function university()
    {
        return $this->belongsTo(University::class);
    }

    /**
     * The course hubs that the user belongs to.
     */
    public function courseHubs()
    {
        return $this->belongsToMany(CourseHub::class);
    }

    /**
     * Get the resources for the user.
     */
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    /**
     * Get the resource reviews for the user.
     */
    public function resourceReviews()
    {
        return $this->hasMany(ResourceReview::class);
    }

    /**
     * Get the point ledger entries for the user.
     */
    public function pointLedgers()
    {
        return $this->hasMany(PointLedger::class);
    }

    /**
     * Get the flagged content for the user.
     */
    public function flaggedContent()
    {
        return $this->hasMany(FlaggedContent::class);
    }

    /**
     * Get the chat messages for the user.
     */
    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
