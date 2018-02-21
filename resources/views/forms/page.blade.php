<form action="{{$route or route('seo::pages.store')}}" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="{{$method or 'POST'}}"/>
    @include('seo::includes.page_meta_tags')

    <div class="form-group text-right mt-2 ">
        <input type="reset" class="btn btn-default" value="Clear"/>
        <input type="submit" class="btn btn-primary" value="Save"/>
    </div>
</form>