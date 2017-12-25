@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.index')}}">Pages</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.show',$page->id)}}">{{$page->path}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.images.index',$page->id)}}">Images</a></li>
    <li class="breadcrumb-item">{{$model->id}}</li>
    <li class="breadcrumb-item">Edit</li>

@endsection
@section('tools')
    <a href="{{route('seo::pages.images.create',['page'=>$page->id])}}"><i class="fa fa-plus"></i></a>
@endsection
@section('content')
    <div class="row">
        <div class='col-md-12'>
            <div class='panel panel-default'>
                <div class="panel-body">
                    @include('seo::forms.image',[
                    'route'=>route('seo::pages.images.update',['page'=>$page->id,'pageImage'=>$model->id]),
                    'method'=>'PUT'
                    ])
                </div>
            </div>
        </div>
    </div>
@endSection