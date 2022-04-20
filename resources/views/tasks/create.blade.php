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
                <h3>Create Task</h3>

                <form method="post" action="{{ route('tasks.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <input type="text" class="form-control" name="name" value="{{old('name')}}">
                      <span style="color:red;">@error("name"){{ $message }} @enderror</span>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Price</label>
                      <input type="text" class="form-control" name="price" value="{{old('price')}}">
                      <span style="color:red;">@error("price"){{ $message }} @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" value="{{old('image')}}">
                      </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{route('tasks.index')}}" class="btn btn-primary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
