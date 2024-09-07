@extends('dashboard.layouts.app')
@section('style')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<link rel="stylesheet" href="{{asset('dashboard_assets/vendor/select2/css/select2.min.css')}}">
<style>
    .btn-outline-primary{
       background-color: #e3daff !important;
        border: 0 !important;
        font-size: 15px;
    }
    .btn-outline-primary:hover{
       background-color: #6b51df !important;
    }
</style>
<style>
   #snote .note-toolbar{
        background-color: transparent;
    }
    #snote .note-editor.note-airframe .note-statusbar, .note-editor.note-frame .note-statusbar{
        background-color: transparent !important;
    }
    #snote img:not(.note-editable > p > img) {
           width: 100% ;
           display: flex !important;
           margin: auto !important;
       }
       #snote .note-editable > p > img{
           display: flex;
           margin: auto;
       }
       #snote .note-editable > ul{
           list-style-type: disc !important;
           padding-left: 2rem !important;
           margin-bottom: 20px !important;
       }
       #snote .note-editable > ul li{
        list-style: disc !important;
       }
       #snote .note-editable > ol li{
            margin-left: 30px;
            list-style-type: decimal;
       }
       #snote .customUl > ul{
           list-style-type: disc !important;
           padding-left: 2rem !important;
           margin-bottom: 20px !important;
       }
       #snote iframe {
           display: block;
           margin: auto;
           max-width: 100%;
           max-height: 100%;
       }


       #snote table:not(.note-editable > table) {
           display: flex   ;
           overflow-x: auto;
           white-space: nowrap;
           width: 100% !important;
           border-collapse: collapse;
           justify-content: center;
           align-items: center;
       }

       #snote table th,
       #snote table td {
            padding: 8px;
            border: 1px solid #ccc;
            word-wrap: break-word;
         }


       @media (max-width: 576px) {
            #snote .table {
               font-size: 8px; /* Adjust font size for smaller screens */
           }
           #snote img:not(.note-editable > p > img) {
           width: 100% !important;
           }
           #snote iframe {
               width: 95%;
               height: 100%;
           }
           #snote .note-editable img {
               /* Add your CSS properties for the img element here */

           }
           #snote table:not(.note-editable > table) {

           justify-content: normal !important;
           align-items: normal !important;
           }

       }
       @media (max-width: 767px) {
        #snote .table {
               font-size: 10px; /* Adjust font size for smaller screens */
           }

           #snote img:not(.note-editable > p > img) {
               width: 100% !important;
           }
           #snote iframe {
               width: 95%;
               height: 100%;
           }
       }
       @media (min-width: 768px) and (max-width: 992px) {
        #snote img:not(.note-editable > p > img) {
               width: 100% !important;
           }
       }

</style>
@endsection
@section('content')
<div class="row ">
    <div class="col-lg-6">
        <h3 class="display-5">Create Projects</h3>
    </div>
    <div class="col-lg-6">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Projects</li>
            <li class="breadcrumb-item " ><a class="text-primary">Create Project</a></li>
        </ol>
    </div>

