@extends('layouts.app')


@section('content')

<div class="card">


    <div class="card-header">Update Reply</div>

    <div class="card-body">


        <form action="{{route('replies.update', ['id' => $reply->id])}}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">


                <label for="reply">Reply</label>

                <textarea name="content" id="reply" cols="5" rows="5"
                    class="form-control @error('reply') is-invalid @enderror">{{$reply->content}}</textarea>

                @error('reply')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror


            </div>

            <div class="form-group">

                <button type="submit" class="btn btn-outline-secondary float-right ">Update Reply</button>


            </div>


        </form>

    </div>



</div>

@endsection