<div class="card card-default">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-9">
                {{$record->id}}
            </div>
            <div class="col-sm-3">
                <div class="btn-group" style="float: left">
                    <a href="{{route('seo_meta_tags.edit',$record->id)}}">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{route('seo_meta_tags.show',$record->id)}}">
                        <span class="fa fa-eye"></span>
                    </a>
                    <form onsubmit="return confirm('Are you sure you want to delete?')"
                          action="{{route('@@table@@.destroy',$record->id)}}" method="post" style="display: inline">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-default cursor-pointer  btn-sm"><i
                                    class="text-danger fa fa-remove"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card-block">
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <th>Name</th>
                <td>{{$record->name}}</td>
            </tr>
            <tr>
                <th>Property</th>
                <td>{{$record->property}}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{$record->status}}</td>
            </tr>
            <tr>
                <th>Group</th>
                <td>{{$record->group}}</td>
            </tr>
            <tr>
                <th>Input Type</th>
                <td>{{$record->input_type}}</td>
            </tr>
            <tr>
                <th>Input Placeholder</th>
                <td>{{$record->input_placeholder}}</td>
            </tr>
            <tr>
                <th>Input Label</th>
                <td>{{$record->input_label}}</td>
            </tr>
            <tr>
                <th>Input Info</th>
                <td>{{$record->input_info}}</td>
            </tr>
            <tr>
                <th>Visibility</th>
                <td>{{$record->visibility}}</td>
            </tr>

            </tbody>
        </table>
    </div>
</div>
