@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item">Pages</li>
@endsection
@section('tools')
    &nbsp;&nbsp;
    <a href="{{route('seo::pages.create')}}"><i class="fa fa-plus"></i></a>
    @if(count(config('seo.linkProviders')>0))
        &nbsp;&nbsp;
        <a href="{{route('seo::pages.generate')}}">Generate Page</a>
    @endif
@endsection
@section('content')
    @include('seo::tables.page')
@endSection