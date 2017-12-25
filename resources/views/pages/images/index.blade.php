@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.index')}}">Pages</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.show',$page->id)}}">{{$page->path}}</a></li>
    <li class="breadcrumb-item">Images</li>

@endsection

@section('content')
OK
@endSection