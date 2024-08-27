@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <h1>Project Details</h1>
    <div class="card">
        <div class="card-header">
            <h2>{{ $project->title }}</h2>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <img src="{{ asset($project->thumbnail_image) }}" alt="Thumbnail" class="img-fluid">
            </div>
            <p><strong>Company Name:</strong> {{ $project->company_name }}</p>
            <p><strong>Description:</strong> {{ $project->short_description }}</p>
            <p><strong>Project URL:</strong> <a href="{{ $project->project_url }}" target="_blank">{{ $project->project_url }}</a></p>
            <p><strong>Service Category:</strong> {{ $project->serviceCategory->name }}</p>
            <p><strong>Active:</strong> {{ $project->is_active ? 'Yes' : 'No' }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
