<div class="form-group col-sm-6">
    <label for="{{$tag->id}}">{{$tag->input_label}}</label>
    <br/>
    @if($tag->input_type=='file')
        <div class="">
            <input type="file" id="Image" name="meta[{{$tag->id}}]" class="form-control-lg">
            <span class="">
                @if(!empty($tag->content))
                    <img src="{{$tag->content}}" width="120px">
                @endif
            </span>
        </div>
    @else
        <input type="{{$tag->input_type}}" name="meta[{{$tag->id}}]"
               value="@if(!empty($tag->content)){{$tag->content}}@else{{(\SEO\Models\MetaTag::hasOptions($tag->default_value)===false?$tag->default_value:'') }}@endif"
               placeholder="{{$tag->input_placeholder}}" class="form-control" id="{{$tag->id}}"
                {{(\SEO\Models\MetaTag::hasOptions($tag->default_value)!==false)?'list=datalist-'.$tag->id:''}}
        >
    @endif

    @if(\SEO\Models\MetaTag::hasOptions($tag->default_value)!==false)
        <datalist id="datalist-{{$tag->id}}">
            @foreach(\SEO\Models\MetaTag::getDefaultValue($tag->default_value) as $option)
                <option value="{{$option}}">
            @endforeach
        </datalist>
    @endif
    <span class="text-muted form-text">{{$tag->input_info}}</span>
</div>