@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item">Pages</li>
@endsection
@section('tools')
    <a href="{{route('seo::pages.create')}}"><i class="fa fa-plus"></i></a>
@endsection
@section('content')
    @include('seo::tables.page')
@endSection