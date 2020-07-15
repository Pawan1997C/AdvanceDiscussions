@extends('layouts.app')

@section('content')

@if($discussions->count() > 0)

@foreach($discussions as $discussion)

<div class="card mb-4">


    @include('partial.header')

    <div class="card-body">


        <div class="text-center"><strong>{{$discussion->title}}</strong></div>


    </div>

    <div class="card-footer">

        Replies {{$discussion->replies->count()}}

        <a href="{{route('discussions')}}?channel={{$discussion->channel->name}}"
            class="btn btn-outline-info btn-sm float-right">{{$discussion->channel->name}}</a>

    </div>


</div>


@endforeach

<div class="d-flex justify-content-center">

    {{$discussions->appends(['channel' => request()->query('channel')])->links()}}


</div>


@else


<h3 class="text-center">No Discussions Yet</h3>


@endif

@endsection