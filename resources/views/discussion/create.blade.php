@extends('layouts.app')


@section('content')

<div class="card">

    <div class="card-header text-center">{{isset($discussion) ? 'Update Discussion' : 'Create Discussion'}}</div>

    <div class="card-body">

        <form
            action="{{isset($discussion) ? route('discussions.update', ['slug' => $discussion->slug]) : route('discussions.store')}}"
            method="post">

            @csrf

            @if (isset($discussion))

            @method('PUT')

            @endif

            <div class="form-group">


                <label for="channel">Choose Channel</label>

                <select name="channel_id" id="channel" class="form-control @error('channel_id') is-invalid @enderror">

                    <option value="">Select Channel</option>
                    @foreach($channels as $channel)


                    <option value="{{$channel->id}}" @if (isset($discussion)) @if ($channel->id ===
                        $discussion->channel_id)

                        selected

                        @endif

                        @endif



                        >{{$channel->name}}</option>


                    @endforeach


                </select>


            </div>

            <div class="form-group">


                <label for="title">Title</label>

                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    placeholder="Ex: Hey How're You?" value="{{isset($discussion) ? $discussion->title : ''}}">

            </div>

            <div class="form-group">

                <label for="content">Ask Question</label>

                <textarea name="content" id="content" cols="5" rows="5"
                    class="form-control @error('content') is-invalid @enderror">{{isset($discussion) ? $discussion->content : ''}}</textarea>


            </div>

            <div class="form-group text-center">

                <button type="submit"
                    class="btn btn-outline-success">{{isset($discussion) ? 'Update Discussion' : 'Create Discussion'}}</button>


            </div>



        </form>

    </div>


</div>

@endsection