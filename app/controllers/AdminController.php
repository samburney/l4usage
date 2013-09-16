<?php
/**
* 
*/
class AdminController extends BaseController
{
	function getUserIndex()
	{
		$from['year'] = Input::get('from_year') ? Input::get('from_year') : date('Y');
		$from['month'] = Input::get('from_month') ? Input::get('from_month') : date('m');
		$from['day'] = Input::get('from_day') ? Input::get('from_day') : date('1');

		$to['year'] = Input::get('to_year') ? Input::get('to_year') : date('Y');
		$to['month'] = Input::get('to_month') ? Input::get('to_month') : date('m');
		$to['day'] = Input::get('to_day') ? Input::get('to_day') : date('t');

		$from_hours = hours($from['year'], $from['month'], $from['day']);
		$to_hours = hours($to['year'], $to['month'], $to['day']);

		$users = User::join('hours', 'users.id', '=', 'hours.user_id')
			->where('date', '>=', $from_hours['day']['start'])
			->where('date', '<=', $to_hours['day']['end'])
			->groupBy('users.id')
			->orderBy(
				Input::get('sort') ? Input::get('sort') : 'name',
				Input::get('direction') ? Input::get('direction') : 'asc'
			)
			->select(
				'users.id',
				'name',
				'cn',
				'lastip',
				'firstseen',
				'lastseen',
				DB::raw('sum(uploaded) as uploaded_total'),
				DB::raw('sum(downloaded) as downloaded_total'),
				DB::raw('(sum(uploaded) + sum(downloaded)) as total_total'),
				'users.created_at',
				'users.updated_at'
			)
			->paginate(20);

		$years = Hour::select
		(
			DB::raw('min(date) as date_min'),
			DB::raw('max(date) as date_max')
		)
		->first();

		return View::make('admin/index')
			->with(compact('users', 'years', 'from', 'to'));
	}

	function getUserEdit($id)
	{
		$user = User::find($id);

		return View::make('admin/user_edit')
			->with('user', $user);
	}

	function postUserEdit($id)
	{
		$user = User::find($id);
		$user->fill(Input::all());
		$user->save();

		return Redirect::to(URL::to('/admin/users'));
	}
}