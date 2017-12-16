<div class="tab-pane fade" id="nav-social" role="tabpanel" aria-labelledby="nav-social-tab">
    <form action="{{route('seo::settings.store')}}" method="post">
        {{csrf_field()}}


        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-2 col-form-label"><i class="fa fa-facebook-official"></i>
                Facebook URL</label>
            <div class="col-sm-10">
                <input type="url" class="form-control" name="settings[facebook_page_url]"
                       value="{{$model->getValueByKey('facebook_page_url')}}"
                       id="colFormLabel" placeholder="Facebook profile url">
            </div>
        </div>

        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-2 col-form-label"><i class="fa fa-twitter"></i>
                Twitter Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"
                       name="settings[twitter_username]" value="{{$model->getValueByKey('twitter_username')}}"
                       id="colFormLabel" placeholder="Twitter username">
            </div>
        </div>

        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-2 col-form-label"><i class="fa fa-instagram"></i>
                Instagram URL</label>
            <div class="col-sm-10">
                <input type="url" class="form-control" value="{{$model->getValueByKey('instagram_url')}}"
                       id="colFormLabel" name="settings[instagram_url]"
                       placeholder="Instagram profile url">
            </div>
        </div>

        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-2 col-form-label"><i class="fa fa-google-plus-official"></i>
                Google + URL</label>
            <div class="col-sm-10">
                <input type="url" class="form-control" value="{{$model->getValueByKey('google_plus_url')}}"
                       id="colFormLabel" name="settings[google_plus_url]"
                       placeholder="Google Plus profile url">
            </div>
        </div>

        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-2 col-form-label"><i class="fa fa-linkedin"></i>
                LinkedIn URL</label>
            <div class="col-sm-10">
                <input type="url" class="form-control" value="{{$model->getValueByKey('linkedin_url')}}"
                       id="colFormLabel" name="settings[linkedin_url]"
                       placeholder="LinkedIn Profile Url">
            </div>
        </div>
        <div class="form-group text-right">
            <input type="submit" class="btn btn-primary" value="Save">
        </div>
    </form>
</div>