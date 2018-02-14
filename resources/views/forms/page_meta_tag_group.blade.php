<form action="{{route('seo::pages.meta.save',$record->id)}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="seo_page_id" value="{{$record->id}}">

    <div class="row">
        @foreach($tags as $tag)
            @include('seo::forms.tag')
        @endforeach
    </div>
    <div class="form-group text-right">
        <input type="submit" value="Save" class="btn btn-primary">
    </div>
</form>