@extends('dashboard.layouts.app')

@section('content')

<div class="row ">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="display-5">Project</h3>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-7">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('service-projects.index') }}">Projects</a></li>
            <li class="breadcrumb-item"><a class="text-primary">Project Edit</a></li>
        </ol>
    </div>
</div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Project</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('service-projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label for="service_category_id">Service Category</label>
                                <select class="form-control" id="service_category_id" name="service_category_id" required>
                                    @foreach ($categories as $category)
                                        <option {{ $category->id == $project->service_category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label for="thumbnail_image">Thumbnail Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="thumbnail_image" name="thumbnail_image" accept="image/*"  >
                                    <label class="custom-file-label">Upload Image  </label>
                                </div>
                                {{-- <label for="thumbnail_image_preview">Current Thumbnail Image</label>
                                @if ($project->thumbnail_image)
                                    <img id="thumbnail_image_preview" src="{{asset($project->thumbnail_image) }}" alt="Current Thumbnail" class="img-fluid" style="max-width: 100px;">
                                @else
                                <p>No image available</p>
                                @endif --}}
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required  value="{{ $project->title }}" >
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label for="company_name">Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" required value="{{ $project->company_name }}">
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" required value="{{ $project->slug }}">
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label for="project_url">Project URL</label>
                                <input type="text" class="form-control" id="project_url" name="project_url" value="{{ $project->project_url}}">
                            </div>
                            <div class="form-group col-lg-12 col-md-12">
                                <label for="short_description">Short Description</label>
                                <textarea class="form-control" id="short_description" rows="5" name="short_description" required> {{ $project->short_description}}</textarea>
                            </div>
                        </div>
                            <div class="">
                                <button type="submit" class="btn  btn-outline-primary float-right" style="font-size: 11px;">Update Project</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
