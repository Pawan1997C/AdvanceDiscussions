<?php

namespace App;

class Watcher extends Model
{
    public function watcher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }
}
