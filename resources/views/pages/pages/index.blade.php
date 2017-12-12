@extends('seo::layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-3">
            <h4>Pages</h4>
        </div>
        <div class="col-sm-6">

        </div>
        <div class="col-sm-1">
            <a href="{{route('pages.create')}}"><span class="glyphicon glyphicon-plus"></span></a>
        </div>
    </div>
    @include('seo::tables.pages')
    {!! $records->render() !!}
@endSection