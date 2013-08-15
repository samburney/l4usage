<?php
/**
* 
*/
class AdminController extends BaseController
{
	function getUserIndex()
	{
		$users = User::join('hours', 'users.id', '=', 'hours.user_id')
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
				'users.created_at',
				'users.updated_at'
			)
			->paginate(20);

		//debug($users->toArray());
		return View::make('admin/index')
			->with('users', $users);
	}

	function getUser($id)
	{
		$user = User::with('hour_totals')->find($id);
		debug($user->toArray());
	}

	function getUserEdit($id)
	{
		$user = User::with('hour_totals')->find($id);

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