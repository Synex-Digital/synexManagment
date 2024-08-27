@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Project</h1>
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

    <form action="{{ route('service-projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="thumbnail_image">Thumbnail Image</label>
            <input type="file" class="form-control" id="thumbnail_image" name="thumbnail_image" accept="image/*">
        </div>
        <div class="form-group">
            <label for="thumbnail_image_preview">Current Thumbnail Image</label>
            @if ($project->thumbnail_image)
                <img id="thumbnail_image_preview" src="{{asset($project->thumbnail_image) }}" alt="Current Thumbnail" class="img-fluid" style="max-width: 100px;">
            @else
                <p>No image available</p>
            @endif
        </div>
        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $project->company_name }}" required>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}" required>
        </div>
        <div class="form-group">
            <label for="short_description">Short Description</label>
            <textarea class="form-control" id="short_description" name="short_description" required>{{ $project->short_description }}</textarea>
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ $project->slug }}">
        </div>
        <div class="form-group">
            <label for="project_url">Project URL</label>
            <input type="text" class="form-control" id="project_url" name="project_url" value="{{ $project->project_url }}">
        </div>
        <div class="form-group">
            <label for="service_category_id">Service Category</label>
            <select class="form-control" id="service_category_id" name="service_category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $project->service_category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
