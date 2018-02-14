@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item">Pages</li>
@endsection
@section('tools')
    &nbsp;&nbsp;
    <a href="{{route('seo::pages.create')}}"><i class="fa fa-plus"></i></a>
    @if(count(config('seo.linkProviders'))>0)
        &nbsp;&nbsp;
        <a href="{{route('seo::pages.generate')}}">Generate Page</a>
    @endif
    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#uploadPageCsv">
        <i class="fa fa-cloud-upload"></i> Upload CSV
    </button>
    <a href="{{route('seo::pages.download')}}" class="btn btn-outline-primary btn-sm">
        <i class="fa fa-download"></i> Download CSV
    </a>
    <a href="{{route('seo::pages.zip')}}" class="btn btn-outline-primary btn-sm">
        <i class="fa fa-file-zip-o"></i> Download Zip
    </a>
    @if(config('seo.cache.enable'))
        <form action="{{route('seo::pages.cache')}}" method="post" style="display: inline">
            {{csrf_field()}}
            <input type="submit" value="Refresh Cache" class="btn btn-outline-primary btn-sm">
        </form>
    @endif

@endsection
@section('content')
    <div class="row">
        @foreach($records as $record)
            <div class="col-sm-6">
                @include('seo::cards.page')
            </div>
        @endforeach
    </div>
    {!! $records->render() !!}
    @include('seo::modals.page_upload')
@endSection