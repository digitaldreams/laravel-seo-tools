<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Path</th>
        <th>Robot</th>
        <th>Canonical Url</th>
        <th>Title</th>
        <th>Description</th>
        <th>Images</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    @foreach($records as $record)
        <tr>
            <td><a href="{{route('seo::pages.show',$record->id)}}"> {{$record->path }} </a></td>
            <td>
                <label class="badge badge-secondary">{{$record->robot_index }}</label>
                <label class="badge badge-secondary">{{$record->robot_follow }}</label>
            </td>
            <td> {{$record->canonical_url }} </td>
            <td> {{$record->getTitle() }} </td>
            <td> {{$record->getDescription() }} </td>
            <td> {{$record->page_images_count }} </td>
            <td>
                <a href="{{route('seo::pages.edit',$record->id)}}">
                    <span class="fa fa-pencil"></span>
                </a>
                <a href="{{route('seo::pages.show',$record->id)}}">
                    <span class="fa fa-eye"></span>
                </a>
                @include('seo::forms.destroy',['route'=>route('seo::pages.destroy',$record->id)])

            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="7">
            {{{$records->render()}}}
        </td>
    </tr>
    </tfoot>
</table>