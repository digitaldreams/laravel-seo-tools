<form action="" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    @foreach($metaTags as $group=>$tags)
        <fieldset>
            <legend>{{$group}}</legend>
            <div class="row">
                @foreach($tags as $tag)
                    <div class="form-group col-sm-6">
                        <label for="{{$tag->id}}">{{$tag->input_label}}</label>
                        <input type="{{$tag->input_type}}" name="" value="{{$tag->content}}"
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