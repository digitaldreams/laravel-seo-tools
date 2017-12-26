<div class="tab-pane fade" id="nav-sitemap" role="tabpanel" aria-labelledby="nav-sitemap-tab">
    <form action="{{route('seo::settings.store')}}" method="post">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="entries_per_sitemap">Entries per sitemap page</label>
                <input type="number" class="form-control" id="entries_per_sitemap"
                       value="{{$model->getValueByKey('entries_per_sitemap')}}"
                       name="settings[entries_per_sitemap][value]"
                       placeholder="">
            </div>
            <div class="form-group col-sm-6">
                <label for="page_changefreq">How frequently the page is likely to change</label>
                <input type="text" class="form-control" id="page_changefreq" list="available_change_freq"
                       name="settings[page_changefreq][value]"
                       value="{{$model->getValueByKey('page_changefreq')}}"
                       placeholder="">
                <datalist id="available_change_freq">
                    <option value="always"/>
                    <option value="hourly"/>
                    <option value="daily"/>
                    <option value="weekly"/>
                    <option value="monthly"/>
                    <option value="yearly"/>
                    <option value="yearly"/>
                    <option value="never"/>

                </datalist>
            </div>
            <div class="form-group col-sm-6">
                <label for="page_priority">Priority of this URL</label>
                <input type="number" class="form-control" id="page_priority"
                       name="settings[page_priority][value]"
                       value="{{$model->getValueByKey('page_priority')}}"
                       placeholder="" min="0" max="1.0" step="0.1">
                <div class="form-text text-muted">
                    The priority of this URL relative to other URLs on your site. Valid values range from 0.0 to 1.0.
                    This value does not affect how your pages are compared to pages on other sites—it only lets the
                    search engines know which pages you deem most important for the crawlers.


                </div>
            </div>
        </div>

        <div class="form-group text-right">
            <input type="submit" value="Save" class="btn btn-primary">
        </div>
    </form>
    <div class="help-block">
        <a href="https://www.google.com/webmasters/tools/sitemap-list?pli=1">
            Submit your Sitemap
        </a>
    </div>
</div>