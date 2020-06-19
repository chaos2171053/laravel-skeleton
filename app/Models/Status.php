<?php

namespace App\Models;

use App\Models\User;
use Override\Laravel\Illuminate\Database\Eloquent\Model;

/**
 * Class Status.
 *
 * @package App\Models\Models
 * @mixin \Eloquent
 */
class Status extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
