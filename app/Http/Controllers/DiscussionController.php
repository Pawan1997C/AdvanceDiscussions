<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Watcher;
use Illuminate\Pagination\Paginator;

class DiscussionController extends Controller
{

    public function __construct()
    {
        return $this->middleware('verified')->only(['create', 'store']);
    }

    public function index()
    {
        switch (request('filter')) {
            case 'me':
                $result = Discussion::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->Paginate(4);
                break;
            case 'solved':
                $solved = [];
                foreach (Discussion::all() as $d) {

                    if ($d->markedAsBestReply()) {
                        array_push($solved, $d);
                    }
                }
                $result = new Paginator($solved, 3);
                break;

            case 'unsolved':
                $unsolved = [];
                foreach (Discussion::all() as $d) {

                    if (!$d->markedAsBestReply()) {
                        array_push($unsolved, $d);
                    }
                }
                $result = new Paginator($unsolved, 3);
                break;

            default:
                $result = Discussion::orderBy('created_at', 'desc')->filterByChannels()->Paginate(4);
                break;

        }
        return view('discussion.index', ['discussions' => $result]);

    }

    public function create()
    {
        return view('discussion.create');
    }

    public function store()
    {
        $this->validate(request(), [

            'title' => 'required',

            'content' => 'required',

            'channel_id' => 'required',

        ]);

        $data = request()->all();

        $data['slug'] = str_slug(request()->title);

        $data['user_id'] = auth()->user()->id;

        Discussion::create($data);

        session()->flash('success', 'Added Successfully!!');

        return redirect()->route('discussions');
    }

    public function show(Discussion $discussion)
    {
        return view('discussion.show', ['discussion' => $discussion]);
    }

    public function edit(Discussion $discussion)
    {
        if (auth()->user()->id === $discussion->user_id) {
            return view('discussion.create', ['discussion' => $discussion]);
        } else {
            session()->flash('error', 'Sorry you are not authorize!!');

            return redirect()->route('discussions');
        }
    }

    public function update(Discussion $discussion)
    {
        $this->validate(request(), [
            'title' => 'required',

            'channel_id' => 'required',

            'content' => 'required',
        ]);

        $data = request()->all();

        $data['slug'] = str_slug(request()->title);

        $discussion->update($data);

        session()->flash('success', 'Updated Successfully!!');

        return redirect()->route('discussions.show', ['slug' => $discussion->slug]);

    }

    public function watch(Discussion $discussion)
    {

        $watch = Watcher::create([

            'user_id' => auth()->user()->id,

            'discussion_id' => $discussion->id,

        ]);

        session()->flash('success', 'You are now watching discussion!!');

        return redirect()->route('discussions.show', ['slug' => $discussion->slug]);
    }

    public function unwatch(Discussion $discussion)
    {
        $watched = Watcher::where([['discussion_id', $discussion->id], ['user_id', auth()->user()->id]])->first();

        $watched->delete();

        session()->flash('success', 'unwatched successfully!!');

        return redirect()->route('discussions.show', ['slug' => $discussion->slug]);

    }
}
