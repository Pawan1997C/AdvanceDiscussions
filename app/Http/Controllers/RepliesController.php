<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Like;
use App\Notifications\NewReplyAdded;
use App\Reply;
use App\User;
use Illuminate\Support\Facades\Notification;

class RepliesController extends Controller
{
    public function store($discussion)
    {
        $this->validate(request(), ['reply' => 'required']);

        $discussion = Discussion::find($discussion);

        Reply::create([
            'content' => request()->reply,
            'discussion_id' => $discussion->id,
            'user_id' => auth()->user()->id,
        ]);

        $watchers = [];

        foreach ($discussion->watchers as $watcher) {

            array_push($watchers, User::find($watcher->user_id));
        }

        Notification::send($watchers, new NewReplyAdded($discussion));

        session()->flash('success', 'Reply Added Successfully!!');

        return redirect()->back();
    }

    public function like($reply)
    {
        Like::create([

            'reply_id' => $reply,

            'user_id' => auth()->user()->id,

        ]);

        session()->flash('success', 'Liked Successfully!!');

        return redirect()->back();

    }

    public function unlike($reply)
    {
        $like = Like::where([['reply_id', $reply], ['user_id', auth()->user()->id]])->first();

        $like->delete();

        session()->flash('success', 'Unliked Successfully!!');

        return redirect()->back();

    }

    public function bestReply($reply)
    {
        $reply = Reply::find($reply);

        $reply->bestReply = 1;

        $reply->save();

        session()->flash('success', 'Unliked Successfully!!');

        return redirect()->back();

    }

    public function edit(Reply $reply)
    {
        return view('replies.edit', ['reply' => $reply]);
    }

    public function update(Reply $reply)
    {
        $this->validate(request(), ['content' => 'required:min:6|max:2000']);

        $reply->update(request()->all());

        session()->flash('success', 'Updated Successfully!!');

        return redirect()->route('discussions.show', ['slug' => $reply->discussion->slug]);

    }
}
