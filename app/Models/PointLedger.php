<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointLedger extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'points',
        'reason',
    ];

    /**
     * Get the user that owns the point ledger entry.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
