<?php

namespace App;

use App\Channel;

class Discussion extends Model
{
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function watchers()
    {
        return $this->hasMany(Watcher::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFilterByChannels($builder)
    {
        $channel = Channel::where('name', request()->query('channel'))->first();

        if ($channel) {

            return $builder->where('channel_id', $channel->id);
        } else {

            return $builder;
        }
    }

    public function markedAsBestReply()
    {
        $result = false;
        foreach ($this->replies as $reply) {
            if ($reply->bestReply) {
                $result = true;
            }
        }
        return $result;
    }

    public function alreadyWatchedByUser()
    {
        $id = auth()->user()->id;

        $watched = [];

        foreach ($this->watchers as $dw) {
            array_push($watched, $dw->user_id);
        }

        if (in_array($id, $watched)) {
            return true;
        } else {

            return false;
        }

    }
}
