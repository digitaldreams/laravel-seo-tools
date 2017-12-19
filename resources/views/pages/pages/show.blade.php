@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::pages.index')}}">Pages</a></li>
    <li class="breadcrumb-item">{{$record->path}}</li>
@endsection
@section('tools')
    <a href="{{route('seo::pages.create')}}"><i class="fa fa-plus"></i></a>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-8">
            @include('seo::cards.page',['route'=>route('seo::pages.destroy',$record->id)])
        </div>
    </div>
@endSection