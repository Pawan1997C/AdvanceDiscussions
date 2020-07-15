@extends('layouts.app')



@section('content')

<div class="card">


    <div class="card-header text-center">Channels</div>

    <div class="card-body">

        <table class="table table-hover">


            <thead>

                <tr>

                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>

            </thead>

            <tbody>

                @foreach($channels as $channel)

                <tr>



                    <td>{{$channel->name}}</td>

                    <td><a href="{{route('channels.edit', ['id'=> $channel->id])}}"
                            class="btn btn-outline-info">Edit</a></td>


                    <td><button class="btn btn-outline-danger" onclick="myfunc({{$channel->id}})">Delete</button></td>

                </tr>

                @endforeach

            </tbody>

        </table>

        <div class="d-flex justify-content-center">

            {{$channels->links()}}

        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="" method="post" id="myform">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Channel</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            Are You Sure You Want To Delete?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                            <button type='submit' type="button" class="btn btn-outline-danger">Yes, Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>


</div>

@endsection

@section('script')

<script>
    function myfunc(id)
    {
        var form = document.getElementById('myform');
        form.action = "channels/"+id;
        $('#exampleModal').modal('show');
        
    }


</script>

@endsection