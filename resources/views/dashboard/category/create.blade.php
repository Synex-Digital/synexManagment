@extends('dashboard.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa-solid fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="" class="disabled">Category</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">View</a></li>
            <a href="{{ route('category.index') }}" class="btn-left btn btn-primary" style="justify-content: right;">Create Category</a>
        </ol>
        <div class="col-lg-12">
            <div class="card">
                @if(session('danger'))
                    <div class="alert alert-danger">{{ session('danger') }}</div>
                @endif

                <div class="card-header">
                    <h4 class="card-title">
                        Category List
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    {{-- <th style="width:50px;">
                                        <div class="form-check custom-checkbox checkbox-success check-lg me-3">
                                            <input type="checkbox" class="form-check-input" id="checkAll" required="">
                                            <label class="form-check-label" for="checkAll"></label>
                                        </div>
                                    </th> --}}
                                    <th><strong>Sl. No</strong></th>
                                    <th><strong>Catergory Name</strong></th>
                                    {{-- <th><strong>SEO Title</strong></th>
                                    <th><strong>SEO Description</strong></th>
                                    <th><strong>SEO Tags</strong></th> --}}
                                    <th><strong>Status</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $sl=>$categories)
                                    <tr>
                                        {{-- <td>
                                            <div class="form-check custom-checkbox checkbox-success check-lg me-3">
                                                <input type="checkbox" class="form-check-input" id="customCheckBox2" required="">
                                                <label class="form-check-label" for="customCheckBox2"></label>
                                            </div>
                                        </td> --}}
                                        <td><strong>{{ $sl+1 }}</strong></td>

                                        <td><div class="d-flex align-items-center"><img src="{{ url('/'.$categories->image)}}" class="rounded-lg me-2" width="20" alt=""> <span class="w-space-no">{{ $categories->name }}</span></div></td>

                                        {{-- <td><span class="w-space-no">{{ $categories->seo_title }}</span></td>

                                        <td><span class="w-space-no">{{ $categories->seo_description }}</span></td>
                                        <td><span class="w-space-no">{{ $categories->seo_tags }}</span></td> --}}

                                        <td><span class="badge light {{ $categories->status == 'inactive' ? 'badge-danger' : 'badge light' }} badge-success">{{ $categories->status }}</span></td>

                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('category.edit', $categories->id) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>

                                                <form class="delete-form" action="{{ route('category.destroy', $categories->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger shadow btn-xs sharp" data-id="{{ $categories->id }}"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var forms = document.querySelectorAll('.delete-form');

            forms.forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Prevent form submission

                    var id = this.querySelector('button[type="submit"]').getAttribute('data-id'); // Get the blog post ID

                    // Show confirmation dialog
                    if (confirm('Are you sure you want to delete this blog post?')) {
                        // If user confirms, submit the form
                        this.removeEventListener('submit', arguments.callee); // Remove the event listener to prevent multiple submissions
                        this.submit();
                    }
                });
            });
        });
    </script>
@endsection
