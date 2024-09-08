@extends('dashboard.layouts.app')
@section('summernote-style')
<link href="{{asset('dashboard_assets/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<style>
    .note-editor .note-editing-area .note-editable ul {
        display: block !important;
        margin-block-start: 1em !important;
        margin-block-end:  1em !important;
        margin-inline-start: 0px !important;
        margin-inline-end:  0px  !important;
        padding-inline-start: 40px !important;
        unicode-bidi: isolate !important
    }
    .note-editor .note-editing-area .note-editable ul li{

        display: list-item !important;
        text-align: -webkit-match-parent !important;
        list-style-type: disc !important;

    }
    .note-editor .note-editing-area .note-editable ul li::marker{
        color:#3B82F6 !important;
    }
   .note-editor .note-editing-area .note-editable ol {
        display: block !important;
        margin-block-start: 1em !important;
        margin-block-end:  1em !important;
        margin-inline-start: 0px !important;
        margin-inline-end:  0px  !important;
        padding-inline-start: 40px !important;
        unicode-bidi: isolate !important
    }
    .note-editor .note-editing-area .note-editable ol li{

        display: list-item !important;
        text-align: -webkit-match-parent !important;
        list-style-type: decimal !important;
    }
    .note-editor .note-editing-area .note-editable ol li::marker{
        color:#3B82F6 !important;
    }
    .note-editor .note-editing-area .note-editable blockquote {
        background: #3b82f61c;
        padding-left: 1rem;
        color: #000;
        padding-top: 14px;
        padding-bottom: 1px;
        border-left: 6px solid #3b82f6;
        border-radius: 5px 0px 0px 5px;
    }
