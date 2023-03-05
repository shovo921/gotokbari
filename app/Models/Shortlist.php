<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Shortlist extends Model
{
    protected $guarded  = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
