@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.index')}}">Pages</a></li>
    <li class="breadcrumb-item">{{$record->path}}</li>
@endsection
@section('tools')
    <a href="{{route('seo::pages.create')}}"><i class="fa fa-plus"></i></a>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-8">
            @include('seo::forms.page_meta_tag')
        </div>
    </div>
@endSection