@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Service Category</h1>
    @if(session('success'))
     <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <!-- Display validation errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    <a href="{{ route('service-categories.index') }}" class="btn btn-primary">Category List:</a>

    <form action="{{ route('service-categories.update', $serviceCategory->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $serviceCategory->name }}" required>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $serviceCategory->title }}" required>
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ $serviceCategory->slug }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $serviceCategory->description }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
