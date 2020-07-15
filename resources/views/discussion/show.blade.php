@extends('layouts.app')

@section('content')


<div class="card">


    <div class="card-header">


        <div class="d-flex justify-content-between">

            <div>

                <img src="{{asset($discussion->author->avatar)}}" style="border-radius: 50px" width="40px"
                    height="40px">

                <span class="ml-2"><strong>{{$discussion->author->name}}</strong></span>

                <span class="ml-2">{{$discussion->created_at->diffForHumans()}}</span>

            </div>

            <div>

                @auth
                @if(auth()->user()->id === $discussion->user_id)


                <a href="{{route('discussions.edit', ['slug' => $discussion->slug])}}"
                    class="btn btn-outline-info btn-sm m-2">Edit</a>

                @endif
                @endauth

                @if($discussion->alreadyWatchedByUser())

                <a href="{{route('discussions.unwatch', ['slug' => $discussion->slug])}}"
                    class="btn btn-outline-primary btn-sm">Unwatch
                    <strong>{{$discussion->watchers->count()}}</strong></a>

                @else

                <a href="{{route('discussions.watch', ['slug' => $discussion->slug])}}"
                    class="btn btn-outline-primary btn-sm">Watch <strong>{{$discussion->watchers->count()}}</strong></a>

                @endif

            </div>

        </div>

    </div>

    <div class="card-body">


        <div class="text-center"><strong>{{$discussion->title}}</strong></div>

        <hr>


        {!!Markdown::convertToHtml($discussion->content)!!}

        <hr>

        @foreach ($discussion->replies()->where('bestReply', 1)->get() as $reply)

        <div class="card" style="padding:40px">


            <div class="card-header bg-success">


                <div class="d-flex justify-content-between">


                    <div>

                        <img src="{{asset($reply->owner->avatar)}}" style="border-radius: 50px" width="40px"
                            height="40px">

                        <span class="ml-2"><strong>{{$reply->owner->name}}</strong></span>

                        <span class="ml-2">{{$reply->created_at->diffForHumans()}}</span>

                    </div>


                </div>


            </div>

            <div class="card-body">


                {{$reply->content}}

            </div>


        </div>


        @endforeach


    </div>


</div>

<!--Replies-->

@if ($discussion->replies->count() > 0)

@foreach ($discussion->replies()->orderBy('created_at', 'desc')->Paginate(3) as $reply)

<div class="card my-5">

    <div class="card-header">


        <div class="d-flex justify-content-between">


            <div>

                <img src="{{asset($reply->owner->avatar)}}" style="border-radius: 50px" width="40px" height="40px">

                <span ml-2><strong>{{$reply->owner->name}}</strong></span>

                <span class="ml-2">{{$reply->created_at->diffForHumans()}}</span>

            </div>

            <div>
                @auth
                @if(auth()->user()->id === $reply->owner->id)

                <a href="{{route('replies.edit', ['id' => $reply->id])}}"
                    class="btn btn-outline-info btn-sm mr-2">Edit</a>
                @endif

                @if($discussion->user_id === auth()->user()->id && !$discussion->markedAsBestReply())
                <a href="{{route('best-reply', ['id' => $reply->id])}}" class="btn btn-outline-primary btn-sm">Mark
                    as Best Reply</a>
                @endif
                @endauth
            </div>


        </div>


    </div>

    <div class="card-body">


        {{$reply->content}}

    </div>

    @auth
    <div class="card-footer">


        @if($reply->alreadyLikedByUser())

        <a href="{{route('unlike', ['id' => $reply->id])}}" class="btn btn-outline-danger btn-sm">UNLIKE
            <strong>{{$reply->likes->count()}}</strong></a>
        @else

        <a href="{{route('likes.store', ['id' => $reply->id])}}" class="btn btn-outline-success btn-sm">LIKE
            <strong>{{$reply->likes->count()}}</strong></a>
        @endif


    </div>
    @endauth


</div>

@endforeach

<!--Replies Paginations-->

<div class="d-flex justify-content-center">

    {{$discussion->replies()->Paginate(3)->links()}}

</div>

@endif


<!--Leave Reply-->
@auth
@if(!$discussion->markedAsBestReply())
<div class="card my-5">


    <div class="card-header">Leave A Reply</div>

    <div class="card-body">


        <form action="{{route('replies.store', ['id' => $discussion->id])}}" method="post">
            @csrf

            <div class="form-group">


                <label for="reply">Reply</label>

                <textarea name="reply" id="reply" cols="5" rows="5"
                    class="form-control @error('reply') is-invalid @enderror"></textarea>

                @error('reply')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror


            </div>

            <div class="form-group">

                <button type="submit" class="btn btn-outline-secondary float-right ">Leave a Reply</button>


            </div>


        </form>

    </div>



</div>

@else

<div class="card my-5">

    <div class="card-body text-center">


        <strong>Discussion Has Closed</strong>

    </div>

</div>

@endif

@else

<div class="card my-5">

    <div class="card-body text-center">

        <a href="/login" class="btn btn-outline-info">Sing In For Add Reply</a>

    </div>

</div>
@endauth

@endsection