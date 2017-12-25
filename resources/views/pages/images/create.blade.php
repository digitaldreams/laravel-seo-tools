@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.index')}}">Pages</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.show',$page->id)}}">{{$page->path}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.images.index',$page->id)}}">Images</a></li>
    <li class="breadcrumb-item">Create</li>
@endsection
@section('tools')
@endsection
@section('content')
    <div class="row">
        <div class='col-md-12'>
            <div class='panel panel-default'>
                <div class="panel-body">
                    @include('seo::forms.image')
                </div>
            </div>
        </div>
    </div>
@endSection