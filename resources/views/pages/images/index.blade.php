@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.index')}}">Pages</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.show',$page->id)}}">{{$page->path}}</a></li>
    <li class="breadcrumb-item">Images</li>

@endsection
@section('header')
    <h3>Images</h3>
@endsection
@section('tools')
    <a href="{{route('seo::pages.show',['page'=>$page->id])}}">Visit Page</a>
    <a href="{{route('seo::pages.images.create',['page'=>$page->id])}}"><i class="fa fa-plus"></i></a>
@endsection
@section('content')
    <div class="card-deck">
        @foreach($records->chunk(3) as $recordChunk)
            @foreach($recordChunk as $record)
                <div class="card">
                    <img class="card-img-top" src="{{$record->getSrc()}}" alt="{{$record->title}}">
                    <div class="card-body">
                        <h4 class="card-title">{{$record->caption}} &nbsp;&nbsp;
                            <a href="{{route('seo::pages.images.edit',['page'=>$page->id,'pageImage'=>$record->id])}}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            @include('seo::forms.destroy',['route'=>route('seo::pages.images.destroy',['page'=>$page->id,'pageImage'=>$record->id])])
                        </h4>
                        <p class="card-text">{{$record->title}}</p>
                        <p class="card-text">
                            <small class="text-muted"><i class="fa fa-map-marker"></i> {{$record->location}}</small>
                        </p>
                    </div>
                </div>
            @endforeach
        @endforeach
        @if($records->count()==0)
            <div class="alert alert-info">No Image found. <a href="{{route('seo::pages.images.create',$page->id)}}">Add
                    One</a>
            </div>
        @endif
    </div>
@endSection