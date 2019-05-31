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
                    <div class="btn-group">
                        @if(!empty($record->id))
                            <a class="btn btn-outline-secondary" target="_blank"
                               href="https://developers.facebook.com/tools/debug/sharing/?q={{urlencode($record->getFullUrl())}}">
                                <i class="fa fa-facebook-official"></i> Validate
                            </a>
                            <a class="btn btn-outline-secondary" href="https://cards-dev.twitter.com/validator" target="_blank">
                                <i class="fa fa-twitter"></i> Card Validate
                            </a>
                            <a class="btn btn-outline-secondary" target="_blank"
                               href="https://developers.google.com/speed/pagespeed/insights/?url={{urlencode($record->getFullUrl())}}">
                                <i class="fa fa-google"></i> Page Speed
                            </a>
                        @endif
                    </div>
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
                    @if(!empty($record->id))
                        <a class="nav-item nav-link" id="nav-keyword-tab" data-toggle="tab" href="#nav-keyword-analysis"
                           role="tab"
                           aria-controls="nav-meta"><i class="fa fa-search"></i> Keyword Analysis
                        </a>
                    @endif
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
                    @if(!empty($record->id))
                        <div class="tab-pane fade hide" id="nav-keyword-analysis" role="tabpanel"
                             aria-labelledby="nav-keyword-tab">

                            <div class="form-group form-group-sm">
                                <label class="" for="page_focus_keyword">Focus Keyword</label>
                                <input type="text" name="page[focus_keyword]" value="{{$record->focus_keyword}}"
                                       placeholder="e.g. Travel"
                                       class="form-control">

                                @if($errors->has('page.robot_index'))
                                    <span class="form-control-feedback">
                                        <strong>{{ $errors->first('page.focus_keyword') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @if(!empty($keywordAnalysis))
                                <div class="row">
                                    @if(isset($keywordAnalysis['good']) && !empty($keywordAnalysis['good']))
                                        <div class="col-sm-4">
                                            <div class="card border-success">
                                                <div class="card-header bg-transparent border-success">
                                                    <i class="fa fa-check-square text-success"></i> Good
                                                </div>
                                                <div class="card-body text-small">
                                                    <ul class="list-group">
                                                        @foreach($keywordAnalysis['good'] as $msg)
                                                            <li class="list-group-item">{{$msg}}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($keywordAnalysis['warnings']) && !empty($keywordAnalysis['warnings']))
                                        <div class="col-sm-4">
                                            <div class="card border-warning">
                                                <div class="card-header bg-transparent border-warning">
                                                    <i class="fa fa-warning text-warning"></i> Warnings
                                                </div>
                                                <div class="card-body">
                                                    <ul class="list-group">
                                                        @foreach($keywordAnalysis['warnings'] as $msg)
                                                            <li class="list-group-item">{{$msg}}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($keywordAnalysis['errors']) && !empty($keywordAnalysis['errors']))
                                        <div class="col-sm-4">
                                            <div class="card border-danger">
                                                <div class="card-header  bg-transparent border-danger">
                                                    <i class="fa fa-warning text-danger"></i> Errors
                                                </div>
                                                <div class="card-body">
                                                    <ul class="list-group">
                                                        @foreach($keywordAnalysis['errors'] as $msg)
                                                            <li class="list-group-item">{{$msg}}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

