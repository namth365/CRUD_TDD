@extends('home')

@section('title')

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3>Detail Task</h3>

                    <div class="mb-3">
                      <td>Name</td>
                      <td class="">{{$task->name}}</td>
                    </div>
                    <div class="mb-3">
                      <th>Price</th>
                      <td class="">{{number_format ($task->price)}}</td>
                    </div>
                    <div class="mb-3">
                      <th>Image</th>
                        <td>
                        <img src="{{ asset('/storage/app/public/images/' . $task->image) }}" alt="{{$task->name}}" style="width: 150px">
                        </td>
                    </div>
                    <div class="">
                    <a href="{{route('tasks.edit', $task->id)}}" class="btn btn-warning">Edit</a>
                    <a href="{{route('tasks.index')}}" class="btn btn-primary">Back</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
