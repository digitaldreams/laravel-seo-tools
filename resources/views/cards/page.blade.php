<div class="card card-default">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-9">
                {{$record->id}}
            </div>
            <div class="col-sm-3">
                <div class="btn-group" style="float: left">
<a href="{{'seo_pages.edit',$record->id}}">
    <span class="fa fa-pencil"></span>
</a>
<a href="{{'seo_pages.show'}}">
    <span class="fa fa-eye"></span>
</a>
<form onsubmit="return confirm('Are you sure you want to delete?')" action="{{$route}}" method="post" style="display: inline">
    {{csrf_field()}}
    {{method_field('DELETE')}}
    <button  type="submit" class="btn btn-default cursor-pointer  btn-sm"><i class="text-danger fa fa-remove"></i></button>
</form>
                </div>
            </div>
        </div>
    </div>
    <div class="card-block">
        <table class="table table-bordered table-striped">
            <tbody>
		<tr>
			<th>Path</th>
			<td>{{$record->path}}</td>
		</tr>
		<tr>
			<th>Route Name</th>
			<td>{{$record->route_name}}</td>
		</tr>
		<tr>
			<th>Robot Index</th>
			<td>{{$record->robot_index}}</td>
		</tr>
		<tr>
			<th>Robot Follow</th>
			<td>{{$record->robot_follow}}</td>
		</tr>
		<tr>
			<th>Canonical Url</th>
			<td>{{$record->canonical_url}}</td>
		</tr>
		<tr>
			<th>Title</th>
			<td>{{$record->title}}</td>
		</tr>

            </tbody>
        </table>
    </div>
</div>
