@extends('home')

@section('title')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <a class="btn btn-success" href=" {{route('tasks.create')}}">Add</a>
                        </ul>
                        <form class="d-flex">
                          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                          <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                      </div>
                    </div>
                </nav>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="bootstrap-table">
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="margin-top:20px;">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tasks as $key=> $task)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $task->name }}</td>
                                                <td>{{ number_format($task->price). "đ" }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/app/public/images/'.$task->image) }}" alt="{{$task->image}}"
                                                    style="width: 150px">
                                                </td>
                                                <td>
                                                    <a href="{{route('tasks.show', $task->id)}}" class="btn btn-info">Detail</a>

                                                    <a href="{{route('tasks.edit', $task->id)}}" class="btn btn-warning">Edit</a>

                                                    <form action="{{route('tasks.destroy',$task->id)}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button
                                                            onclick="return confirm('Delete {{ $task->name }} ?');"
                                                            class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav aria-label="Page navigation example">
        <div class='float:right'>
            <ul class="pagination">
                <span aria-hidden="true"> {{ $tasks->links() }}</span>
            </ul>
        </div>
    </nav>
</div>
@endsection