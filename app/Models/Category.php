<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * A Category can have many HelpRequests.
     */
    public function helpRequests(): HasMany
    {
        return $this->hasMany(HelpRequest::class);
    }
}