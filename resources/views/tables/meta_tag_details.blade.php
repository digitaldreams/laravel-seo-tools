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
                @include('seo::forms.destroy',['route'=>route('seo::meta-tags.destroy',$record->id)])
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