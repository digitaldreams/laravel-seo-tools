<div class="tab-pane fade" id="nav-page-meta-tags" role="tabpanel" aria-labelledby="nav-page-meta-tags-tab">
    <form action="{{route('seo::meta-tags.global')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @foreach($metaTags as $group=>$tags)
            <fieldset>
                <legend>{{ucfirst($group)}}</legend>
                <div class="row">
                    @foreach($tags as $tag)
                        @include('seo::forms.tag')
                    @endforeach
                </div>
            </fieldset>
        @endforeach
        <div class="form-group text-right">
            <input type="submit" class="btn btn-primary">
        </div>
    </form>
</div>