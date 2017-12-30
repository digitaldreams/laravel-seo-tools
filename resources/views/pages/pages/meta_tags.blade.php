@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.index')}}">Pages</a></li>
    <li class="breadcrumb-item">{{$record->path}}</li>
@endsection
@section('tools')
    &nbsp;&nbsp;
    <a href="{{route('seo::pages.create')}}"><i class="fa fa-plus"></i></a>

    &nbsp;&nbsp;
    <a target="_blank"
       href="https://developers.facebook.com/tools/debug/sharing/?q={{urlencode($record->getFullUrl())}}">
        <i class="fa fa-facebook-official"></i> Facebook Validate
    </a>
    &nbsp;&nbsp;
    <a href="https://cards-dev.twitter.com/validator" target="_blank">
        <i class="fa fa-twitter"></i> Twiter Card Validate
    </a>
@endsection
@section('content')
    <nav class="nav nav-tabs" id="seo-settings-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-global-tab" data-toggle="tab" href="#nav-global" role="tab"
           aria-controls="nav-global" aria-selected="true">Home
        </a>

        <a class="nav-item nav-link" id="nav-page-tab" data-toggle="tab" href="#nav-meta" role="tab"
           aria-controls="nav-meta">Meta
        </a>
    </nav>
    <div class="tab-content mt-3" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-global" role="tabpanel" aria-labelledby="nav-global-tab">
            @include('seo::forms.page',[
            'model'=>$record,
             'route'=>route('seo::pages.update',$record->id),
             'method'=>'PUT'
            ])
        </div>
        <div class="tab-pane fade show" id="nav-meta" role="tabpanel" aria-labelledby="nav-page-tab">
            @include('seo::forms.page_meta_tag')
        </div>
    </div>

@endSection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function (e) {
            $('#seo-settings-tab a').on('click', function (e) {
                e.preventDefault()
                $(this).tab('show')
            })
        });
    </script>
@endsection