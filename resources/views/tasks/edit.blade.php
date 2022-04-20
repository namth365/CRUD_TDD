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
                <h3>Edit {{$task->name}}</h3>

                <form method="post" action="{{ route('tasks.update',[$task->id])}}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <input type="text" class="form-control" name="name" value="{{$task->name}}">
                      <span style="color:red;">@error("name"){{ $message }} @enderror</span>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Price</label>
                      <input type="text" class="form-control" name="price" value="{{$task->price}}">
                      <span style="color:red;">@error("price"){{ $message }} @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" value="{{$task->image}}">
                        <img src="{{ asset('/storage/app/public/images/' . $task->image) }}" alt="{{$task->name}}" style="width: 150px">
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{route('tasks.index')}}" class="btn btn-primary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
