<form action="{{$route or route('seo::pages.store')}}" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="{{$method or 'POST'}}"/>
    @include('seo::forms.fields.page_fields')
    <div class="form-group">
        <label for="path">Page Url</label>
        <input type="text" class="form-control" name="path" id="path" value="{{old('path',$model->path)}}"
               placeholder="Relative path to your page" maxlength="255" required="required">
        @if($errors->has('path'))
            <span class="form-control-feedback">
        <strong>{{ $errors->first('path') }}</strong>
    </span>
        @endif
    </div>
    <div class="form-group text-right ">
        <input type="reset" class="btn btn-default" value="Clear"/>
        <input type="submit" class="btn btn-primary" value="Save"/>
    </div>
</form>