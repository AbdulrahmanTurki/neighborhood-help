<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The Profile belongs to a User.
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    /**
     * The Profile has UserID.
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'user_id');
    }
}

   