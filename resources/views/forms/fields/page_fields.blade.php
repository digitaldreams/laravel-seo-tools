<div class="row">
    <div class="form-group col-sm-6">
        <label for="title">Title <i class="fa fa-info" title="This will be shown on browser tab."></i></label>
        <input type="text" class="form-control" name="title" id="title"
               value="{{old('title',$model->getTitle())}}"
               placeholder="" maxlength="100">

        @if($errors->has('title'))
            <span class="form-control-feedback">
                 <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-sm-3">
        <label for="robot_index">Robot Index</label>
        <select class="form-control" name="robot_index" id="robot_index">
            <option value="index" {{old('robot_index',$model->robot_index)=='index'?'selected':''}}>Index
            </option>
            <option value="noindex" {{old('robot_index',$model->robot_index)=='noindex'?'selected':''}}>No
                Index
            </option>
        </select>

        @if($errors->has('robot_index'))
            <span class="form-control-feedback">
                     <strong>{{ $errors->first('robot_index') }}</strong>
                </span>
        @endif
    </div>
    <div class="form-group col-sm-3">
        <label for="robot_follow">Robot Follow</label>
        <select class="form-control" name="robot_follow" id="robot_follow">
            <option value="follow" {{old('robot_follow',$model->robot_follow)=='follow'?'selected':''}}>Follow
            </option>
            <option value="nofollow" {{old('robot_follow',$model->robot_follow)=='nofollow'?'selected':''}}>No
                Follow
            </option>
        </select>

        @if($errors->has('robot_follow'))
            <span class="form-control-feedback">
                     <strong>{{ $errors->first('robot_follow') }}</strong>
                 </span>
        @endif
    </div>

</div>
<div class="form-group">
    <label for="canonical_url">Canonical Url</label>
    <input type="text" class="form-control" name="canonical_url" id="canonical_url"
           value="{{old('canonical_url',$model->canonical_url)}}" placeholder="" maxlength="255">
    @if($errors->has('canonical_url'))
        <span class="form-control-feedback">
        <strong>{{ $errors->first('canonical_url') }}</strong>
    </span>
    @endif
</div>


<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" name="description" id="description" placeholder="Meta description"
              maxlength="170">{{old('title',$model->getDescription())}}</textarea>


    @if($errors->has('description'))
        <span class="form-control-feedback">
                 <strong>{{ $errors->first('description') }}</strong>
            </span>
    @endif
</div>