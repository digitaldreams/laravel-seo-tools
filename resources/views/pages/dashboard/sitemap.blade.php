@extends(config('seo.layout'))
@section('header')
    <i class="fa fa-code text-muted"></i> XML SiteMap Manger
@endsection
@section('tools')

@endsection
@section('content')
    <form action="{{route('seo::sitemap.update')}}" method="post">
        {{csrf_field()}}

        <table class="table table-secondary table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Path</th>
                <th data-toggle="tooltip" title="How frequently the page is likely to change">Change Frequency</th>
                <th data-toggle="tooltip" title="      The priority of this URL relative to other URLs on your site. Valid values range from 0.0 to 1.0.
                    This value does not affect how your pages are compared to pages on other sites—it only lets the
                    search engines know which pages you deem most important for the crawlers.">Priority
                </th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
                <tr>
                    <input type="hidden" value="{{$page->id}}" name="page_id[]"/>
                    <td>{{$page->id}}</td>
                    <td><a href="{{route('seo::pages.meta',$page->id)}}"> {{$page->getShortPath()}}</a></td>
                    <td>
                        <select class="form-control" id="change_frequency_{{$page->id}}" name="change_frequency[]">
                            <option value="always" {{$page->getChangeFrequency()=='always'?'selected':''}}>Always
                            </option>
                            <option value="hourly" {{$page->getChangeFrequency()=='hourly'?'selected':''}}>Hourly
                            </option>
                            <option value="daily" {{$page->getChangeFrequency()=='daily'?'selected':''}}>Daily</option>
                            <option value="weekly" {{$page->getChangeFrequency()=='weekly'?'selected':''}}>Weekly
                            </option>
                            <option value="monthly" {{$page->getChangeFrequency()=='monthly'?'selected':''}}>Monthly
                            </option>
                            <option value="yearly" {{$page->getChangeFrequency()=='yearly'?'selected':''}}>Yearly
                            </option>
                            <option value="never" {{$page->getChangeFrequency()=='never'?'selected':''}}>Never</option>
                        </select>
                    </td>
                    <td>

                        <input type="number" class="form-control" id="page_priority"
                               name="priority[]"
                               value="{{$page->getPriority()}}"
                               placeholder="" min="0" max="1.0" step="0.1">
                    </td>
                    <td>
                        <a href="{{route('seo::pages.meta',$page->id)}}"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td></td>
                <td colspan="2">{!! $pages->render() !!}</td>
                <td colspan="2" class="text-right">
                    <input type="submit" class="btn btn-primary btn-block" value="Save">
                </td>
            </tr>
            </tfoot>
        </table>
    </form>


    <div class="row mb-2">
        <div class="col-sm-12">
            <ul class="list-group">
                <li class="list-group-item list-group-item-heading list-group-item-primary">
                    Your SiteMaps &nbsp;&nbsp; &nbsp;&nbsp;
                    <form action="{{route('seo::sitemap.generate')}}" method="post" style="display: inline">
                        {{csrf_field()}}
                        <input type="submit" value="Generate" class="btn btn-primary btn-sm">
                    </form>
                </li>
                @foreach($sitemaps as $sitemap)
                    <li class="list-group-item"><a target="_blank" href="{{$sitemap}}">{{$sitemap}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="help-block">
        <a href="https://www.google.com/webmasters/tools/sitemap-list?pli=1">
            Submit your Sitemap
        </a>
    </div>
@endSection