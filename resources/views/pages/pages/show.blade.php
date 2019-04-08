@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.index')}}">Pages</a></li>
    <li class="breadcrumb-item">{{pathinfo($record->path,PATHINFO_BASENAME)}}</li>
@endsection
@section('header')
    <i class="fa fa-globe text-muted"></i> {{$record->title}}
@endsection
@section('tools')
    &nbsp;
    <div class="btn-group">

        <a class="btn btn-outline-secondary" target="_blank" href="{{url($record->path)}}">Visit Page</a>
        <a class="btn btn-outline-secondary" target="_blank"
           href="https://developers.facebook.com/tools/debug/sharing/?q={{urlencode($record->getFullUrl())}}">
            <i class="fa fa-facebook-official"></i> Facebook Validate
        </a>
        <a class="btn btn-outline-secondary" href="https://cards-dev.twitter.com/validator" target="_blank">
            <i class="fa fa-twitter"></i> Twiter Card Validate
        </a>
        <a class="btn btn-outline-secondary" target="_blank"
           href="https://developers.google.com/speed/pagespeed/insights/?url={{urlencode($record->getFullUrl())}}">
            <i class="fa fa-google"></i> Google Page Speed
        </a>
        <a class="btn btn-outline-secondary" href="{{route('seo::pages.edit',$record->id)}}"><i
                    class="fa fa-pencil"></i> Edit
        </a>
    </div>

@endsection
@section('content')
    @include('seo::includes.analysis')
@endSection