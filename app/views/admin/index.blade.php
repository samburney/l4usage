@extends('layouts.main')

@section('content')
	<h3>Users</h3>
	<table class="table table-striped">
		<tr>
			<th>
				<a href="?page={{Paginator::getCurrentPage()}}&amp;sort=name&amp;direction={{Input::get('direction') == 'asc' && Input::get('sort') == 'name'  ? 'desc' : 'asc'}}">
					User Name
				</a>
	@if(Input::get('sort') == 'name')
		@if(Input::get('direction') == 'asc')
					<span class="glyphicon glyphicon-chevron-down"></span>
		@else
					<span class="glyphicon glyphicon-chevron-up"></span>
		@endif
	@endif					
			</th>
			<th>Certificate CN</th>
			<th>IP Address</th>
			<th>
				<a href="?page={{Paginator::getCurrentPage()}}&amp;sort=lastseen&amp;direction={{Input::get('direction') == 'asc' && Input::get('sort') == 'lastseen' ? 'desc' : 'asc'}}">
					Last Seen
				</a>
	@if(Input::get('sort') == 'lastseen')
		@if(Input::get('direction') == 'asc')
					<span class="glyphicon glyphicon-chevron-down"></span>
		@else
					<span class="glyphicon glyphicon-chevron-up"></span>
		@endif
	@endif					
			</th>
			<th>
				<a href="?page={{Paginator::getCurrentPage()}}&amp;sort=downloaded_total&amp;direction={{Input::get('direction') == 'asc' && Input::get('sort') == 'downloaded_total' ? 'desc' : 'asc'}}">
					Downloaded
				</a>
	@if(Input::get('sort') == 'downloaded_total')
		@if(Input::get('direction') == 'asc')
					<span class="glyphicon glyphicon-chevron-down"></span>
		@else
					<span class="glyphicon glyphicon-chevron-up"></span>
		@endif
	@endif					
			</th>
			<th>
				<a href="?page={{Paginator::getCurrentPage()}}&amp;sort=uploaded_total&amp;direction={{Input::get('direction') == 'asc' && Input::get('sort') == 'uploaded_total' ? 'desc' : 'asc'}}">
					Uploaded
				</a>
	@if(Input::get('sort') == 'uploaded_total')
		@if(Input::get('direction') == 'asc')
					<span class="glyphicon glyphicon-chevron-down"></span>
		@else
					<span class="glyphicon glyphicon-chevron-up"></span>
		@endif
	@endif					
			</th>
			<th>Actions</th>
		</tr>
	@foreach($users as $user)
		<tr>
			<td>
				<a href="{{baseURL()}}/user/view/{{$user->id}}">
					{{$user->name}}
				</a>
			</td>
			<td>{{$user->cn}}</td>
			<td>{{$user->lastip}}</td>
			<td>{{date("d/m/Y H:i:s", $user->lastseen)}}</td>
			<td>{{sU::bytesToSize($user->downloaded_total)}}</td>
			<td>{{sU::bytesToSize($user->uploaded_total)}}</td>
			<td>
				<a href="{{baseURL()}}/admin/user/edit/{{$user->id}}" class="btn btn-primary btn-xs">Edit</a>
			</td>
		</tr>
	@endforeach		
	</table>
<div class="text-center">
	{{$users->appends(array('sort' => Input::get('sort'), 'direction' => Input::get('direction')))->links()}}
</div>
@endsection