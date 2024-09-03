@extends('dashboard.layouts.app')
@section('content')
<div class="row ">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="display-5"> Category</h3>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-7">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" >Blogs</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blog.index')}}">Category</a></li>
            <li class="breadcrumb-item"><a class="text-primary">Category Edit</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Update Category</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control " name="name" value="{{ $category->name }}" required>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="formFile" class="form-label">Edit Category Image</label>
                            <div class="custom-file">
                                <input class="custom-file-input @error('image') is-invalid @enderror" type="file" id="formFile" name="image">
                                <label class="custom-file-label">Upload Image  </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-sm-3 col-form-label">Slug</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="slug" value="{{ $category->slug }}">

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
                                    <input class="form-check-input" type="radio" name="status" value="inactive">
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
                                    <label class="col-sm-3 col-form-label">SEO Title</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " name="seo_title" value="{{ $category->seo_title }}">

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-sm-3 col-form-label">SEO Tags</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " value="{{ $category->seo_tags }}" name="seo_tags">

                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <label class="form-label">SEO Description</label>
                                <textarea class="form-control " rows="5" name="seo_description"> {{ $category->seo_description}} </textarea >

                            </div>



                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn  btn-outline-primary float-right" style="font-size: 11px;">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
