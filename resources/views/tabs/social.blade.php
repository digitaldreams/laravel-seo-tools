<div class="tab-pane show active" id="nav-social" role="tabpanel" aria-labelledby="nav-social-tab">
    <form action="{{route('seo::settings.store')}}" method="post" enctype="multipart/form-data">
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
            <label for="facebook_default_image" class="col-sm-2 col-form-label"><i class="fa fa-facebook-official"></i>
                Facebook Default Image</label>
            <div class="col-sm-10">
                <div class="">
                    <input type="file" id="facebook_default_image" name="settings[facebook_default_image][value]"
                           class="form-control-lg"
                           placeholder="e.g. Upload your image">
                    @if($url=$model->getValueByKey('facebook_default_image'))
                        <img src="{{$url}}" width="120px">
                    @endif
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
            <label for="facebook_default_image" class="col-sm-2 col-form-label"><i class="fa fa-facebook-official"></i>
                Twitter Default Image</label>
            <div class="col-sm-10">
                <div class="">
                    <input type="file" id="twitter_default_image" name="settings[twitter_default_image][value]"
                           class="form-control-lg"
                           placeholder="e.g. Upload your image">
                    @if($turl=$model->getValueByKey('twitter_default_image'))
                        <img src="{{$turl}}" width="120px">
                    @endif
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