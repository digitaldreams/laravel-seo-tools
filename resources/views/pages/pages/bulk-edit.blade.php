@extends(config('seo.layout'))
@section('header')
    <i class="fa fa-pencil text-muted"></i> Pages
@endsection
@section('tools')
    <a class="btn btn-outline-secondary" href="{{route('seo::pages.create')}}">
        <i class="fa fa-plus"></i> New Page
    </a>
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
                            <label class="btn btn-secondary btn-sm  {{old('robot_index.'.$key,$page->robot_index)=='index'?'active':''}}">
                                <input type="radio" name="robot_index[{{$key}}]" value="index"
                                       autocomplete="off" {{old('robot_index.'.$key,$page->robot_index)=='index'?'checked':''}} >
                                On
                            </label>
                            <label class="btn btn-secondary btn-sm {{old('robot_index.'.$key,$page->robot_index)=='noindex'?'active':''}}">
                                <input type="radio" name="robot_index[{{$key}}]" value="noindex"
                                       autocomplete="off" {{old('robot_index.'.$key,$page->robot_index)=='noindex'?'checked':''}}>
                                Off
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="mb-0 pb-lg-1">
                        <input type="text" name="title[]" value="{{$page->getTitle()}}"
                               class="form-control form-control-sm {{$errors->has('title.'.$key)?'is-invalid':''}}"
                               maxlength="70">
                        @if($errors->has('title.'.$key))
                            <div class="invalid-feedback">
                                <span>{{$errors->first('title.'.$key)}}</span>
                            </div>
                        @endif
                    </td>
                    <td colspan="4" class="mb-0 pb-lg-1">
                        <textarea name="description[]" maxlength="170"
                                  class="form-control form-control-sm {{$errors->has('description.'.$key)?'is-invalid':''}}">{{$page->getDescription()}}</textarea>
                        @if($errors->has('description.'.$key))
                            <div class="invalid-feedback">
                                <span>{{$errors->first('description.'.$key)}}</span>
                            </div>
                        @endif
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