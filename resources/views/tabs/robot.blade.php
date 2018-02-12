<div class="tab-pane show active" id="nav-robot-txt" role="tabpanel" aria-labelledby="nav-robot-txt-tab">
    <form action="{{route('seo::settings.robot_txt')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <textarea name="robot_txt" class="form-control"
                      placeholder="Content of your robot.txt"><?php $robotTxt = new \SEO\Services\RobotTxt();echo $robotTxt->get(); ?></textarea>
            <small id="site-title-help" class="form-text text-muted">Please write content here carefully. It will read
                by bot.
            </small>
            <a class="lead text-primary" href="https://moz.com/learn/seo/robotstxt">Learn more about Robot.txt</a>

        </div>
        <div class="form-group text-right">
            <input type="submit" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>