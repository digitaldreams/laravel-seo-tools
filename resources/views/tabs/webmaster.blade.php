<div class="tab-pane fade" id="nav-webmaster" role="tabpanel" aria-labelledby="nav-webmaster-tab">
    <form action="{{route('seo::settings.store')}}" method="post">
        {{csrf_field()}}
        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">
                Bing Webmaster Tools
            </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name=settings[bing_webmaster_tools]"
                       value="{{$model->getValueByKey('bing_webmaster_tools')}}" id="colFormLabel"
                       placeholder="Bing webmaster tools">
            </div>
        </div>
        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">
                Google Search Console
            </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="settings[google_webmaster_tools]"
                       value="{{$model->getValueByKey('google_webmaster_tools')}}" id="colFormLabel"
                       placeholder="Google Search Console">
            </div>
        </div>
        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">
                Yandex Webmaster Tools
            </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="settings[yandex_webmaster_tools]"
                       value="{{$model->getValueByKey('yandex_webmaster_tools')}}" id="colFormLabel"
                       placeholder=" Yandex Webmaster Tools">
            </div>
        </div>
        <div class="form-group text-right">
            <input type="submit" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>