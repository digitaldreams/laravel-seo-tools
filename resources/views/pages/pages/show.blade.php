@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.index')}}">Pages</a></li>
    <li class="breadcrumb-item">{{pathinfo($record->path,PATHINFO_BASENAME)}}</li>
@endsection
@section('tools')
    &nbsp;
    <a href="{{route('seo::pages.edit',$record->id)}}"><i class="fa fa-pencil"></i></a>
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
    @include('seo::includes.analysis')
@endSection