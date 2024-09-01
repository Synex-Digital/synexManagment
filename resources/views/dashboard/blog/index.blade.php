@extends('dashboard.layouts.app')
@section('style')
<link href="{{asset('dashboard_assets/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">


@endsection
@section('content')

<div class="row ">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="display-5">Blogs</h3>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-7">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-primary">Blogs</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <button type="button" class="btn btn-rounded btn-primary mr-3" data-toggle="modal" data-target="#categoryCreateModal">
        <span class="btn-icon-left text-primary mr-2" style="    margin: -4px 0px -4px -10px;"  >  <i class="fa fa-plus color-info"style="    margin: 2px -3px 1px -3px;" ></i> </span>Category</button>

        <div id="accordion-one" class="d-inline">

            <button type="button" class="btn btn-rounded btn-info "  data-toggle="collapse" data-target="#default_collapseOne">
            <span class="btn-icon-left text-primary mr-2"  style="    margin: -4px 0px -4px -10px;"  > <i class="fa fa-th-list color-info"style=" margin: 2px -3px 1px -3px;" ></i> </span>Category List</button>
        </div>
    </div>
    <div class="col-lg-12 mt-5">
        <div id="default_collapseOne" class="collapse accordion__body show " data-parent="#accordion-one">
            <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Category Lists</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class=" display " style="min-width: 845px">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category as $categories)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><img src="{{ url('/'.$categories->image)}}" class="rounded-lg me-2" width="50" alt=""> </td>
                                            <td>{{$categories->name}} </td>


                                            <td> <span class="badge badge-light text-success">{{$categories->status}}</span> </td>


                                            <td class="d-flex justify-content-spacebetween">
                                                <a href="{{route('category.edit',$categories->id) }}" title="Edit" class=" btn btn-outline-info btn-sm mr-1  "> <i class="fa fa-pencil"></i></a>
                                                <form action="{{ route('category.destroy', $categories->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" title="Delete" class=" btn btn-outline-danger btn-sm   "> <i class="fa fa-trash "></i></button>
                                                </form>

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

       {{-- <div class="container-fluid">
            <div class="row">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa-solid fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="" class="disabled">Blogs</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">View</a></li>
                    <a href="{{ route('blog.create') }}" class="btn-left btn btn-primary" style="justify-content: right;">Create Blog</a>
                </ol>
                 <div class="col-lg-12">
                    <div class="card">
                        @if(session('danger'))
                            <div class="alert alert-danger">{{ session('danger') }}</div>
                        @endif
                        <div class="card-header">
                            <h4 class="card-title">Blogs List View</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>

                                            <th><strong>Sl. No</strong></th>
                                            <th><strong>Blog Title</strong></th>
                                            <th><strong>Category Name</strong></th>
                                            <th><strong>Employee Name</strong></th>
                                            <th><strong>Image</strong></th>

                                            <th><strong>Status</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blog as $sl=>$blogs)
                                            <tr>

                                                <td><strong>{{ $sl+1 }}</strong></td>

                                                <td><span class="w-space-no">{{ $blogs->title }}</span></div></td>

                                                <td><span class="w-space-no">{{ $blogs->category->name ?? Unknown }}</span></td>

                                                <td><span class="w-space-no">{{ $blogs->employee->user->name }}</span></td>

                                                <td><div class="d-flex align-items-center"><img src="{{ url('/'. $blogs->image)}}" class="rounded-lg me-2" width="20" alt=""></td>


                                                <td><span class="badge light {{ $blogs->status == 'inactive' ? 'badge-danger' : 'badge light' }} badge-success">{{ $blogs->status }}</span></td>

                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('blog.edit', $blogs->id) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>

                                                        <a href="{{ route('blog.show', $blogs->id) }}" class="btn btn-info shadow btn-xs sharp me-1"><i class="fa fa-eye"></i></a>

                                                        <form class="delete-form" action="{{ route('blog.destroy', $blogs->id) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-delete btn-danger shadow btn-xs sharp" data-id="{{ $blogs->id }}"><i class="fa fa-trash"></i></button>
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
            </div>--}}


 <!-- Modal -->
 <div class="modal fade" id="categoryCreateModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-lg-6 col-form-label">Category Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control"  placeholder="Enter Category Name" name="name" required value="{{old('name')}}">

                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="" class="form-label">Category Image</label>
                            <div class="custom-file">
                                <input class="custom-file-input @error('image') is-invalid @enderror" type="file" id="formFile" name="image">
                                <label class="custom-file-label">Upload Image  </label>
                            </div>
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-lg-6 col-form-label">Category Slug</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Enter Category Slug (Must be on small letter)" name="slug"  value="{{old('slug')}}">
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
                            <h4 class='card-title'> Add Custom SEO</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label">SEO Title</label>
                                    <div class="">
                                        <input type="text" class="form-control " placeholder="Enter SEO title" name="seo_title" value="{{old('seo_title')}}">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label">SEO Tags</label>
                                    <div class="">
                                        <input type="text" class="form-control" placeholder="Enter SEO tags" name="seo_tags" value="{{old('seo_tags')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <label class="form-label">SEO Description</label>
                                <textarea class="form-control " rows="5" name="seo_description"> {{old('seo_description')}} </textarea >

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn  btn-outline-primary float-right" style="font-size: 11px;">Add Category</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>


@endsection

@section('script')
<script src="{{asset('dashboard_assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard_assets/js/plugins-init/datatables.init.js')}}"></script>
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




