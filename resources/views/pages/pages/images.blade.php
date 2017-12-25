@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.index')}}">Pages</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.show',$record->id)}}"> {{$record->path}}</a></li>
@endsection
@section('tools')
    &nbsp;
    <a href="{{route('seo::pages.create')}}"><i class="fa fa-plus"></i></a>
    &nbsp;
    <a target="_blank" href="{{url($record->path)}}">Visit Page</a>

@endsection
@section('content')
    <div class="row">

    </div>
@endSection