@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <h1>Projects</h1>
    <a href="{{ route('service-projects.create') }}" class="btn btn-primary">Add New Project</a>
    <table class="table">
        <thead>
            <tr>
                <th>Thumbnail</th>
                <th>Company Name</th>
                <th>Title</th>
                <th>Description</th>
                <th>Project URL</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td><img src="{{ $project->thumbnail_image }}" alt="Thumbnail" width="100"></td>
                    <td>{{ $project->company_name }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->short_description }}</td>
                    <td><a href="{{ $project->project_url }}">{{ $project->project_url }}</a></td>
                    <td id="status-{{ $project->id }}">
                        <span onclick="toggleProjectStatus({{ $project->id }}, this)" style="cursor: pointer; text-decoration: underline;">
                            {{ $project->is_active ? 'Yes' : 'No' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('service-projects.show', $project->id) }}" class="btn btn-warning">Show</a>
                        <a href="{{ route('service-projects.edit', $project->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('service-projects.destroy', $project->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this project?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $projects->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection
@section('script')
<script>
    function toggleProjectStatus(id, element) {
        fetch(`/service-project/toggle-status/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Toggle the text based on the new status
            element.innerText = data.status;
        })
        .catch(error => console.error('Error:', error));
    }
    </script>    
@endsection