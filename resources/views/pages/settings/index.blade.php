@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item">Settings</li>
@endsection
@section('content')
    <nav class="nav nav-tabs" id="seo-settings-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-global-tab" data-toggle="tab" href="#nav-global" role="tab"
           aria-controls="nav-global" aria-selected="true">Global
        </a>

        <a class="nav-item nav-link" id="nav--page-meta-tags-tab" data-toggle="tab" href="#nav-page-meta-tags"
           role="tab"
           aria-controls="nav-page-meta-tags" aria-selected="false">Global Meta
        </a>

    </nav>
    <div class="tab-content mt-3" id="nav-tabContent">
        @include('seo::tabs.site')
        @include('seo::tabs.page')
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