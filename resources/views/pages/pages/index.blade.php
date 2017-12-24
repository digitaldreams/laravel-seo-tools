@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item">Pages</li>
@endsection
@section('tools')
    &nbsp;&nbsp;
    <a href="{{route('seo::pages.create')}}"><i class="fa fa-plus"></i></a>
    @if(count(config('seo.linkProviders'))>0)
        &nbsp;&nbsp;
        <a href="{{route('seo::pages.generate')}}">Generate Page</a>
    @endif
    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#uploadPageCsv">
        <i class="fa fa-cloud-upload"></i> Upload CSV
    </button>
    <a href="{{route('seo::pages.download')}}" class="btn btn-outline-primary btn-sm">
        <i class="fa fa-download"></i> Download CSV
    </a>

@endsection
@section('content')
    @include('seo::tables.page')
    @include('seo::modals.page_upload')
@endSection