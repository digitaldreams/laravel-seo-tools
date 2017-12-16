@extends(config('seo.layout'))
@section('content')
    <nav class="nav nav-tabs" id="seo-settings-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-global-tab" data-toggle="tab" href="#nav-global" role="tab"
           aria-controls="nav-global" aria-selected="true">Global
        </a>

        <a class="nav-item nav-link" id="nav--page-meta-tags-tab" data-toggle="tab" href="#nav-page-meta-tags"
           role="tab"
           aria-controls="nav-page-meta-tags" aria-selected="false">Page Meta
        </a>

        <a class="nav-item nav-link" id="nav-social-tab" data-toggle="tab" href="#nav-social" role="tab"
           aria-controls="nav-social" aria-selected="false">Social
        </a>

        <a class="nav-item nav-link" id="nav-webmaster-tab" data-toggle="tab" href="#nav-webmaster" role="tab"
           aria-controls="nav-webmaster" aria-selected="false">Webmaster
        </a>

        <a class="nav-item nav-link" id="nav-sitemap-tab" data-toggle="tab" href="#nav-sitemap" role="tab"
           aria-controls="nav-sitemap" aria-selected="false">Sitemap
        </a>

        <a class="nav-item nav-link" id="nav-robot-txt-tab" data-toggle="tab" href="#nav-robot-txt" role="tab"
           aria-controls="nav-robot-txt" aria-selected="false">Robot.txt
        </a>

    </nav>
    <div class="tab-content mt-3" id="nav-tabContent">
        @include('seo::pages.settings.tabs.global')
        @include('seo::pages.settings.tabs.page')
        @include('seo::pages.settings.tabs.social')
        @include('seo::pages.settings.tabs.webmaster')
        @include('seo::pages.settings.tabs.sitemap')
        @include('seo::pages.settings.tabs.robot')

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