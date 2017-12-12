@extends('seo::layouts.app')
@section('content')
    <div class="row">
        <div class='col-md-12'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <div class="row">
                        <div class="col-sm-8">
                            <h4>
                                Create Pages
                            </h4>
                        </div>
                        <div class="col-sm-4 text-right">
                            <a href="{{route('pages.index')}}">
                                <span class="glyphicon glyphicon-list"> Pages</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @include('seo::forms.page')
                </div>
            </div>
        </div>
    </div>
@endSection