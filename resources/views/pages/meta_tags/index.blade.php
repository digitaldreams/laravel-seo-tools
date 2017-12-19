@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item">Meta Tags</li>
@endsection
@section('tools')
    <a href="{{route('seo::meta-tags.create')}}"><span class="fa fa-plus"></span></a>
@endsection
@section('content')
    @include('seo::tables.meta_tag_details')
@endSection