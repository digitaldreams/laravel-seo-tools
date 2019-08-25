@extends(config('seo.layout'))
@section('header')
    <i class="fa fa-file text-muted"></i> Pages
@endsection
@section('tools')
    &nbsp;&nbsp;
    <div class="btn-group">

        @if(count(config('seo.linkProviders'))>0)
            <a class="btn btn-outline-secondary" href="{{route('seo::pages.generate')}}">Generate Page</a>
        @endif
        <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#uploadPageCsv">
            <i class="fa fa-cloud-upload"></i> Upload CSV
        </button>
        <a href="{{route('seo::pages.download')}}" class="btn btn-outline-secondary">
            <i class="fa fa-download"></i> Download CSV
        </a>
        <a href="{{route('seo::pages.zip')}}" class="btn btn-outline-secondary">
            <i class="fa fa-file-zip-o"></i> Download Zip
        </a>
        @if(config('seo.cache.enable'))
            <form action="{{route('seo::pages.cache')}}" method="post" style="display: inline">
                {{csrf_field()}}
                <input type="submit" value="Refresh Cache" class="btn btn-outline-secondary">
            </form>
        @endif
        <a href="{{route('seo::pages.bulkEdit')}}" class="btn btn-outline-secondary">
            <i class="fa fa-pencil-square-o"></i> Bulk Edit
        </a>
        <a class="btn btn-outline-secondary" href="{{route('seo::pages.create')}}"><i class="fa fa-plus"></i></a>
    </div>
@endsection
@section('content')
    <form method="get" class="m-form">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group m-form__group">
                    <div class="input-group">
                        <div class="input-group-append">
                            <select name="object" class="form-control">
                                <option value="">All</option>
                                @foreach($objects as $object)
                                    <option value="{{$object}}"
                                            {{request('object')==$object?'selected':''}}>
                                        {{$object}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="text" name="search" class="form-control"
                               value="{{$_GET['search']??''}}"
                               placeholder="Search for .. product name, brand, model">
                        <div class="input-group-append">
                            <button class="btn btn-light text-primary m--font-boldest" type="submit"><i
                                        class="fa fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-right">
                {!! $records->appends(['object'=>request('object'),'search'=>request('search')])->render() !!}
            </div>
        </div>
    </form>
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