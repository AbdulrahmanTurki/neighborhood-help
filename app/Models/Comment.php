<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'help_request_id',
        'body',
    ];

    /**
     * A Comment belongs to a User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A Comment belongs to a HelpRequest.
     */
    public function helpRequest(): BelongsTo
    {
        // Assuming the foreign key in the 'comments' table is 'help_request_id'
        return $this->belongsTo(HelpRequest::class);
    }
}