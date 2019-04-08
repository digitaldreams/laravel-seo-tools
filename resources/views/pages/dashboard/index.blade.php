@extends(config('seo.layout'))

@section('header')
    <i class="fa fa-home text-muted"></i> Dashboard
@endsection
@section('tools')
@endsection
@section('content')
    <nav class="nav nav-tabs" id="seo-settings-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-dashboard-tab" data-toggle="tab" href="#nav-dashboard" role="tab"
           aria-controls="nav-global" aria-selected="true">Home
        </a>

        <a class="nav-item nav-link hide" id="nav-site-tab" data-toggle="tab" href="#nav-site" role="tab"
           aria-controls="nav-global" aria-selected="true">Site
        </a>

        <a class="nav-item nav-link" id="nav-webmaster-tab" data-toggle="tab" href="#nav-webmaster"
           role="tab"
           aria-controls="nav-page-meta-tags" aria-selected="false">Webmaster Tools
        </a>
        <a class="nav-item nav-link" id="nav-personal-info-tab" data-toggle="tab" href="#nav-personal-info"
           role="tab"
           aria-controls="nav-page-meta-tags" aria-selected="false">Personal/Company info
        </a>
    </nav>
    <div class="tab-content mt-3" id="nav-tabContent">
        @include('seo::tabs.dashboard')
        @include('seo::tabs.site')
        <div class="tab-pane fade" id="nav-webmaster" role="tabpanel" aria-labelledby="nav-webmaster-tab">
            @include('seo::forms.meta-tag-global',['tags'=>$webmasterTags])
        </div>
        <div class="tab-pane fade" id="nav-personal-info" role="tabpanel" aria-labelledby="nav-personal-info-tab">

            @include('seo::tabs.ownership')
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