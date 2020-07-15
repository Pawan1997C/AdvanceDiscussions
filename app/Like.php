<?php

namespace App;

class Like extends Model
{
    public function reply()
    {
        return $this->belongsTo(Reply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
