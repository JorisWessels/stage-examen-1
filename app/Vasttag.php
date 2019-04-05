<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vasttag extends Model
{
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
