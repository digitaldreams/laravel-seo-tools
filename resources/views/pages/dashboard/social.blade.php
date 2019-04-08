@extends(config('seo.layout'))
@section('header')
    <i class="fa fa-users text-muted"></i> Social Media Setting
@endsection
@section('tools')

@endsection
@section('content')
    <nav class="nav nav-tabs" id="seo-settings-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-social-tab" data-toggle="tab" href="#nav-social" role="tab"
           aria-controls="nav-social" aria-selected="true"> Accounts
        </a>

        <a class="nav-item nav-link" id="nav-facebook-tab" data-toggle="tab" href="#nav-facebook" role="tab"
           aria-controls="nav-facebook" aria-selected="false"> <i class="fa fa-facebook-official"></i> Facebook
        </a>

        <a class="nav-item nav-link" id="nav-twitter-tab" data-toggle="tab" href="#nav-twitter" role="tab"
           aria-controls="nav-twitter" aria-selected="false"> <i class="fa fa-twitter"></i> Twitter
        </a>

    </nav>
    <div class="tab-content mt-3" id="nav-tabContent">
        @include('seo::tabs.social')

        <div class="tab-pane fade" id="nav-facebook" role="tabpanel" aria-labelledby="nav-facebook-tab">
            @include('seo::forms.meta-tag-global',['tags'=>$og])
        </div>

        <div class="tab-pane fade" id="nav-twitter" role="tabpanel" aria-labelledby="nav-twitter-tab">
            @include('seo::forms.meta-tag-global',['tags'=>$twitter])
        </div>

    </div>
@endSection