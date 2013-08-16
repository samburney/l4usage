@extends('layouts/main')

@section('content')
<h2>{{$user->name}}</h2>
<h3>Daily Total</h3>
<h4>{{date('d F, Y', $usage['days'][0]->date)}}</h4>
<ul>
	<li>Downloaded: {{sU::bytesToSize($usage['days'][0]->downloaded_total)}}</li>
	<li>Uploaded: {{sU::bytesToSize($usage['days'][0]->uploaded_total)}}</li>
</ul>
<h3>Hourly Usage</h3>
<table class="table table-striped">
	<tr>
		<th>Date</th>
		<th>Downloaded</th>
		<th>Uploaded</th>
	</tr>
@foreach($usage['hours'] as $hour)
	@if($hour)
	<tr>
		<td>{{date('H:i', $hour->date)}}</td>
		<td>{{sU::bytesToSize($hour->downloaded)}}</td>
		<td>{{sU::bytesToSize($hour->uploaded)}}</td>
	</tr>
	@endif
@endforeach
</table>
@endsection