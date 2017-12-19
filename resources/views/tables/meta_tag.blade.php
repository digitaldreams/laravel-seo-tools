<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Info</th>
        <th>name</th>
        <th>property</th>
        <th>status</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    @foreach($metaTags as $record)
        <tr>
            <td> {{$record->input_info }} </td>
            <td> {{$record->name }} </td>
            <td> {{$record->property }} </td>
            <td> {{$record->status }} </td>
            <td>
                <a href="{{route('seo::meta-tags.edit',$record->id)}}">
                    <span class="fa fa-pencil"></span>
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="5">
            {!! $metaTags->render() !!}
        </td>
    </tr>
    </tfoot>
</table>