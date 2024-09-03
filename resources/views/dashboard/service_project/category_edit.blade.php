@extends('dashboard.layouts.app')

@section('content')


<div class="row ">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="display-5"> Category</h3>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-7">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('service-projects.index') }}" >Projects</a></li>
            <li class="breadcrumb-item"><a href="{{ route('service-projects.index')}}">Category</a></li>
            <li class="breadcrumb-item"><a class="text-primary">Category Edit</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Update Category</h4>
            </div>
            <div class="card-body">
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

                    <div class="">
                        <button type="submit" class="btn  btn-outline-primary float-right" style="font-size: 11px;">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
