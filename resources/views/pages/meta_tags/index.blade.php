@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"> @include('seo::includes.site-nav-dropdown',['menu'=>'Meta Tags'])</li>
    <li class="breadcrumb-item">Meta Tags</li>
@endsection
@section('tools')
    <a href="{{route('seo::meta-tags.create')}}"><span class="fa fa-plus"></span></a>
    &nbsp;&nbsp; <a href="https://moz.com/blog/seo-meta-tags"> Learn about Meta Tags</a>
@endsection
@section('content')
    @include('seo::tables.meta_tag_details')
@endSection