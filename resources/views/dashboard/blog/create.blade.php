@extends('dashboard.layouts.app')
@section('style')
    <!-- include libraries(jQuery, bootstrap) -->

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
@endsection
@section('content')

        <div class="container-fluid">

            <div class="row">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa-solid fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="" class="disabled">Blogs</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
                    <a href="{{ route('blog.index') }}" class="btn-left btn btn-primary" style="justify-content: right;">View Blogs list</a>
                </ol>
                <div class="col-lg-12">
                    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <div class="card-header">
                                <h4 class='card-title'>Create Blogs</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-sm-3 col-form-label">Category Name</label>
                                        <select name="category_id" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                            <option value="" disabled>If category is not in the list, than firstly add the category's information</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="col-sm-3 col-form-label">Employee Name</label>
                                        <select name="employee_id" class="form-control">
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->users?$employee->users->name:'' }}</option>
                                            @endforeach
                                            <option value="" disabled>If employee is not in the list, than firstly add the category's information</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="col-sm-3 col-form-label">Blog Title <span class="required-tag">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Enter blog title" name="title" value="{{ old('title') }}">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="formFile" class="form-label">Image</label>
                                        <input class="form-control" type="file" id="formFile"  name="image">
                                        <span class="text-red">* Image size should be 680x420 px and should be less than 1MB</span>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Content</label>
                                        <textarea id="summernote" class="form-control @error('content') is-invalid @enderror" name="content"></textarea>
                                        @error('content')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}< /strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="col-sm-3 col-form-label">Blog Slug</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter blog slug (Must be on small letter)" name="slug">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" value="active" checked>
                                                <label class="form-check-label">
                                                    Active
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" value="inactive" >
                                                <label class="form-check-label">
                                                    Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4 class='card-title'>SEO</h4>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-sm-3 col-form-label">SEO Title</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control @error('seo_title') is-invalid @enderror" placeholder="Enter SEO title" name="seo_title">
                                            @error('seo_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-sm-3 col-form-label">SEO Tags</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control @error('seo_tags') is-invalid @enderror" placeholder="Enter SEO tags" name="seo_tags">
                                            @error('seo_tags')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">SEO Description</label>
                                    <textarea class="from-control @error('seo_description') is-invalid @enderror" rows="5"  name="seo_description"></textarea>
                                    @error('seo_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>




@endsection

@section('script')
<script>
    $('#summernote').summernote({
      placeholder: 'Write content for your blog',
      tabsize: 2,
      height: 120,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
  </script>


@endsection
