<form action="{{route('seo::pages.meta.save',$record->id)}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="seo_page_id" value="{{$record->id}}">

    @include('seo::forms.fields.page_meta_group')
    <div class="form-group text-right">
        <input type="submit" value="Save" class="btn btn-primary">
    </div>
</form>