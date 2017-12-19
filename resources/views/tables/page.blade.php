<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Path</th>
        <th>Robot Index</th>
        <th>Robot Follow</th>
        <th>Canonical Url</th>
        <th>Title</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    @foreach($records as $record)
        <td> <a href="{{route('seo::pages.show',$record->id)}}"> {{$record->path }} </a></td>
        <td> {{$record->robot_index }} </td>
        <td> {{$record->robot_follow }} </td>
        <td> {{$record->canonical_url }} </td>
        <td> {{$record->title }} </td>
        <td><a href="{{route('seo::pages.edit',$record->id)}}">
                <span class="fa fa-pencil"></span>
            </a>
            <a href="{{route('seo::pages.show',$record->id)}}">
                <span class="fa fa-eye"></span>
            </a>
        </td>

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