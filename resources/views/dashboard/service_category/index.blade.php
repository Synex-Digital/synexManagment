@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <h1>Service Categories</h1>
    <a href="{{ route('service-categories.create') }}" class="btn btn-primary">Add New Category</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->description }}</td>
                    <td id="status-{{ $category->id }}">
                        <span onclick="toggleStatus({{ $category->id }}, this)" style="cursor: pointer; text-decoration: underline;">
                            {{ $category->is_active ? 'Yes' : 'No' }}
                        </span>
                    </td>
                                       
                    <td>
                        <a href="{{ route('service-categories.show', $category->id) }}" class="btn btn-info">Show</a>
                        <a href="{{ route('service-categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('service-categories.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this category?');">
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
        {{ $categories->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection
@section('script')
<script>
    function toggleStatus(id, element) {
        fetch(`/service-category/toggle-status/${id}`, {
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