</div>
    <div class="row mb-5">
        <div class="col-lg-12 mb-5">
            <div class="card ">
                <div class="card-header ">
                   <h4 class="font-weight-bold" > <span style="border-left: 4px solid #593bdb"> </span> &nbsp;Create Project</h4>
                </div>
                <div class=" mt-2 border-bottom"></div>
                <div class="card-body">
                    <form action="{{route('project.store')}}" method="POST">
                        @csrf
                        <div class="form-row mb-3">
                            <div class="form-group col-md-8">
                                <label for="" class="form-label font-weight-bold">Project Name :</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Project Name" value="{{old('name')}}" required value="{{old('name')}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="" class="form-label font-weight-bold">Timeline :</label>
                                <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="{{old('daterange')}}" required value="{{old('daterange')}}">
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4" class="font-weight-bold">Client / Stakeholder :</label>
                                <a href="{{ route('client.index') }}" class="btn btn-outline-primary float-right mr-1" style="height:18px; width:30px;"><i class="fa fa-plus" style="top: -8px; left: -1px; position: relative; font-size:10px;"></i></a>
                                <select id="" name="client_id" class="single-select" required >
                                  <option value="">SELECT CLIENT</option>
                                  @foreach ($client as $data )
                                      <option value="{{$data->id}}">{{$data->name}}</option>
                                  @endforeach
                              </select>
                              </div>
                            <div class="form-group  col-lg-6">
                                <label for="inputPassword4" class="font-weight-bold">Budget :</label>
                                <input type="number" min="0" name="budget" id="" class="form-control" placeholder="৳" value="{{old('budget')}}" required>
                            </div>
                        </div>
                        <div id="snote" class="mb-3">
                            <label for="" class="form-label font-weight-bold">Project Description :</label>
                            <textarea name="description" id="summernote" class="form-control " cols="30" rows="10" >{{old('description')}}</textarea>
                        </div>

                        <div class="form-row mb-3">
                            <div class="form-group  col-lg-6">
                                <label for="inputPassword4" class="font-weight-bold">Team Leader :</label>
                                <select id="leader" class="multi-select" name="leader"  required value={{old('leader')}}>
                                    <option value=""> SELECT LEADER</option>
                                    @foreach ($employees as $id => $name  )
                                        <option value="{{ $id }}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputPassword4" class="font-weight-bold">Team Member :</label>
                                <a href="{{ route('employee.index') }}" class="btn btn-outline-primary float-right" style="height:18px; width:30px;"><i class="fa fa-plus" style="top: -9px; left: -2px; position: relative; font-size:10px;"></i></a>
                                <select id="member" class="multi-select" name="member[]" multiple="multiple" required value="{{old('member[]')}}">
                                    <option value=""> SELECT MEMBER</option>
                                    {{-- @foreach ($employees as $id => $name  )
                                        <option value="{{ $id }}">{{$name}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>


                        <div class="form-row mb-3">
                            <div class="form-group  col-lg-6">
                                <label for="inputPassword4" class="font-weight-bold">Status :</label>
                                <select name="status" class="single-select" value="{{old('status')}}">
                                    <option selected>INPROGRESS</option>
                                    <option>ON-HOLD</option>
                                    <option>COMPLETED</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="inputPassword4" class="font-weight-bold">Priority :</label>
                                <select name="priority" class="single-select" value="{{old('priority')}}">
                                    <option>LOW</option>
                                    <option selected >MEDIUM</option>
                                    <option>HIGH</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                        </div>
                        <button type="submit" class="btn  btn-outline-primary float-right" style="font-size: 11px;">Create Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script src="{{asset('dashboard_assets/vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('dashboard_assets/js/plugins-init/select2-init.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.hamburger').trigger('click');


        $('#leader').change(function(){
            var leader = $(this).val();

            $.ajax({
                url: "/get-project-members/"+leader,
                type: "GET",
                data: {
                    leader_id: leader
                },
                success: function (data) {


                    if(data){
                            $("#member").empty();
                            $.each(data,function(key,value){
                                $("#member").append('<option value="'+key+'">'+value+'</option>');
                            });
                        }else{
                            $("#member").empty();
                        }
                }
            });
        });

    });
</script>

@endsection
@section('summernote')
<script>


         $('#summernote').summernote({
            placeholder: 'Optional Description',
           tabsize: 2,
           height: 220,
           toolbar: [
             ['style', ['style']],
             ['font', ['bold', 'underline', 'clear']],
             ['color', ['color']],
             ['para', ['ul', 'ol', 'paragraph']],
             ['table', ['table']],
             ['insert', ['link', 'picture', 'video']],
             ['view', ['fullscreen', 'codeview', 'help']]
           ],

         });
 </script>
@endsection
