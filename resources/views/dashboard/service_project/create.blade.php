@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <h1>Add Project</h1>
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

    <a href="{{ route('service-projects.index') }}" class="btn btn-primary">Project List:</a>

    <form action="{{ route('service-projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="thumbnail_image">Thumbnail Image</label>
            <input type="file" class="form-control" id="thumbnail_image" name="thumbnail_image" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" class="form-control" id="company_name" name="company_name" required>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="short_description">Short Description</label>
            <textarea class="form-control" id="short_description" name="short_description" required></textarea>
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug">
        </div>
        <div class="form-group">
            <label for="project_url">Project URL</label>
            <input type="text" class="form-control" id="project_url" name="project_url">
        </div>
        <div class="form-group">
            <label for="service_category_id">Service Category</label>
            <select class="form-control" id="service_category_id" name="service_category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
