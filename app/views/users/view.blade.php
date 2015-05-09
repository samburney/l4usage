@extends('layouts/main')

@section('content')
<h2>{{$user->name}}</h2>
<h3>Usage Summary</h3>
<form>
	<select name="month">
	@for($i = 1; $i <= 12; $i++)
		<option value="{{$i}}"<? if($from['month'] == $i){ ?> selected="selected"<? }?>>{{date('F', strtotime(date('Y') . "-$i-01"))}}</option>
	@endfor
	</select>
	<select name="year">
	@for($i = 2010; $i <= date('Y'); $i++)
		<option value="{{$i}}"<? if($from['year'] == $i){ ?> selected="selected"<? }?>>{{$i}}</option>
	@endfor
	</select>
	<input type="submit" name="submit" value="Go">	
</form>
<h4>{{date('F', strtotime(date('Y') . "-" . $from['month'] . "-01"))}} {{$from['year']}}</h4>
@if(isset($usage['months'][0]))
<ul>
	<li>Downloaded: {{sU::bytesToSize($usage['months'][0]->downloaded_total)}}</li>
	<li>Uploaded: {{sU::bytesToSize($usage['months'][0]->uploaded_total)}}</li>
</ul>
@else
<i><b>There is no usage data available for this period.</b></i>
@endif
<h4>All time</h4>
<ul>
	<li>Downloaded: {{sU::bytesToSize($user->hour_totals()->first()->downloaded_total)}}</li>
	<li>Uploaded: {{sU::bytesToSize($user->hour_totals()->first()->uploaded_total)}}</li>
</ul>
@if(isset($usage['months'][0]))
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
@endif
@endsection