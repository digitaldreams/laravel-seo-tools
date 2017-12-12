<form action="{{$route or route('seo_pages.store')}}" method="POST"  >
    {{csrf_field()}}
    <input type="hidden" name="_method" value="{{$method or 'POST'}}"/>
        <div class="form-group {{ $errors->has('path') ? ' has-danger' : '' }}">
        <label for="path">Path</label>
        <input type="text" class="form-control" name="path" id="path" value="{{old('path',$model->path)}}" placeholder="" maxlength="255" required="required" >
          @if($errors->has('path'))
    <span class="form-control-feedback">
        <strong>{{ $errors->first('path') }}</strong>
    </span>
  @endif 
    </div>

    <div class="form-group {{ $errors->has('route_name') ? ' has-danger' : '' }}">
        <label for="route_name">Route Name</label>
        <input type="text" class="form-control" name="route_name" id="route_name" value="{{old('route_name',$model->route_name)}}" placeholder="" maxlength="150" >
          @if($errors->has('route_name'))
    <span class="form-control-feedback">
        <strong>{{ $errors->first('route_name') }}</strong>
    </span>
  @endif 
    </div>

    <div class="form-group {{ $errors->has('robot_index') ? ' has-danger' : '' }}">
        <label for="robot_index">Robot Index</label>
        <input type="text" class="form-control" name="robot_index" id="robot_index" value="{{old('robot_index',$model->robot_index)}}" placeholder="" maxlength="50" >
          @if($errors->has('robot_index'))
    <span class="form-control-feedback">
        <strong>{{ $errors->first('robot_index') }}</strong>
    </span>
  @endif 
    </div>

    <div class="form-group {{ $errors->has('robot_follow') ? ' has-danger' : '' }}">
        <label for="robot_follow">Robot Follow</label>
        <input type="text" class="form-control" name="robot_follow" id="robot_follow" value="{{old('robot_follow',$model->robot_follow)}}" placeholder="" maxlength="50" >
          @if($errors->has('robot_follow'))
    <span class="form-control-feedback">
        <strong>{{ $errors->first('robot_follow') }}</strong>
    </span>
  @endif 
    </div>

    <div class="form-group {{ $errors->has('canonical_url') ? ' has-danger' : '' }}">
        <label for="canonical_url">Canonical Url</label>
        <input type="text" class="form-control" name="canonical_url" id="canonical_url" value="{{old('canonical_url',$model->canonical_url)}}" placeholder="" maxlength="255" >
          @if($errors->has('canonical_url'))
    <span class="form-control-feedback">
        <strong>{{ $errors->first('canonical_url') }}</strong>
    </span>
  @endif 
    </div>

    <div class="form-group {{ $errors->has('title') ? ' has-danger' : '' }}">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="{{old('title',$model->title)}}" placeholder="" maxlength="100" >
          @if($errors->has('title'))
    <span class="form-control-feedback">
        <strong>{{ $errors->first('title') }}</strong>
    </span>
  @endif 
    </div>


    <div class="form-group text-right ">
        <input type="reset" class="btn btn-default" value="Clear"/>
        <input type="submit" class="btn btn-primary" value="Save"/>

    </div>
</form>