@extends('layouts.main')

@section('content')
	<h3>Users</h3>
	<div>
		<form>
			<b>From</b>
			Year: 
			<select id="from_year" name="from_year">
				@for($i = date('Y', $years->date_min); $i <= date('Y', $years->date_max); $i++)
				<option name="{{$i}}" <? if($i == $from['year']) { ?>selected="selected"<? } ?>>{{$i}}</option>
				@endfor
			</select>
			Month: 
			<select id="from_month" name="from_month">
				@for($i = 1; $i <= 12; $i++)
				<option name="{{$i}}" <? if($i == $from['month']) { ?>selected="selected"<? } ?>>{{$i}}</option>
				@endfor
			</select>
			Day:
			<select id="from_day" name="from_day">
				@for($i = 1; $i <= 31; $i++)
				<option name="{{$i}}" <? if($i == $from['day']) { ?>selected="selected"<? } ?>>{{$i}}</option>
				@endfor
			</select>
			<b>To</b>
			Year: 
			<select id="to_year" name="to_year">
				@for($i = date('Y', $years->date_min); $i <= date('Y', $years->date_max); $i++)
				<option name="{{$i}}" <? if($i == $to['year']) { ?>selected="selected"<? } ?>>{{$i}}</option>
				@endfor
			</select>
			Month: 
			<select id="to_month" name="to_month">
				@for($i = 1; $i <= 12; $i++)
				<option name="{{$i}}" <? if($i == $to['month']) { ?>selected="selected"<? } ?>>{{$i}}</option>
				@endfor
			</select>
			Day:
			<select id="to_day" name="to_day">
				@for($i = 1; $i <= 31; $i++)
				<option name="{{$i}}" <? if($i == $to['day']) { ?>selected="selected"<? } ?>>{{$i}}</option>
				@endfor
			</select>
			<input type="submit" name="submit" value="Go">
		</form>
	</div>
	<table class="table table-striped">
		<tr>
			<th>
				<a href="{{generate_sort_url('name')}}">
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
				<a href="{{generate_sort_url('lastseen', 'desc')}}">
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
				<a href="{{generate_sort_url('downloaded_total', 'desc')}}">
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
				<a href="{{generate_sort_url('uploaded_total', 'desc')}}">
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
			<th>
				<a href="{{generate_sort_url('total_total', 'desc')}}">
					Total
				</a>
	@if(Input::get('sort') == 'total_total')
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
			<td>{{sU::bytesToSize($user->total_total)}}</td>
			<td>
				<a href="{{baseURL()}}/admin/user/edit/{{$user->id}}" class="btn btn-primary btn-xs">Edit</a>
			</td>
		</tr>
	@endforeach		
	</table>
<div class="text-center">
	{{$users->appends(array('sort' => Input::get('sort'), 'direction' => Input::get('direction'), 'from_year' => $from['year'], 'from_month' => $from['month'], 'from_day' => $from['day'], 'to_year' => $to['year'], 'to_month' => $to['month'], 'to_day' => $to['day']))->links()}}
</div>
@endsection