<?php

namespace App;

class Reply extends Model
{
    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function alreadyLikedByUser()
    {
        $id = auth()->user()->id;

        $likes = [];

        foreach ($this->likes as $Rlike) {
            array_push($likes, $Rlike->user_id);
        }

        if (in_array($id, $likes)) {
            return true;
        } else {

            return false;
        }

    }

}
