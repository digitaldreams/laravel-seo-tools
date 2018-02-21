@extends(config('seo.layout'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('seo::dashboard.index')}}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('seo::pages.index')}}">Pages</a></li>
    <li class="breadcrumb-item">{{pathinfo($record->path,PATHINFO_BASENAME)}}</li>
@endsection
@section('tools')
    &nbsp;
    <a href="{{route('seo::pages.edit',$record->id)}}"><i class="fa fa-pencil"></i></a>
    &nbsp;
    <a target="_blank" href="{{url($record->path)}}">Visit Page</a>
    &nbsp;&nbsp;
    <a target="_blank"
       href="https://developers.facebook.com/tools/debug/sharing/?q={{urlencode($record->getFullUrl())}}">
        <i class="fa fa-facebook-official"></i> Facebook Validate
    </a>
    &nbsp;&nbsp;
    <a href="https://cards-dev.twitter.com/validator" target="_blank">
        <i class="fa fa-twitter"></i> Twiter Card Validate
    </a>
    &nbsp;
    <a target="_blank"
       href="https://developers.google.com/speed/pagespeed/insights/?url={{urlencode($record->getFullUrl())}}">
        <i class="fa fa-google"></i> Google Page Speed
    </a>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>Meta Title</th>
                    <td>
                        @if($title->length)
                            <span class="h4"><i
                                        class="fa fa-check-circle-o text-primary"></i> {{$title->item(0)->nodeValue}}</span>
                        @else
                            <i class="fa fa-remove text-danger fa-3x"></i>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Meta Description</th>
                    <td>
                        @if($description->length)

                            <span class=""><i class="fa fa-check-circle-o text-primary"></i>
                                @foreach($description[0]->attributes as $attr)
                                    @if($attr->name=='content')
                                        {{$attr->nodeValue}}
                                    @endif
                                @endforeach
                               </span>
                        @else
                            <i class="fa fa-remove text-danger fa-3x"></i>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>H1 heading status</th>
                    <td>
                        @if($h1->length >0)
                            <label class="badge badge-secondary fa-2x"><b>{{$h1->length}}</b> <i
                                        class="fa fa-check-circle-o text-primary"></i></label>
                        @else
                            <i class="fa fa-remove text-danger fa-3x"></i>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>H2 heading status</th>
                    <td>
                        @if($h2->length >0)
                            <label class="badge badge-secondary fa-2x"><b>{{$h2->length}}</b> <i
                                        class="fa fa-check-circle-o text-primary"></i></label>
                        @else
                            <i class="fa fa-remove text-danger fa-2x"></i>
                        @endif

                    </td>
                </tr>
                <tr>
                    <th>H3 heading status</th>
                    <td>
                        @if($h3->length >0)
                            <label class="badge badge-secondary "><b class="h3">{{$h3->length}} <i
                                            class="fa fa-check-circle-o text-primary"></i></b> </label>
                        @else
                            <i class="fa fa-remove text-danger fa-2x"></i>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>HTML Page Size</th>
                    <td>{{round($length / 1000)}} KB</td>
                </tr>
                <tr>
                    <th>CSS File</th>
                    <td>
                        <div id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="card">
                                <div class="card-title" role="tab" id="headingOne">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                           aria-expanded="false" aria-controls="collapseOne">
                                            &nbsp;&nbsp;{{$css->length}} file found <i class="fa fa-arrow-down"></i>
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse hide" role="tabpanel"
                                     aria-labelledby="headingOne">
                                    <div class="card-block">
                                        <table class="table table-striped">
                                            <tbody>
                                            @foreach($css as $file)
                                                @foreach($file->attributes as $attr)
                                                    @if($attr->name=='href')
                                                        <tr>
                                                            <td> {{$attr->nodeValue}}</td>
                                                            <td>
                                                                {{round(\SEO\Services\Helper::fileSize($attr->nodeValue)/1000)}}
                                                                KB
                                                            </td>
                                                        </tr>

                                                    @endif
                                                @endforeach
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Scripts File</th>
                    <td>
                        <div id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="card">
                                <div class="card-title" role="tab" id="headingTwo">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                                           aria-expanded="false" aria-controls="collapseTwo">
                                            &nbsp;&nbsp;{{$css->length}} file found <i class="fa fa-arrow-down"></i>
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapseTwo" class="collapse hide" role="tabpanel"
                                     aria-labelledby="headingTwo">
                                    <div class="card-block">
                                        <table class="table table-striped">
                                            <tbody>
                                            @foreach($scripts as $file)
                                                @foreach($file->attributes as $attr)
                                                    @if($attr->name=='src')
                                                        <tr>
                                                            <td> {{$attr->nodeValue}}</td>
                                                            <td>
                                                                {{round(\SEO\Services\Helper::fileSize($attr->nodeValue)/1000)}}
                                                                KB
                                                            </td>
                                                        </tr>

                                                    @endif
                                                @endforeach
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Loading Time</th>
                    <td><a href="#">Update To Pro</a></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-3">
            @if(count($images) >0)
                @foreach($images as $image)
                    <div class="card mb-2">
                        <?php if (isset($image['src']) && !empty($image['src'])): ?>
                        <img src="{{$image['src']}}" class="card-img-top img-responsive">
                        <?php endif; ?>
                        <div class="card-body mb-0 p-1">
                            <div class="card-title">
                                <?php if (isset($image['alt']) && !empty($image['alt'])): ?>
                                <small class="text-muted">{{$image['alt']}}</small>
                                <?php else: ?>
                                <i class="fa fa-remove text-danger fa-2x"></i> No Alt attribute found
                                <?php endif?>
                            </div>
                        </div>
                        <div class="card-footer p-0">
                            <?php if (isset($image['src']) && !empty($image['src']) && @getimagesize($image['src'])): ?>

                            @php
                                $info= @getimagesize($image['src'])
                            @endphp
                            @if(isset($info[0]) && isset($info[1]))
                                &nbsp;<label class="badge badge-secondary"> {{$info[0]}}px x {{$info[1]}}px</label>
                            @endif
                            @if(isset($info['mime']))
                                <label class="badge badge-secondary">{{$info['mime']}}</label>
                            @endif
                            &nbsp;
                            <label class="badge badge-secondary">
                                {{round(\SEO\Services\Helper::fileSize($image['src']) /1000)}} kb
                            </label>
                            <?php endif; ?>
                        </div>
                    </div>
                @endforeach

            @else
                <i class="fa fa-remove text-danger fa-2x"></i> No image found
            @endif
        </div>
    </div>
@endSection