@extends('dashboard.layouts.app')
@section('style')
<link href="{{asset('dashboard_assets/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


@endsection
@section('content')

<div class="row ">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="display-5">Category</h3>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-7">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-primary">Blogs</a></li>
        </ol>
    </div>
</div>

{{-- category --}}
<div class="row">
    <div class="col-lg-12">
        <button type="button" id="addCategoryBtn" class="btn btn-rounded btn-primary mr-3" data-toggle="modal" data-target="#categoryCreateModal">
        <span class="btn-icon-left text-primary mr-2" style="    margin: -4px 0px -4px -10px;"  >  <i class="fa fa-plus color-info"style="    margin: 2px -3px 1px -3px;" ></i> </span>Category</button>


        <div id="accordion-one" class="d-inline">

            <button type="button" id="categoryListBtn" class="btn btn-rounded btn-primary mr-3"  data-toggle="collapse" data-target="#default_collapseOne">
            <span class="btn-icon-left text-primary mr-2"  style="    margin: -4px 0px -4px -10px;"  > <i class="fa fa-th-list color-info"style=" margin: 2px -3px 1px -3px;" ></i> </span>Category List</button>
        </div>

    </div>
    <div class="col-lg-12 mt-5">
        <div id="default_collapseOne" class="collapse accordion__body  " data-parent="#accordion-one">
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


                                            <td> <span class="badge   {{$categories->status == 'inactive' ? 'badge-outline-danger' : 'badge-outline-success'}}">{{$categories->status}}</span> </td>


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
 <!--categroy Modal -->
 <div class="modal fade" id="categoryCreateModal" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Blog Category</h5>
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
                                <input class="custom-file-input" type="file" id="formFile" name="image">
                                <label class="custom-file-label">Upload Image  </label>
                            </div>

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
                            <h4 class='card-title'> Custom SEO</h4>
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
                        <button type="submit" class="btn  btn-outline-primary float-right" style="font-size: 11px;">Create Category</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- blog --}}
<div class="row mb-3">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="display-5">Blog</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <button type="button" id="addBlogBtn" class="btn btn-rounded btn-primary mr-3" data-toggle="modal" data-target="#blogCreateModal">
            <span class="btn-icon-left text-primary mr-2" style="    margin: -4px 0px -4px -10px;"  >  <i class="fa fa-plus color-info"style="    margin: 2px -3px 1px -3px;" ></i> </span>Blog</button>

    </div>
    <div class="col-lg-12 mt-5">
        <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Blog Lists</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class=" display " style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Blog Title</th>
                                    <th>Category Name</th>
                                    <th>Employee Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blog as $blogs)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><img src="{{ url('/'. $blogs->image)}}" class="rounded-lg me-2" width="50" alt=""></td>
                                        <td>{{$blogs->title}} </td>
                                        <td>{{$blogs->category->name ?? 'Unknown'}} </td>
                                        <td>{{$blogs->employee->user->name ??    'Unknown'}} </td>
                                        <td> <span class="badge   {{$blogs->status == 'inactive' ? 'badge-outline-danger' : 'badge-outline-success'}}">{{$blogs->status}}</span> </td>
                                        <td class="d-flex justify-content-spacebetween">
                                            <a href="{{ route('blog.show', $blogs->id) }}" class="btn btn-outline-primary  btn-sm  mr-1"><i class="fa fa-eye"></i></a>
                                            <a href="{{route('blog.edit',$blogs->id) }}" title="Edit" class=" btn btn-outline-info btn-sm mr-1  "> <i class="fa fa-pencil"></i></a>
                                            <form action="{{ route('blog.destroy', $blogs->id) }}" method="POST">
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


 <!--blog Modal -->
 <div class="modal fade" id="blogCreateModal" >
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Blog</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6">
                            <label class=" form-label">Category Name</label>
                            <select name="category_id" class="form-control" required>
                                @foreach ($category as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                <option value="" disabled>If category is not in the list, than firstly add the category's information</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            <label class=" form-label">Employee Name</label>
                            <select name="employee_id" class="form-control" required>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->user ?$employee->user->name:'' }}</option>
                                @endforeach
                                <option value="" disabled>If employee is not in the list, than firstly add the category's information</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6">
                            <label class=" col-form-label">Blog Title <span class="required-tag">*</span></label>
                            <input type="text" class="form-control " placeholder="Enter blog title" name="title" value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="formFile" class="form-label">Image</label>
                            <div class="custom-file">
                                <input class="custom-file-input" type="file" id="formFile" name="image" required>
                                <label class="custom-file-label">Upload Image  </label>
                            </div>

                            <span class="text-red">* Image size should be 680x420 px and should be less than 1MB</span>
                        </div>

                        <div class="form-group col-lg-12 col-md-12">
                            <label class="col-form-label">Content</label>
                            <textarea id="summernote" class="form-control" name="content"></textarea>

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
                    <div class="card">
                        <div class="card-header">
                            <h4 class='card-title'>Custom SEO</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class=" col-form-label">SEO Title</label>
                                    <input type="text" class="form-control " placeholder="Enter SEO title" name="seo_title" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class=" col-form-label">SEO Tags</label>
                                    <input type="text" class="form-control " placeholder="Enter SEO tags" name="seo_tags" required>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-form-label">SEO Description</label>
                                <textarea class="form-control" rows="5"  name="seo_description" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn  btn-outline-primary float-right" style="font-size: 11px;">Create Blog</button>
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
    //color change for category add btn
    $('#addCategoryBtn').on('click',function(){
        if($(this).hasClass('btn-primary')){
            $(this).removeClass('btn-primary');
            $(this).addClass('btn-info');
        }
    });
    $(document).on('click',function(e){
        if($(e.target).closest('#addCategoryBtn').length === 0){
            $('#addCategoryBtn').removeClass('btn-info');
            $('#addCategoryBtn').addClass('btn-primary');
        }
    });
    //color change for blog add btn
    $('#addBlogBtn').on('click',function(){
        if($(this).hasClass('btn-primary')){
            $(this).removeClass('btn-primary');
            $(this).addClass('btn-info');
        }
    });
    $(document).on('click',function(e){
        if($(e.target).closest('#addBlogBtn').length === 0){
            $('#addBlogBtn').removeClass('btn-info');
            $('#addBlogBtn').addClass('btn-primary');
        }
    });
    $('#categoryListBtn').on('click',function(){
        if($(this).hasClass('btn-primary')){
            $(this).removeClass('btn-primary');
            $(this).addClass('btn-info');
        } else if($(this).hasClass('btn-info')){
            $(this).removeClass('btn-info');
            $(this).addClass('btn-primary');
        }
    });
</script>
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
      ],
      callbacks: {
                onPaste: function(e) {
                    // Prevent the default paste behavior
                    e.preventDefault();

                    // Get the text content from the clipboard
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData)
                        .getData('Text');

                    // Insert plain text into the editor
                    document.execCommand('insertText', false, bufferText);
                }
            }
    });
  </script>
@endsection



