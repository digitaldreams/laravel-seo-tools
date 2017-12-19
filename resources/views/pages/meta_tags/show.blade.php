@extends('seo::layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-8">
            <h1>
                {{$record->id}}
            </h1>
        </div>
        <div class="col-sm-4 text-right">
            <div class="btn-group btn-group-sm">

                <a href="{{'seo_meta_tags.create'}}">
                    <span class="fa fa-plus"></span>
                </a>
                <a href="{{route('seo_meta_tags.edit',$record->id)}}">
                    <span class="fa fa-pencil"></span>
                </a>
                <form onsubmit="return confirm('Are you sure you want to delete?')"
                      action="{{route('seo_meta_tags.destroy',$record->id)}}" method="post" style="display: inline">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-default cursor-pointer  btn-sm"><i
                                class="text-danger fa fa-remove"></i></button>
                </form>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            @include('cards.seo_meta_tag')
        </div>
    </div>
@endSection