<table class="table table-bordered table-striped text-small">
    <thead>
    <tr>
        <th>ID</th>
        <th>Path</th>
        <th>Title</th>
        <th>Description</th>
        <th>Robot</th>
        <th>Images</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    @foreach($records as $record)
        <tr>
            <td>{{$record->id}}</td>
            <td><a href="{{route('seo::pages.show',$record->id)}}"> {{$record->path }} </a></td>

            <td> {{$record->getTitle() }} </td>
            <td> {{$record->getDescription() }} </td>
            <td>
                <label class="badge badge-secondary">{{$record->robot_index }}</label>
                <label class="badge badge-secondary">{{$record->robot_follow }}</label>
            </td>
            <td><a href="{{route('seo::pages.images.index',$record->id)}}">{{$record->page_images_count }}</a></td>
            <td>
                <a href="{{route('seo::pages.meta',$record->id)}}">
                    <span class="fa fa-pencil"></span>
                </a>
                &nbsp;
                <a target="_blank" href="{{url($record->path)}}">Visit Page</a>
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