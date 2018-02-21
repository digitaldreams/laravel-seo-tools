@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.index')}}">Pages</a></li>
    <li class="breadcrumb-item">{{pathinfo($record->path,PATHINFO_BASENAME)}}</li>
@endsection
@section('tools')
    &nbsp;&nbsp;
    <a href="{{route('seo::pages.create')}}"><i class="fa fa-plus"></i></a>

@endsection
@section('content')
    @include('seo::includes.page_meta_tags')
@endSection

@section('scripts')
@endsection