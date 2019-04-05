<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    public function vasttag()
    {
        return $this->hasOne(Vasttag::class);
    }
}
