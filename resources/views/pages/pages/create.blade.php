@extends(config('seo.layout'))
@section('header')
    <i class="fa fa-plus text-muted"></i> New Page
@endsection
@section('tools')
    <input type="submit" class="btn btn-primary" form="SeoFormPage" value="Save"/>

@endsection
@section('content')
    <div class="row">
        <div class='col-md-12'>
            <div class='panel panel-default'>
                <div class="panel-body">
                    @include('seo::forms.page',['showPageUrl'=>true])
                </div>
            </div>
        </div>
    </div>
@endSection