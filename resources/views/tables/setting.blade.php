<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Key</th>
        <th>Value</th>
        <th>Status</th>
        <th>Group</th>
        <th>Label</th>
        <th>Description</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    @foreach($records as $record)
        <tr>
            <td> {{$record->key }} </td>
            <td> {{$record->value }} </td>
            <td> {{$record->status }} </td>
            <td> {{$record->group }} </td>
            <td> {{$record->label }} </td>
            <td> {{$record->description }} </td>
            <td>
                <a href="{{route('seo::settings.edit',$record->id)}}">
                    <span class="fa fa-pencil"></span>
                </a>
            </td>
        </tr>

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