<form action="{{$route or route('seo::meta-tags.store')}}" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="{{$method or 'POST'}}"/>
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{old('name',$model->name)}}"
                   placeholder="" maxlength="50">
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <label for="property">Property</label>
            <input type="text" class="form-control" name="property" id="property"
                   value="{{old('property',$model->property)}}" placeholder="" maxlength="100">
            @if($errors->has('property'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('property') }}</strong>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="input_label">Input Label</label>
            <input type="text" class="form-control" name="input_label" id="input_label"
                   value="{{old('input_label',$model->input_label)}}" placeholder="" maxlength="255">
            @if($errors->has('input_label'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('input_label') }}</strong>
                </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <label for="input_placeholder">Input Placeholder</label>
            <input type="text" class="form-control" name="input_placeholder" id="input_placeholder"
                   value="{{old('input_placeholder',$model->input_placeholder)}}" placeholder="" maxlength="255">
            @if($errors->has('input_placeholder'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('input_placeholder') }}</strong>
                </div>
            @endif
        </div>

    </div>

    <div class="form-group {{ $errors->has('input_info') ? ' has-danger' : '' }}">
        <label for="input_info">Input Info</label>
        <input type="text" class="form-control" name="input_info" id="input_info"
               value="{{old('input_info',$model->input_info)}}" placeholder="" maxlength="255">
        @if($errors->has('input_info'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('input_info') }}</strong>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="form-group col-sm-3">
            <label for="status">Status</label>
            <input type="text" class="form-control" name="status" id="status" value="{{old('status',$model->status)}}"
                   placeholder="" maxlength="50" required="required">
            @if($errors->has('status'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('status') }}</strong>
                </div>
            @endif
        </div>

        <div class="form-group col-sm-3">
            <label for="group">Group</label>
            <input type="text" class="form-control" name="group" id="group" value="{{old('group',$model->group)}}"
                   placeholder="" maxlength="50">
            @if($errors->has('group'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('group') }}</strong>
                </div>
            @endif
        </div>

        <div class="form-group col-sm-3">
            <label for="input_type">Input Type</label>
            <input type="text" class="form-control" name="input_type" id="input_type"
                   value="{{old('input_type',$model->input_type)}}" placeholder="" maxlength="50" required="required">
            @if($errors->has('input_type'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('input_type') }}</strong>
                </div>
            @endif
        </div>


        <div class="form-group col-sm-3">
            <label for="visibility">Visibility</label>
            <input type="text" class="form-control" name="visibility" id="visibility"
                   value="{{old('visibility',$model->visibility)}}" placeholder="" maxlength="50" required="required">
            @if($errors->has('visibility'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('visibility') }}</strong>
                </div>
            @endif
        </div>

    </div>











    <div class="form-group text-right ">
        <input type="reset" class="btn btn-default" value="Clear"/>
        <input type="submit" class="btn btn-primary" value="Save"/>

    </div>
</form>