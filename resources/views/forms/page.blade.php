<form action="{{$route or route('seo::pages.store')}}" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="{{$method or 'POST'}}"/>
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
        <div class="form-group col-sm-3">

            <div class="input-group input-group-sm">
                <div class="input-group-addon">Robot Index</div>
                <select class="form-control" name="robot_index" id="robot_index">
                    <option value="index" {{old('robot_index',$model->robot_index)=='index'?'selected':''}}>Index
                    </option>
                    <option value="noindex" {{old('robot_index',$model->robot_index)=='noindex'?'selected':''}}>No
                        Index
                    </option>
                </select>
            </div>

            @if($errors->has('robot_index'))
                <span class="form-control-feedback">
                     <strong>{{ $errors->first('robot_index') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group col-sm-3">

            <div class="input-group input-group-sm">
                <div class="input-group-addon">Robot Follow</div>
                <select class="form-control" name="robot_follow" id="robot_follow">
                    <option value="follow" {{old('robot_follow',$model->robot_follow)=='follow'?'selected':''}}>Follow
                    </option>
                    <option value="nofollow" {{old('robot_follow',$model->robot_follow)=='nofollow'?'selected':''}}>No
                        Follow
                    </option>
                </select>
            </div>

            @if($errors->has('robot_follow'))
                <span class="form-control-feedback">
                     <strong>{{ $errors->first('robot_follow') }}</strong>
                 </span>
            @endif
        </div>

    </div>
    <div class="form-group">
        <div class="input-group input-group-sm">
            <div class="input-group-addon">{{url('/')}}/</div>
            <input type="text" class="form-control" name="canonical_url" id="canonical_url"
                   value="{{old('canonical_url',$model->canonical_url)}}" placeholder="" maxlength="255">
            <div class="input-group-addon">Canonical Url</div>
        </div>
        @if($errors->has('canonical_url'))
            <span class="form-control-feedback">
        <strong>{{ $errors->first('canonical_url') }}</strong>
    </span>
        @endif
    </div>
    <div class="form-group">
        <div class="input-group input-group-sm">
            <div class="input-group-addon">{{url('/')}}/</div>
            <input type="text" class="form-control" name="path" id="path" value="{{old('path',$model->path)}}"
                   placeholder="Relative path to your page" maxlength="255" required="required">
            <div class="input-group-addon">Page Url</div>
        </div>
        @if($errors->has('path'))
            <span class="form-control-feedback">
        <strong>{{ $errors->first('path') }}</strong>
    </span>
        @endif
    </div>

    <div class="form-group">
        <div class="input-group input-group-sm">
            <div class="input-group-addon">Description</div>
            <input type="text" class="form-control" name="description" id="description"
                   value="{{old('title',$model->getDescription())}}"
                   placeholder="Meta description" maxlength="170">
        </div>

        @if($errors->has('description'))
            <span class="form-control-feedback">
                 <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group text-right ">
        <input type="reset" class="btn btn-default" value="Clear"/>
        <input type="submit" class="btn btn-primary" value="Save"/>
    </div>
</form>