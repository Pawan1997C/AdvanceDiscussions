<?php

namespace App;

class Channel extends Model
{
    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
