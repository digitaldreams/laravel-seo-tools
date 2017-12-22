@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::meta-tags.index')}}">Meta Tags</a></li>
    <li class="breadcrumb-item">{{$model->id}}</li>
@endsection
@section('tools')
    <a href="{{route('seo::meta-tags.create')}}"><span class="fa fa-plus"></span></a>
@endsection
@section('content')
    <div class="row">
        <div class='col-md-12'>
            <div class='panel panel-default'>
                <div class="panel-body">
                    @include('seo::forms.meta_tag',[
                    'route'=>route('seo::meta-tags.update',$model->id),
                    'method'=>'PUT'
                    ])
                </div>
            </div>
        </div>
    </div>
@endSection