<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Title</th>
        <th>Info</th>
        <th>Name</th>
        <th>Property</th>
        <th>Status</th>
        <th>Group</th>
        <th>Input Type</th>
        <th>Input Placeholder</th>
        <th>Visibility</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    @foreach($records as $record)
        <tr>
            <td> {{$record->input_label }} </td>
            <td> {{$record->input_info }} </td>
            <td> {{$record->name }} </td>
            <td> {{$record->property }} </td>
            <td> {{$record->status }} </td>
            <td> {{$record->group }} </td>
            <td> {{$record->input_type }} </td>
            <td> {{$record->input_placeholder }} </td>
            <td> {{$record->visibility }} </td>
            <td>
                <a href="{{route('seo::meta-tags.edit',$record->id)}}">
                    <span class="fa fa-pencil"></span>
                </a>
                <form onsubmit="return confirm('Are you sure you want to delete?')"
                      action="{{route('seo::meta-tags.destroy',$record->id)}}" method="post" style="display: inline">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-default cursor-pointer  btn-sm"><i
                                class="text-danger fa fa-remove"></i></button>
                </form>
            </td>
        </tr>

    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="10">
            {{{$records->render()}}}
        </td>
    </tr>
    </tfoot>
</table>