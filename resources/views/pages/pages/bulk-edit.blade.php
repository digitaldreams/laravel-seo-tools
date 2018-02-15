@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item">@include('seo::includes.site-nav-dropdown',['menu'=>'Pages'])</li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.index')}}">Pages</a></li>
@endsection
@section('tools')
    <a href="{{route('seo::pages.create')}}"><i class="fa fa-plus"></i></a>
@endsection
@section('content')
    <form action="{{route('seo::pages.bulkUpdate')}}" method="post">
        {{csrf_field()}}

        <table class="table table-secondary table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th style="width: 40%">Title</th>
                <th>Description</th>
                <th>Robot Index</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $key=>$page)
                <input type="hidden" name="page_id[]" value="{{$page->id}}"/>
                <tr class="mb-0 pb-0">
                    <td rowspan="2" class="align-content-end mb-0 pb-0">
                        {{$page->id}}
                    </td>
                    <td colspan="2" class="mb-0 pb-0">
                        <a href="{{route('seo::pages.meta',$page->id)}}"> {{$page->getShortPath()}}</a>
                    </td>
                    <td colspan="2" class="text-right mb-0 pb-0">
                        <div class="btn-group btn-group-toggle btn-group-sm" data-toggle="buttons">
                            <label class="btn btn-secondary btn-sm  {{$page->robot_index=='index'?'active':''}}">
                                <input type="radio" name="robot_index[{{$key}}]" value="index"
                                       autocomplete="off" {{$page->robot_index=='index'?'checked':''}} > On
                            </label>
                            <label class="btn btn-secondary btn-sm {{$page->robot_index=='noindex'?'active':''}}">
                                <input type="radio" name="robot_index[{{$key}}]" value="noindex"
                                       autocomplete="off" {{$page->robot_index=='noindex'?'checked':''}}> Off
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="mb-0 pb-lg-1">
                        <input type="text" name="title[]" value="{{$page->getTitle()}}"
                               class="form-control form-control-sm" maxlength="70"></td>
                    <td colspan="4" class="mb-0 pb-lg-1">
                        <textarea name="description[]" maxlength="170"
                                  class="form-control form-control-sm">{{$page->getDescription()}}</textarea>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    {!! $pages->render() !!}
                </td>
                <td>
                    <input type="submit" value="Save" class="btn btn-primary btn-block">
                </td>
            </tr>
            </tfoot>
        </table>
@endSection