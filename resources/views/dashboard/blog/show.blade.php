@extends('dashboard.layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa-solid fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="" class="disabled">Blogs</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('blog.create') }}">View</a></li>
    <li class="breadcrumb-item active"><a href="javascript:void(0)">Preview</a></li>
</ol>
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
