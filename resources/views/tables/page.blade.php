<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Path</th>
        <th>Route Name</th>
        <th>Robot Index</th>
        <th>Robot Follow</th>
        <th>Canonical Url</th>
        <th>Title</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    @foreach($records as $record)
        <td> {{$record->path }} </td>
        <td> {{$record->route_name }} </td>
        <td> {{$record->robot_index }} </td>
        <td> {{$record->robot_follow }} </td>
        <td> {{$record->canonical_url }} </td>
        <td> {{$record->title }} </td>
        <td><a href="{{'pages.edit',$record->id}}">
                <span class="fa fa-pencil"></span>
            </a>
            <a href="{{'pages.show'}}">
                <span class="fa fa-eye"></span>
            </a>}}
        </td>

    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="3">
            {{{$records->render()}}}
        </td>
    </tr>
    </tfoot>
</table>