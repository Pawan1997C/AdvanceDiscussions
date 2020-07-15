<div class="card-header">


    <div class="d-flex justify-content-between">

        <div>

            <img src="{{asset($discussion->author->avatar)}}" style="border-radius: 50px" width="40px" height="40px">

            <span class="ml-2"><strong>{{$discussion->author->name}}</strong></span>

            <span class="ml-2">{{$discussion->created_at->diffForHumans()}}</span>

        </div>

        <div>

            <a href="{{route('discussions.show', ['slug' => $discussion->slug])}}"
                class="btn btn-outline-secondary btn-sm">View</a>

            @if(!$discussion->markedAsBestReply())

            <a href="" class="btn btn-sm btn-outline-danger ml-2">Open</a>

            @else

            <a href="" class="btn btn-sm btn-outline-success ml-2">Closed</a>

            @endif


        </div>


    </div>


</div>