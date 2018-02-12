@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
@endsection
@section('tools')

@endsection
@section('content')
    <nav class="nav nav-tabs" id="seo-settings-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-social-tab" data-toggle="tab" href="#nav-robot-txt" role="tab"
           aria-controls="nav-social" aria-selected="true"> Robots.txt
        </a>

        <a class="nav-item nav-link" id="nav-htaccess-tab" data-toggle="tab" href="#nav-htaccess" role="tab"
           aria-controls="nav-facebook" aria-selected="false"> .htaccess
        </a>


    </nav>
    <div class="tab-content mt-3" id="nav-tabContent">
        @include('seo::tabs.robot')
        <div class="tab-pane fade" id="nav-facebook" role="tabpanel" aria-labelledby="nav-facebook-tab">

        </div>
        <div class="tab-pane fade" id="nav-htaccess" role="tabpanel" aria-labelledby="nav-htaccess-tab">
            Twitter Settings
        </div>
    </div>
@endSection