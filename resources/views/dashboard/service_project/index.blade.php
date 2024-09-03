@extends('dashboard.layouts.app')
@section('style')
<link href="{{asset('dashboard_assets/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">



@endsection

@section('content')

<div class="row ">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="display-5">Category</h3>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-7">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="text-primary">Projects</a></li>
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
                            <table id="example" class="display" style="min-width: 845px">

                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ $category->description }}</td>
                                                <td id="category-status-{{ $category->id }}">
                                                    <span id='badge' class="badge   badge-outline-success" onclick="toggleStatus({{ $category->id }}, this)" style="cursor: pointer; ">
                                                        {{ $category->is_active ? 'active' : 'inactive' }}
                                                    </span>
                                                </td>



                                                <td class="d-flex justify-content-spacebetween">
                                                    <a href="{{route('service-categories.edit',$category->id) }}" title="Edit" class=" btn btn-outline-info btn-sm mr-1  "> <i class="fa fa-pencil"></i></a>
                                                    <form action="{{  route('service-categories.destroy', $category->id) }}" method="POST">
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


{{-- project --}}
<div class="row mb-3">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="display-5">Project</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <button type="button" id="addProjectBtn" class="btn btn-rounded btn-primary mr-3" data-toggle="modal" data-target="#projectCreateModal">
            <span class="btn-icon-left text-primary mr-2" style="    margin: -4px 0px -4px -10px;"  >  <i class="fa fa-plus color-info"style="    margin: 2px -3px 1px -3px;" ></i> </span>Project</button>

    </div>
    <div class="col-lg-12 mt-5">
        <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Project Lists</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="display" style="min-width: 845px">

                            <thead>
                                <tr>
                                    <th>Thumbnail</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Company Name</th>
                                    <th>Project URL</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td><img src="{{ $project->thumbnail_image }}" alt="Thumbnail" width="50"></td>
                                        <td>{{ $project->category->name ?? 'Unknown' }}</td>
                                        <td>{{ $project->title }}</td>
                                        <td>{{ $project->company_name }}</td>
                                        <td><a href="{{ $project->project_url?? '#' }}">{{ Str::limit($project->project_url) ?? "N/A" }}</a></td>
                                        <td>{{ Str::limit($project->short_description, 20) }}</td>
                                        <td id="project-status-{{ $project->id }}">
                                            <span class="badgeBtn badge   badge-outline-success  " onclick="toggleProjectStatus({{ $project->id }}, this)" style="cursor: pointer;">
                                                {{ $project->is_active ? 'active' : 'inactive' }}
                                            </span>
                                        </td>

                                        <td class="d-flex justify-content-spacebetween">
                                            {{-- <a href="{{ route('service-projects.show', $project->id) }}" class="btn btn-outline-primary  btn-sm  mr-1"><i class="fa fa-eye"></i></a> --}}
                                            <a href="{{route('service-projects.edit',$project->id) }}" title="Edit" class=" btn btn-outline-info btn-sm mr-1  "> <i class="fa fa-pencil"></i></a>

                                            <form action="{{ route('service-projects.destroy', $project->id) }}" method="POST">
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



















 <!--categroy Modal -->
 <div class="modal fade" id="categoryCreateModal" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Project Category</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('service-categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" required value="{{old('slug')}}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="btn mt-3 btn-outline-primary float-right" style="font-size: 11px;">Create Category</button>
                </form>
            </div>

        </div>
    </div>
</div>
 <!--project Modal -->
 <div class="modal fade" id="projectCreateModal" >
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Project</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('service-projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6">
                            <label for="service_category_id">Service Category</label>
                            <select class="form-control" id="service_category_id" name="service_category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            <label for="thumbnail_image">Thumbnail Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="thumbnail_image" name="thumbnail_image" accept="image/*" required >
                                <label class="custom-file-label">Upload Image  </label>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required value="{{old('title')}}">
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" required value="{{old('company_name')}}">
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            <label for="project_url">Project URL</label>
                            <input type="text" class="form-control" id="project_url" name="project_url" value="{{old('project_url')}}">
                        </div>
                        <div class="form-group col-lg-12 col-md-12">
                            <label for="short_description">Short Description</label>
                            <textarea class="form-control" id="short_description" rows="5" name="short_description" required> {{old('short_description')}}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn  btn-outline-primary float-right" style="font-size: 11px;">Create Project</button>
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
        $('#addProjectBtn').on('click',function(){
            if($(this).hasClass('btn-primary')){
                $(this).removeClass('btn-primary');
                $(this).addClass('btn-info');
            }
        });
        $(document).on('click',function(e){
            if($(e.target).closest('#addProjectBtn').length === 0){
                $('#addProjectBtn').removeClass('btn-info');
                $('#addProjectBtn').addClass('btn-primary');
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
