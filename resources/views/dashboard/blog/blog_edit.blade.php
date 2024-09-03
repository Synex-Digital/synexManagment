@extends('dashboard.layouts.app')

@section('style')
    <!-- include libraries(jQuery, bootstrap) -->

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
@endsection

@section('content')
<div class="row ">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="display-5">Blog</h3>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-7">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blogs</a></li>
            <li class="breadcrumb-item"><a class="text-primary">Blog Edit</a></li>
        </ol>
    </div>
</div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Blog</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label">Category Name</label>
                                            <select name="category_id" class="form-control">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name ?? 'Unknown' }}</option>
                                                    @endforeach
                                                    <option value="" disabled>If category is not in the list, than firstly add the category's information</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class=" col-form-label">Employee Name</label>
                                            <select name="employee_id" class="form-control">
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->id }}">{{ $employee->user->name ?? 'Unknown' }}</option>
                                                    @endforeach
                                                    <option value="" disabled>If category is not in the list, than firstly add the category's information</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class=" col-form-label">Blog Title</label>

                                                <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ $blog->title }}" name="title">

                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="formFile" class="form-label">Image</label>
                                             <div class="custom-file">
                                                <input class="custom-file-input" type="file" id="formFile" name="image" required>
                                                <label class="custom-file-label">Upload Image  </label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class=" col-form-label">Content</label>
                                            <textarea id="summernote" class="form-control" name="content">{{ $blog->content }}</textarea>

                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class=" col-form-label">Blog Slug</label>

                                                <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{ $blog->slug }}" name="slug">

                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class=" col-form-label">Status</label>
                                            <div class="col-sm-9">
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



                                <div class="card">
                                    <div class="card-header">
                                        <h4 class='card-title'>Custom SEO</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class=" col-form-label">SEO Title</label>

                                                    <input type="text" class="form-control " value="{{ $blog->seo_title }}" name="seo_title">

                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class=" col-form-label">SEO Tags</label>

                                                    <input type="text" class="form-control " value="{{ $blog->seo_tags }}" name="seo_tags">

                                            </div>
                                        </div>

                                        <div class=" ">
                                            <label class=" col-form-label">SEO Description</label>
                                            <textarea class="form-control" rows="5" name="seo_description">{{ $blog->seo_description }}</textarea>

                                        </div>


                                    </div>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn  btn-outline-primary float-right" style="font-size: 11px;">Update Blog</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('summernote')
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