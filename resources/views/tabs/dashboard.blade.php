<div class="tab-pane fade show active" id="nav-dashboard" role="tabpanel" aria-labelledby="nav-dashboard-tab">
    <article>
        <h1>On Page Seo Tool for Laravel</h1>
        <p class="mb-lg-5 mt-lg-3 lead">
            By using this tool you can easily about to insert on page seo tags like title, meta tags, scripts, webmaster
            validation, robot.txt file content. It also generate site map of your site with one click.
            You can able to import and export meta tags by csv or excel file.
        </p>
    </article>

    <div class="row">
        <div class='col-md-4'>
            <div class="card">
                <div class="card-header">
                    <a href="{{route('seo::settings.index')}}">Settings</a>
                </div>
                <div class="card-body">
                    <p class="card-text lead"><span style="font-size: 60px"><b>{{$setting_total or 0 }}</b></span>
                        Global settings</p>
                </div>
            </div>
        </div>
        <div class='col-md-4'>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">
                            <a href="{{route('seo::pages.index')}}">Pages</a>
                        </div>
                        <div class="col-sm-4">
                            <a href="{{route('seo::pages.create')}}"> <i class="fa fa-plus"></i> Create </a>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text lead"><span style="font-size: 60px"><b>{{$page_total or 0 }}</b></span>
                        Pages that are optimized
                    </p>
                </div>
            </div>
        </div>
        <div class='col-md-4'>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">
                            <a href="{{route('seo::meta-tags.index')}}">Meta Tags</a>
                        </div>
                        <div class="col-sm-4 text-right">
                            <a href="{{route('seo::meta-tags.create')}}"> <i class="fa fa-plus"></i> Create </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text lead"><span style="font-size: 60px"><b>{{$meta_tag_total or 0 }}</b></span> Meta
                        Tags </p>
                </div>
            </div>
        </div>

    </div>
    <h3 class="mt-lg-3">Social Media</h3>
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">Facebook</div>
                        <div class="col-sm-8">
                            <a href="https://developers.facebook.com/tools/debug">Validation</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">Twitter</div>
                        <div class="col-sm-8">
                            <a href=" https://developer.twitter.com/en/docs/tweets/optimize-with-cards/guides/getting-started">Guide</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="card bg-light mt-lg-3">
        <div class="card-body">
            <p>Do not have knowledge about On Page SEO. Thats no problem. <a href="https://moz.com/learn/seo">
                    Here is an awesome tutorial series on moz.com</a>. That teaches you all
            </p>
        </div>

    </div>
</div>