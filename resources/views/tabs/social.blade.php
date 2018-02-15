<div class="tab-pane show active" id="nav-social" role="tabpanel" aria-labelledby="nav-social-tab">
    <form action="{{route('seo::settings.store')}}" method="post">
        {{csrf_field()}}


        <div class="form-group row">
            <label for="facebook_page_url" class="col-sm-2 col-form-label"><i class="fa fa-facebook-official"></i>
                Facebook URL</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="url" class="form-control" name="settings[facebook_page_url][value]"
                           value="{{$model->getValueByKey('facebook_page_url')}}"
                           id="facebook_page_url" placeholder="Facebook profile url">
                </div>

            </div>
        </div>

        <div class="form-group row">
            <label for="twitter_username" class="col-sm-2 col-form-label"><i class="fa fa-twitter"></i>
                Twitter Username</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control"
                           name="settings[twitter_username][value]"
                           value="{{$model->getValueByKey('twitter_username')}}"
                           id="twitter_username" placeholder="Twitter username">
                </div>

            </div>
        </div>

        <div class="form-group row">
            <label for="instagram_url" class="col-sm-2 col-form-label"><i class="fa fa-instagram"></i>
                Instagram URL</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="url" class="form-control" value="{{$model->getValueByKey('instagram_url')}}"
                           id="instagram_url" name="settings[instagram_url][value]"
                           placeholder="Instagram profile url">
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="google_plus_url" class="col-sm-2 col-form-label"><i class="fa fa-google-plus-official"></i>
                Google + URL</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="url" class="form-control" value="{{$model->getValueByKey('google_plus_url')}}"
                           id="google_plus_url" name="settings[google_plus_url][value]"
                           placeholder="Google Plus profile url">

                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="linkedin_url" class="col-sm-2 col-form-label"><i class="fa fa-linkedin"></i>
                LinkedIn URL</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="url" class="form-control" value="{{$model->getValueByKey('linkedin_url')}}"
                           id="linkedin_url" name="settings[linkedin_url][value]"
                           placeholder="LinkedIn Profile Url">

                </div>
            </div>
        </div>
        <div class="form-group text-right">
            <input type="submit" class="btn btn-primary" value="Save">
        </div>
    </form>
</div>