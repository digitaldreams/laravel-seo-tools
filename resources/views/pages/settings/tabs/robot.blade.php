<div class="tab-pane fade" id="nav-robot-txt" role="tabpanel" aria-labelledby="nav-robot-txt-tab">
    <form action="{{route('seo::settings.store')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <textarea name="settings[robot_txt][value]" class="form-control"
                      placeholder="Content of your robot.txt">{{$model->getValueByKey('robot_txt')}}</textarea>
            <small id="site-title-help" class="form-text text-muted">Please write content here carefully. It will read
                by Google bot.
            </small>

        </div>
        <div class="form-group text-right">
            <input type="submit" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>