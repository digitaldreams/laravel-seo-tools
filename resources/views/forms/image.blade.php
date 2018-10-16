<form action="{{isset($route)?$route: route('seo::pages.images.store',['page'=>$page->id])}}" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="{{isset($method)?$method :'POST' }}"/>
    <div class="row">
        <div class="form-group col-sm-6">
            <div class="input-group input-group-sm">
                <div class="input-group-addon">Title</div>
                <input type="text" class="form-control" name="title" id="title"
                       value="{{old('title',$model->getTitle())}}"
                       placeholder="" maxlength="100">
            </div>

            @if($errors->has('title'))
                <span class="form-control-feedback">
                 <strong>{{ $errors->first('title') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <div class="input-group input-group-sm">
                <div class="input-group-addon">Caption</div>
                <input type="text" class="form-control" name="caption" id="caption"
                       value="{{old('caption',$model->getCaption())}}"
                       placeholder="" maxlength="100">
            </div>

            @if($errors->has('caption'))
                <span class="form-control-feedback">
                 <strong>{{ $errors->first('caption') }}</strong>
            </span>
            @endif
        </div>

    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <div class="input-group input-group-sm">
                <div class="input-group-addon">Image Source</div>
                <input type="text" class="form-control" name="src" id="src" value="{{old('src',$model->getSrc())}}"
                       placeholder="Image source" maxlength="255" required="required">
                <div class="input-group-addon">src</div>
            </div>
            @if($errors->has('src'))
                <span class="form-control-feedback">
                    <strong>{{ $errors->first('src') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <div class="input-group input-group-sm">
                <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                <input type="text" class="form-control" name="location" id="location"
                       value="{{old('location',$model->getLocation())}}"
                       placeholder="e.g. Cox's Bazar" maxlength="100" required="required">
            </div>
            @if($errors->has('location'))
                <span class="form-control-feedback">
                    <strong>{{ $errors->first('location') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group text-right ">
        <input type="reset" class="btn btn-default" value="Clear"/>
        <input type="submit" class="btn btn-primary" value="Save"/>
    </div>
</form>