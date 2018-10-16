<form action="{{isset($route)?$route:route('seo_settings.store')}}" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="{{isset($method)?$method:'POST'}}"/>
    <div class="form-group {{ $errors->has('key') ? ' has-danger' : '' }}">
        <label for="key">Key</label>
        <input type="text" class="form-control" name="key" id="key" value="{{old('key',$model->key)}}" placeholder=""
               maxlength="100" required="required">
        @if($errors->has('key'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('key') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group {{ $errors->has('value') ? ' has-danger' : '' }}">
        <label for="value">Value</label>
        <input type="text" class="form-control" name="value" id="value" value="{{old('value',$model->value)}}"
               placeholder="" maxlength="255">
        @if($errors->has('value'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('value') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group {{ $errors->has('status') ? ' has-danger' : '' }}">
        <label for="status">Status</label>
        <input type="text" class="form-control" name="status" id="status" value="{{old('status',$model->status)}}"
               placeholder="" maxlength="255" required="required">
        @if($errors->has('status'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('status') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group {{ $errors->has('group') ? ' has-danger' : '' }}">
        <label for="group">Group</label>
        <input type="text" class="form-control" name="group" id="group" value="{{old('group',$model->group)}}"
               placeholder="" maxlength="255">
        @if($errors->has('group'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('group') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group {{ $errors->has('label') ? ' has-danger' : '' }}">
        <label for="label">Label</label>
        <input type="text" class="form-control" name="label" id="label" value="{{old('label',$model->label)}}"
               placeholder="" maxlength="255">
        @if($errors->has('label'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('label') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group {{ $errors->has('description') ? ' has-danger' : '' }}">
        <label for="description">Description</label>
        <input type="text" class="form-control" name="description" id="description"
               value="{{old('description',$model->description)}}" placeholder="" maxlength="255">
        @if($errors->has('description'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('description') }}</strong>
            </div>
        @endif
    </div>


    <div class="form-group text-right ">
        <input type="reset" class="btn btn-default" value="Clear"/>
        <input type="submit" class="btn btn-primary" value="Save"/>

    </div>
</form>