</style>


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
        @if (auth()->user()->can('blog.create'))
            <button type="button" id="addCategoryBtn" class="btn btn-rounded btn-primary mr-3" data-toggle="modal" data-target="#categoryCreateModal">
            <span class="btn-icon-left text-primary mr-2" style="    margin: -4px 0px -4px -10px;"  >  <i class="fa fa-plus color-info"style="    margin: 2px -3px 1px -3px;" ></i> </span>Category</button>
        @endif


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
                                        @if (auth()->user()->can('blog.create'))
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category as $categories)
                                        <tr>
                                            <td class="text-dark">{{$loop->iteration}}</td>
                                            <td class="text-dark"><img src="{{ url('/'.$categories->image)}}" class="rounded-lg me-2" width="50" alt=""> </td>
                                            <td class="text-dark">{{$categories->name}} </td>


                                            <td class="text-dark"> <span class="badge   {{$categories->status == 'inactive' ? 'badge-outline-danger' : 'badge-outline-success'}}">{{$categories->status}}</span> </td>


                                            @if (auth()->user()->can('blog.create'))
                                            <td class="d-flex justify-content-spacebetween">
                                                <a  href="{{route('category.edit',$categories->id) }}" title="Edit" class="  btn btn-outline-info btn-sm mr-1  " > <i class="fa fa-pencil"></i></a>
                                                <a  href="{{ route('category.destroy', $categories->id) }}" data-toggle="modal" data-target="#deleteModal" title="delete" class="  btn btn-outline-danger btn-sm mr-1 deleteBtn  " > <i class="fa fa-trash"></i></a>


                                            </td>
                                            @endif


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
                                <input type="text" id="category_slug" class="form-control" placeholder="Enter Category Slug (Must be on small letter)" name="slug"  value="{{old('slug')}}">
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
                                    <label class="col-form-label">SEO Title </label>
                                    <div class="">
                                        <input id="cat_seo_title" type="text" class="form-control  " placeholder="Enter SEO title" name="seo_title" value="{{old('seo_title')}}">
                                        <span id="cat_seo_title_error" class="text text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label">SEO Tags</label>
                                    <div class="">
                                        <input id="cat_seo_tags" type="text" class="form-control " placeholder="Enter SEO tags" name="seo_tags" value="{{old('seo_tags')}}">
                                        <span id="cat_seo_tags_error" class="text text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <label class="form-label">SEO Description</label>
                                <textarea id="cat_seo_desc" class="form-control  " rows="5" name="seo_description"> {{old('seo_description')}} </textarea >
                                    <span id="cat_seo_desc_error" class="text text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="categoryCreateBtn" type="submit" class="btn  btn-outline-primary float-right" style="font-size: 11px;">Create Category</button>
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
                                        <td class="text-dark">{{$loop->iteration}}</td>
                                        <td class="text-dark"><img src="{{ url('/'. $blogs->image)}}" class="rounded-lg me-2" width="50" alt=""></td>
                                        <td class="text-dark">{{$blogs->title}} </td>
                                        <td class="text-dark">{{$blogs->category->name ?? 'Unknown'}} </td>
                                        <td class="text-dark">{{$blogs->employee->user->name ??    'Unknown'}} </td>
                                        <td class="text-dark"> <span class="badge   {{$blogs->status == 'inactive' ? 'badge-outline-danger' : 'badge-outline-success'}}">{{$blogs->status}}</span> </td>
                                        <td class="d-flex justify-content-spacebetween">
                                            <a href="{{ route('blog.show', $blogs->id) }}" class="btn btn-outline-primary  btn-sm  mr-1"><i class="fa fa-eye"></i></a>
                                            <a href="{{route('blog.edit',$blogs->id) }}" title="Edit" class=" btn btn-outline-info btn-sm mr-1  "> <i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('blog.destroy', $blogs->id) }}"  title="Delete" data-toggle="modal" data-target="#deleteModal" class=" btn btn-outline-danger btn-sm deleteBtn  "> <i class="fa fa-trash "></i></i></a>
                                            {{-- <form action="" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"</button>
                                            </form> --}}
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
                            <label class=" form-label">Author Name</label>
                            <input type="text" class="form-control " value="{{ Auth::user()->name }}" name="" id="" readonly>
                            <input type="hidden"  value="{{ Auth::user()->id }}" name="employee_id" >
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
                            <textarea id="summernote" class="form-control" name="content">{{ old('content') }}</textarea>

                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-sm-3 col-form-label">Blog Slug</label>
                            <div class="col-sm-12">
                                <input id="slug" type="text" class="slug form-control" placeholder="Enter blog slug (Must be on small letter)" name="slug">
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
                                    <input id="seo_title" type="text" class="form-control " placeholder="Enter SEO title" name="seo_title" required>
                                    <span id="seo_title_error" class="text text-danger"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class=" col-form-label">SEO Tags</label>
                                    <input id="seo_tags" type="text" class="form-control " placeholder="Enter SEO tags" name="seo_tags" required>
                                    <span id="seo_tags_error" class="text text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-form-label">SEO Description</label>
                                <textarea id="seo_desc" class="form-control " rows="5"  name="seo_description" required></textarea>
                                <span id="seo_desc_error" class="text text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="BlogCreateBtn" type="submit" class="btn  btn-outline-primary float-right" style="font-size: 11px;">Create Blog</button>
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
    //CATEGORY SEO VALIDATION
    $(document).ready(function() {
    // Define character limits
    const CAT_SEO_TITLE_LIMIT = 120;
    const CAT_SEO_TAGS_LIMIT = 350;
    const CAT_SEO_DESC_LIMIT = 350;

    function validateFields() {
        let isValid = true;

        // Get current values and lengths
        let seoTitle = $('#cat_seo_title').val();
        let seoTags = $('#cat_seo_tags').val();
        let seoDesc = $('#cat_seo_desc').val();

        let seoTitleLength = seoTitle.length;
        let seoTagsLength = seoTags.length;
        let seoDescLength = seoDesc.length;

        // Check SEO Title
        if (seoTitleLength > CAT_SEO_TITLE_LIMIT) {
            $('#cat_seo_title_error').text(`Must be less than ${CAT_SEO_TITLE_LIMIT} characters`);
            isValid = false;
        } else {
            $('#cat_seo_title_error').text('');
        }

        // Check SEO Tags
        if (seoTagsLength > CAT_SEO_TAGS_LIMIT) {
            $('#cat_seo_tags_error').text(`Must be less than ${CAT_SEO_TAGS_LIMIT} characters`);
            isValid = false;
        } else {
            $('#cat_seo_tags_error').text('');
        }

        // Check SEO Description
        if (seoDescLength > CAT_SEO_DESC_LIMIT) {
            $('#cat_seo_desc_error').text(`Must be less than ${CAT_SEO_DESC_LIMIT} characters`);
            isValid = false;
        } else {
            $('#cat_seo_desc_error').text('');
        }

        // Enable or disable the create button based on the validity
        if (isValid) {
            $('#categoryCreateBtn').removeAttr('disabled').removeClass('btn-primary').addClass('btn-outline-primary');
        } else {
            $('#categoryCreateBtn').attr('disabled', 'disabled').removeClass('btn-outline-primary').addClass('btn-primary');
        }
    }

    // Attach input event handlers
    $('#cat_seo_title, #cat_seo_tags, #cat_seo_desc').on('input', validateFields);
});
 //BLOG SEO VALIDATION
 $(document).ready(function() {
        // Define character limits
        const SEO_TITLE_LIMIT = 120;
        const SEO_TAGS_LIMIT = 350;
        const SEO_DESC_LIMIT = 350;

        function validateFields() {
            let isValid = true;

            // Get current values and lengths
            let seoTitle = $('#seo_title').val();
            let seoTags = $('#seo_tags').val();
            let seoDesc = $('#seo_desc').val();

            let seoTitleLength = seoTitle.length;
            let seoTagsLength = seoTags.length;
            let seoDescLength = seoDesc.length;

            // Check SEO Title
            if (seoTitleLength > SEO_TITLE_LIMIT) {
                $('#seo_title_error').text(`Must be less than ${SEO_TITLE_LIMIT} characters`);
                isValid = false;
            } else {
                $('#seo_title_error').text('');
            }

            // Check SEO Tags
            if (seoTagsLength > SEO_TAGS_LIMIT) {
                $('#seo_tags_error').text(`Must be less than ${SEO_TAGS_LIMIT} characters`);
                isValid = false;
            } else {
                $('#seo_tags_error').text('');
            }

            // Check SEO Description
            if (seoDescLength > SEO_DESC_LIMIT) {
                $('#seo_desc_error').text(`Must be less than ${SEO_DESC_LIMIT} characters`);
                isValid = false;
            } else {
                $('#seo_desc_error').text('');
            }

            // Enable or disable the create button based on the validity
            if (isValid) {
                $('#BlogCreateBtn').removeAttr('disabled').removeClass('btn-primary').addClass('btn-outline-primary');
            } else {
                $('#BlogCreateBtn').attr('disabled', 'disabled').removeClass('btn-outline-primary').addClass('btn-primary');
            }
        }

        // Attach input event handlers
        $('#seo_title, #seo_tags, #seo_desc').on('input', validateFields);
    });
</script>
<script>
    $(document).ready(function() {

    $('body').on('click', '.deleteBtn', function () {
        var val = $(this).attr('href');
        $('#deleteModalForm').attr('action', val);

    });


        $('#slug').on('input', function() {
            var title = $(this).val();
            var slug = generateSlug(title);
            $('#slug').val(slug);
        });
        $('#category_slug').on('input', function() {
            var title = $(this).val();
            var slug = generateSlug(title);
            $('#category_slug').val(slug);
        });

        function generateSlug(title) {
            return title
                .toLowerCase()                // Convert to lowercase
                .replace(/ /g, '-')           // Replace spaces with dashes
                .replace(/[^\w\-]+/g, '')     // Remove non-alphanumeric characters except dashes
                .replace(/\-\-+/g, '-')       // Replace multiple dashes with a single dash
                .trim();                      // Trim leading and trailing dashes
        }
    });

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



