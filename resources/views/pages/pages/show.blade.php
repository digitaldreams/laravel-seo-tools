@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.index')}}">Pages</a></li>
    <li class="breadcrumb-item">{{$record->path}}</li>
@endsection
@section('tools')
    &nbsp;
    <a href="{{route('seo::pages.create')}}"><i class="fa fa-plus"></i></a>
    &nbsp;
    <a target="_blank" href="{{url($record->path)}}">Visit Page</a>
    &nbsp;&nbsp;
    <a target="_blank"
       href="https://developers.facebook.com/tools/debug/sharing/?q={{urlencode($record->getFullUrl())}}">
        <i class="fa fa-facebook-official"></i> Facebook Validate
    </a>
    &nbsp;&nbsp;
    <a href="https://cards-dev.twitter.com/validator" target="_blank">
        <i class="fa fa-twitter"></i> Twiter Card Validate
    </a>
    &nbsp;
    <a target="_blank"
       href="https://developers.google.com/speed/pagespeed/insights/?url={{urlencode($record->getFullUrl())}}">
        <i class="fa fa-google"></i> Google Page Speed
    </a>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h3>Page under construction. Here Page statistics/health/Images/Json+LD will be shown</h3>
        </div>
    </div>
@endSection