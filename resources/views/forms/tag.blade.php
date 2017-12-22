<div class="form-group col-sm-6">
    <label for="{{$tag->id}}">{{$tag->input_label}}</label>
    <input type="{{$tag->input_type}}" name="meta[{{$tag->id}}]"
           value="@if(!empty($tag->content)){{$tag->content}}@else{{(\SEO\Models\MetaTag::hasOptions($tag->default_value)===false?$tag->default_value:'') }}@endif"
           placeholder="{{$tag->input_placeholder}}" class="form-control" id="{{$tag->id}}"
            {{(\SEO\Models\MetaTag::hasOptions($tag->default_value)!==false)?'list=datalist-'.$tag->id:''}}
    >
    @if(\SEO\Models\MetaTag::hasOptions($tag->default_value)!==false)
        <datalist id="datalist-{{$tag->id}}">
            @foreach(\SEO\Models\MetaTag::getDefaultValue($tag->default_value) as $option)
                <option value="{{$option}}">
            @endforeach
        </datalist>
    @endif
    <span class="text-muted form-text">{{$tag->input_info}}</span>
</div>