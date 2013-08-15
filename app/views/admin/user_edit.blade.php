@extends('layouts.main')

@section('content')
<h3>Edit User</h3>
{{Former::open()}}
{{Former::populate($user)}}
{{Former::text('name')}}
{{Former::text('cn')}}
<div class="col-lg-8 text-center">
	{{Former::submit()}}
</div>
{{Former::close()}}
@endsection