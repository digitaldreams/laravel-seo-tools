@foreach($metaTags as $group=>$tags)
    <fieldset>
        <legend>{{$group}}</legend>
        <div class="row">
            @foreach($tags as $tag)
                @include('seo::forms.tag')
            @endforeach
        </div>
    </fieldset>
@endforeach