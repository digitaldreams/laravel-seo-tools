<form action="{{isset($route)?$route : route('seo::meta-tags.store')}}" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="{{isset($method)?$method:'POST' }}"/>
    <div class="row">
        <div class="form-group col-sm-6">
            <div class="input-group input-group-sm">
                <span class="input-group-addon" id=" sizing-addon1">Name</span>
                <input type="text" class="form-control" name="name" id="name" value="{{old('name',$model->name)}}"
                       placeholder="Met Tag name property e.g. description" maxlength="50">
            </div>
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <div class="input-group input-group-sm">
                <span class="input-group-addon" id=" sizing-addon1">Property</span>
                <input type="text" class="form-control" name="property" id="property"
                       value="{{old('property',$model->property)}}" placeholder="" maxlength="100">
            </div>

            @if($errors->has('property'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('property') }}</strong>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <div class="input-group input-group-sm">
                <span class="input-group-addon" id=" sizing-addon1">Title</span>
                <input type="text" class="form-control" name="input_label" id="input_label"
                       value="{{old('input_label',$model->input_label)}}" placeholder="Input Title" maxlength="255">
            </div>

            @if($errors->has('input_label'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('input_label') }}</strong>
                </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <div class="input-group input-group-sm">
                <span class="input-group-addon" id=" sizing-addon1">Placeholder</span>
                <input type="text" class="form-control" name="input_placeholder" id="input_placeholder"
                       value="{{old('input_placeholder',$model->input_placeholder)}}"
                       placeholder="Placeholder of your input tag." maxlength="255">
            </div>
            @if($errors->has('input_placeholder'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('input_placeholder') }}</strong>
                </div>
            @endif
        </div>

    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <div class="input-group input-group-sm">
                <span class="input-group-addon" id=" sizing-addon1">Info</span>
                <input type="text" class="form-control" name="input_info" id="input_info"
                       value="{{old('input_info',$model->input_info)}}" placeholder="General description of your tag"
                       maxlength="255">
            </div>
            @if($errors->has('input_info'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('input_info') }}</strong>
                </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <div class="input-group input-group-sm">
                <span class="input-group-addon" id=" sizing-addon1">Default Value</span>
                <input type="text" class="form-control" name="default_value" id="default_value"
                       value="{{old('default_value',$model->default_value)}}" placeholder="Default value"
                       maxlength="255">
                <span class="input-group-addon" id=" sizing-addon1"><i class="fa fa-info-circle"
                                                                       title="If you want a dropdown selection then seperate each option with | "></i></span>
            </div>
            @if($errors->has('default_value'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('default_value') }}</strong>
                </div>
            @endif
        </div>
    </div>


    <div class="row">
        <div class="form-group col-sm-3">
            <label for="status">Status</label>

            <div class="btn-group btn-group-sm" data-toggle="buttons">
                <label class="btn btn-secondary {{old('status',$model->status)=='active'?'active':''}}">
                    <input type="radio" name="status" id="option1"
                           autocomplete="off" {{old('status',$model->status)=='active'?'checked':''}} value="active">
                    Active
                </label>
                <label class="btn btn-secondary {{old('status',$model->status)=='inactive'?'active':''}}">
                    <input type="radio" name="status" id="option2"
                           autocomplete="off"
                           {{old('status',$model->status)=='inactive'?'checked':''}} value="inactive"> Inactive
                </label>
            </div>
            @if($errors->has('status'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('status') }}</strong>
                </div>
            @endif
        </div>

        <div class="form-group col-sm-3">
            <div class="input-group input-group-sm">
                <span class="input-group-addon" id=" sizing-addon1">Group</span>
                <input type="text" class="form-control" name="group" id="group" value="{{old('group',$model->group)}}"
                       placeholder="" maxlength="50">
            </div>
            @if($errors->has('group'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('group') }}</strong>
                </div>
            @endif
        </div>

        <div class="form-group col-sm-3">
            <div class="input-group input-group-sm">
                <span class="input-group-addon" id=" sizing-addon1">Input Type</span>
                <select class="form-control" name="input_type" id="input_type">
                    <option value="text" {{old('input_type',$model->input_type)=='text'?'selected':''}}>Text</option>
                    <option value="textarea" {{old('input_type',$model->input_type)=='textarea'?'selected':''}}>Text
                        Area
                    </option>
                    <option value="number" {{old('input_type',$model->input_type)=='number'?'selected':''}}>Number
                    </option>
                    <option value="url" {{old('input_type',$model->input_type)=='url'?'selected':''}}>URL</option>
                    <option value="file" {{old('input_type',$model->input_type)=='file'?'selected':''}}>File</option>

                    <option value="email" {{old('input_type',$model->input_type)=='email'?'selected':''}}>Email</option>
                    <option value="date" {{old('input_type',$model->input_type)=='date'?'selected':''}}>Date</option>
                    <option value="datetime" {{old('input_type',$model->input_type)=='datetime'?'selected':''}}>Date
                        Time
                    </option>
                    <option value="time" {{old('input_type',$model->input_type)=='time'?'selected':''}}>Time</option>
                </select>
            </div>
            @if($errors->has('input_type'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('input_type') }}</strong>
                </div>
            @endif
        </div>


        <div class="form-group col-sm-3">
            <label for="visibility">Visibility</label>
            <div class="btn-group btn-group-sm" data-toggle="buttons">
                <label class="btn btn-secondary {{old('visibility',$model->visibility)=='page'?'active':''}}">
                    <input type="radio" name="visibility" id="option1"
                           autocomplete="off" {{old('status',$model->visibility)=='page'?'checked':''}} value="page">
                    Page
                </label>
                <label class="btn btn-secondary {{old('visibility',$model->visibility)=='global'?'active':''}}">
                    <input type="radio" name="visibility" id="option2"
                           autocomplete="off"
                           {{old('status',$model->visibility)=='global'?'checked':''}} value="global"> Global
                </label>
            </div>

            <div class="invalid-feedback">
                <strong>{{ $errors->first('visibility') }}</strong>
            </div>
        </div>

    </div>

    <div class="form-group text-right ">
        <input type="reset" class="btn btn-default" value="Clear"/>
        <input type="submit" class="btn btn-primary" value="Save"/>

    </div>
</form>
