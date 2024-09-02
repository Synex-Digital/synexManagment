@extends('dashboard.layouts.app')
@section('content')
<div class="row ">
    <div class="col-lg-6 col-md-5 col-sm-5">
        <h3 class="display-5">Blog</h3>
    </div>
    <div class="col-lg-6 col-md-7 col-sm-7">
        <ol class="breadcrumb " style="float:inline-end; background-color: transparent;">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blogs</a></li>
            <li class="breadcrumb-item"><a class="text-primary">Blog Preview</a></li>
        </ol>
    </div>
</div>
{{-- H:i --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Blog Preview</h4>
                    </div>
                    <div class="card-body">
                        <img src="{{ url('/'. $blog->image)}}" class="mb-3" style="padding-top: 40px; width: 100%">
                        <h2>{{ $blog->title }}</h2>
                        <h4>{{ $blog->category->name ?? Unknown }}</h4>

                        <b>Published in</b> {{ \Carbon\Carbon::parse($blog->updated_at)->format('d/m/Y') }} — by <b>{{ $blog->author }}</b>
                        <p>{!! $blog->content !!}</p>
                        <a href="{{ route('blog.create') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
