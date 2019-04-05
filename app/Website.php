<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function zone()
    {
        return $this->hasOne(Zone::class);
    }
}
