@extends(config('seo.layout'))
@section('header')
    <i class="fa fa-pencil"></i> {{$record->title}}
@endsection
@section('tools')
    <a class="btn btn-outline-secondary" href="{{route('seo::pages.create')}}">
        <i class="fa fa-plus"></i> New Page
    </a>
@endsection
@section('content')
    <div class="row">
        <div class='col-md-12'>
            <div class='panel panel-default'>
                <div class="panel-body">
                    @include('seo::forms.page',[
                    'showPageUrl' => true,
                    'route' => route('seo::pages.update',$record->id),
                    'method' => 'PUT'
                    ])
                </div>
            </div>
        </div>
    </div>
@endSection