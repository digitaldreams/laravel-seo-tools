<form action="{{route('seo::pages.meta.save',$record->id)}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="seo_page_id" value="{{$record->id}}">
    @foreach($metaTags as $group=>$tags)
        <fieldset>
            <legend>{{$group}}</legend>
            <div class="row">
                @foreach($tags as $tag)
                    <div class="form-group col-sm-6">
                        <label for="{{$tag->id}}">{{$tag->input_label}}</label>
                        <input type="{{$tag->input_type}}" name="meta[{{$tag->id}}]" value="{{$tag->content}}"
                               placeholder="{{$tag->input_placeholder}}" class="form-control" id="{{$tag->id}}">
                        <span class="text-muted form-text">{{$tag->input_info}}</span>
                    </div>

                @endforeach
            </div>
        </fieldset>
    @endforeach
    <div class="form-group text-right">
        <input type="submit" value="Save" class="btn btn-primary">
    </div>
</form>