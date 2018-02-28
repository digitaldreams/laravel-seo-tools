@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item">Analysis</li>
@endsection

@section('content')
    <form method="get">
        <div class="row">
            <div class="form-group col-5">
                <div class="input-group">
                    <div class="input-group-addon">
                        Url
                    </div>
                    <input type="url" name="url" value="{{request('url')}}" id="page_url" class="form-control">
                </div>
            </div>
            <div class="form-group col-5">
                <div class="input-group">
                    <div class="input-group-addon">
                        Keyword
                    </div>
                    <input type="search" name="keyword" value="{{request('keyword')}}" id="page_keyword" class="form-control">
                </div>
            </div>
            <div class="form-group col-2">
                <input type="submit" value="Go" class="btn btn-outline-primary">
            </div>
        </div>


    </form>
    @include('seo::includes.analysis')
@endSection