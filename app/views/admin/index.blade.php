@extends('layouts.main')

@section('content')
	<h3>All Users</h3>
	<table class="table table-striped">
		<tr>
			<th>
				<a href="?page={{Paginator::getCurrentPage()}}&amp;sort=name&amp;direction={{Input::get('direction') == 'asc' && Input::get('sort') == 'name'  ? 'desc' : 'asc'}}">
					User Name
				</a>
			</th>
			<th>Certificate CN</th>
			<th>IP Address</th>
			<th>
				<a href="?page={{Paginator::getCurrentPage()}}&amp;sort=lastseen&amp;direction={{Input::get('direction') == 'asc' && Input::get('sort') == 'lastseen' ? 'desc' : 'asc'}}">
					Last Seen
				</a>
			</th>
			<th>
				<a href="?page={{Paginator::getCurrentPage()}}&amp;sort=downloaded_total&amp;direction={{Input::get('direction') == 'asc' && Input::get('sort') == 'downloaded_total' ? 'desc' : 'asc'}}">
					Downloaded
				</a>
			</th>
			<th>
				<a href="?page={{Paginator::getCurrentPage()}}&amp;sort=uploaded_total&amp;direction={{Input::get('direction') == 'asc' && Input::get('sort') == 'uploaded_total' ? 'desc' : 'asc'}}">
					Uploaded
				</a>
			</th>
			<th>Actions</th>
		</tr>
	@foreach($users as $user)
		<tr>
			<td>{{$user->name}}</td>
			<td>{{$user->cn}}</td>
			<td>{{$user->lastip}}</td>
			<td>{{date("d/m/Y H:i:s", $user->lastseen)}}</td>
			<td>{{$user->downloaded_total}}</td>
			<td>{{$user->uploaded_total}}</td>
			<td>
				<a href="{{baseURL()}}/admin/user/edit/{{$user->id}}" class="btn btn-primary btn-xs">Edit</a>
			</td>
		</tr>
	@endforeach		
	</table>
<div class="text-center">
	{{$users->links()}}
</div>
@endsection