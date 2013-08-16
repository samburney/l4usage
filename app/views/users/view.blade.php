@extends('layouts/main')

@section('content')
<h2>{{$user->name}}</h2>
<h3>Usage Summary</h3>
<h4>{{date('F, Y')}}</h4>
<ul>
	<li>Downloaded: {{sU::bytesToSize($usage['months'][0]->downloaded_total)}}</li>
	<li>Uploaded: {{sU::bytesToSize($usage['months'][0]->uploaded_total)}}</li>
</ul>
<h4>All time</h4>
<ul>
	<li>Downloaded: {{sU::bytesToSize($user->hour_totals()->first()->downloaded_total)}}</li>
	<li>Uploaded: {{sU::bytesToSize($user->hour_totals()->first()->uploaded_total)}}</li>
</ul>
<h3>Daily Usage</h3>
<table class="table table-striped">
	<tr>
		<th>Date</th>
		<th>Downloaded</th>
		<th>Uploaded</th>
	</tr>
@foreach($usage['days'] as $day)
	@if($day)
	<tr>
		<td>
			<a href="{{baseURL()}}/user/view-day/{{$user->id}}/{{date('Y', $day->date)}}/{{date('m', $day->date)}}/{{date('d', $day->date)}}">
				{{date('d/m/Y', $day->date)}}
			</a>
		</td>
		<td>{{sU::bytesToSize($day->downloaded_total)}}</td>
		<td>{{sU::bytesToSize($day->uploaded_total)}}</td>
	</tr>
	@endif
@endforeach
</table>
@endsection