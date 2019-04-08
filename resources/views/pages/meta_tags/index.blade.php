@extends(config('seo.layout'))
@section('header')
    <i class="fa fa-code text-muted"></i> Meta Tags
@endsection
@section('tools')
    <div class="btn-group">

        <a class="btn btn-outline-secondary" href="https://moz.com/blog/seo-meta-tags">
            Learn about Meta Tags <i class="fa fa-info-circle"></i>
        </a>
        <a class="btn btn-outline-secondary" href="{{route('seo::meta-tags.create')}}">
            <span class="fa fa-plus"></span> New Tag
        </a>
    </div>

@endsection
@section('content')
    @include('seo::tables.meta_tag_details')
@endSection