@extends('layouts.app')

@section('content')

<div class="card card-default">


    <div class="card-header text-center">{{isset($channel) ? 'Update Channel' : 'Add Channel'}}</div>

    <div class="card-body">

        <form action="{{isset($channel) ? route('channels.update' , ['id' => $channel->id]) : route('channels.store')}}"
            method="post">
            @csrf
            @if(isset($channel))

            @method('PUT')
            @endif

            <div class="form-group">


                <input type="text" name="name" placeholder="EX: Laravel 5.8"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{isset($channel) ? $channel->name : ''}}">

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>

            <div class="form-group text-center">


                <button type="submit"
                    class="btn btn-outline-success">{{isset($channel) ? 'Update Channel' : 'Add Channel'}}</button>

            </div>


        </form>


    </div>


</div>

@endsection