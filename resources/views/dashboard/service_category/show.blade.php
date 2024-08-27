@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <h1>Service Category Details</h1>
    <div class="card">
        <div class="card-header">
            <h2>{{ $serviceCategory->name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Slug:</strong> {{ $serviceCategory->slug }}</p>
            <p><strong>Description:</strong> {{ $serviceCategory->description }}</p>
            <p><strong>Active:</strong> {{ $serviceCategory->is_active ? 'Yes' : 'No' }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('service-categories.edit', $serviceCategory->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('service-categories.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
