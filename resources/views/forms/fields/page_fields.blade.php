<div class="row">
    <div class="form-group col-sm-6">
        <label for="page_title">Title <i class="fa fa-info" title="This will be shown on browser tab."></i></label>
        <input type="text" class="form-control" name="page[title]" id="page_title"
               value="{{old('page.title',$model->getTitle())}}" required
               placeholder="Page Title" maxlength="100">

        @if($errors->has('page.title'))
            <span class="form-control-feedback">
                 <strong>{{ $errors->first('page.title') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-sm-3">
        <label for="page_robot_index">Robot Index</label>
        <select class="form-control" name="page[robot_index]" id="page_robot_index">
            <option value="">Default</option>
            <option value="index" {{old('page.robot_index',$model->robot_index)=='index'?'selected':''}}>Index
            </option>
            <option value="noindex" {{old('page.robot_index',$model->robot_index)=='noindex'?'selected':''}}>No
                Index
            </option>
        </select>

        @if($errors->has('page.robot_index'))
            <span class="form-control-feedback">
                     <strong>{{ $errors->first('page.robot_index') }}</strong>
                </span>
        @endif
    </div>
    <div class="form-group col-sm-3">
        <label for="page_robot_follow">Robot Follow</label>
        <select class="form-control" name="page[robot_follow]" id="page_robot_follow">
            <option value="">Default</option>
            <option value="follow" {{old('page.robot_follow',$model->robot_follow)=='follow'?'selected':''}}>Follow
            </option>
            <option value="nofollow" {{old('page.robot_follow',$model->robot_follow)=='nofollow'?'selected':''}}>No
                Follow
            </option>
        </select>

        @if($errors->has('page.robot_follow'))
            <span class="form-control-feedback">
                     <strong>{{ $errors->first('page.robot_follow') }}</strong>
                 </span>
        @endif
    </div>
</div>

@if(isset($showPageUrl) && !empty($showPageUrl))
    <div class="form-group">
        <label for="page_path">Page Url</label>
        <input type="text" class="form-control" name="page[path]" id="page_path"
               value="{{old('page.path',$model->path)}}"
               placeholder="Relative path to your page" maxlength="255" required="required">
        @if($errors->has('page.path'))
            <span class="form-control-feedback">
        <strong>{{ $errors->first('page.path') }}</strong>
    </span>
        @endif
    </div>
@endif

<div class="form-group">
    <label for="page_canonical_url">Canonical Url</label>
    <input type="text" class="form-control" name="page[canonical_url]" id="page_canonical_url"
           value="{{old('page.canonical_url',$model->canonical_url)}}" placeholder="" maxlength="255">
    @if($errors->has('page.canonical_url'))
        <span class="form-control-feedback">
        <strong>{{ $errors->first('page.canonical_url') }}</strong>
    </span>
    @endif
</div>


<div class="form-group">
    <label for="page_description">Description</label>
    <textarea class="form-control" name="page[description]" id="page_description" placeholder="Meta description"
              maxlength="170">{{old('page.description',$model->getDescription())}}</textarea>


    @if($errors->has('page.description'))
        <span class="form-control-feedback">
                 <strong>{{ $errors->first('page.description') }}</strong>
            </span>
    @endif
</div>