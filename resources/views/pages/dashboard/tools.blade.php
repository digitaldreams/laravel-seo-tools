@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item">
       @include('seo::includes.site-nav-dropdown',['menu'=>'Tools'])

    </li>
@endsection
@section('tools')

@endsection
@section('content')
    <div class="row">
        <div class="col-sm-3 col-xs-6">
            <div class="card ">
                <div class="card-body">
                    <div class="card-title">
                        Upload Your CSV file
                    </div>
                    <div class="card-text">
                        <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal"
                                data-target="#uploadPageCsv">
                            <i class="fa fa-cloud-upload"></i> Upload CSV
                        </button>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-sm-3 col-xs-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Download CSV
                    </div>
                    <div class="card-text">
                        <a href="{{route('seo::pages.download')}}" class="btn btn-outline-primary btn-block">
                            <i class="fa fa-download"></i> Download CSV
                        </a>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-sm-3 col-xs-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Download page Html
                    </div>
                    <div class="card-text">
                        <a href="{{route('seo::pages.zip')}}" class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-file-zip-o"></i> Download Zip
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-3 col-xs-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Page Bulk Edit
                    </div>
                    <div class="card-text">
                        <a href="{{route('seo::pages.bulkEdit')}}" class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-pencil-square-o"></i> Bulk Edit
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
    @include('seo::modals.page_upload')

@endSection