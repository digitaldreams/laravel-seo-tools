@extends('seo::layouts.app')
@section('content')
    <div class="row">
        <div class='col-md-12'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <div class="row">
                        <div class="col-sm-8">
                            <h4>
                                Edit {{$model->path}}
                            </h4>
                        </div>
                        <div class="col-sm-4 text-right">
                            <a href="{{route('pages.create')}}">
                                <span class="glyphicon glyphicon-plus"></span> seo_pages
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @include('seo::forms.pages',[
                    'route'=>route('pages.update',$model->id),
                    'method'=>'PUT'
                    ])
                </div>
            </div>
        </div>
    </div>
@endSection