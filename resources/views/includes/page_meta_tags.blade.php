<div id="accordion">
    <div class="card">
        <div class="card-header m-0 p-0" id="headingOne">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="m-0 p-0">
                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true"
                                aria-controls="collapseOne">
                            Laravel SEO <i class="fa fa-info-circle"
                                           title="This is a SEO tools which helps this post to boost on Search Engine and Social Media"
                                           data-toggle="tooltip">
                            </i>
                        </a>
                    </h5>
                </div>
                <div class="col-sm-6 text-right">
                    <label class="" data-toggle="collapse" data-target="#collapseOne"
                           aria-expanded="true"
                           aria-controls="collapseOne">
                        <i class="fa fa-arrow-down"></i>
                    </label>
                    &nbsp;&nbsp;
                </div>
            </div>

        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <nav class="nav nav-tabs" id="seo-settings-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-global-tab" data-toggle="tab" href="#nav-global"
                       role="tab"
                       aria-controls="nav-global" aria-selected="true"><i class="fa fa-home"></i> Home
                    </a>

                    <a class="nav-item nav-link" id="nav-facebook-tab" data-toggle="tab" href="#nav-facebook-meta"
                       role="tab"
                       aria-controls="nav-meta"><i class="fa fa-facebook-official"></i> Facebook
                    </a>

                    <a class="nav-item nav-link" id="nav-twitter-tab" data-toggle="tab" href="#nav-twitter-meta"
                       role="tab"
                       aria-controls="nav-meta"><i class="fa fa-twitter"></i> Twitter
                    </a>

                    <a class="nav-item nav-link" id="nav-page-tab" data-toggle="tab" href="#nav-meta" role="tab"
                       aria-controls="nav-meta">Others
                    </a>
                </nav>
                <div class="tab-content mt-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-global" role="tabpanel"
                         aria-labelledby="nav-global-tab">
                        @include('seo::forms.fields.page_fields',[
                        'model'=> $record
                        ])
                    </div>

                    <div class="tab-pane fade hide" id="nav-facebook-meta" role="tabpanel"
                         aria-labelledby="nav-facebook-tab">
                        @include('seo::forms.fields.page_meta_group',['tags' => $og])
                    </div>

                    <div class="tab-pane fade hide" id="nav-twitter-meta" role="tabpanel"
                         aria-labelledby="nav-twitter-tab">
                        @include('seo::forms.fields.page_meta_group',['tags' => $twitter])
                    </div>

                    <div class="tab-pane fade hide" id="nav-meta" role="tabpanel" aria-labelledby="nav-page-tab">
                        @include('seo::forms.fields.page_meta_others')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

