<?php
class UserController extends BaseController
{
	function getView($id)
	{
		$user = User::with('hour_totals')->find($id);

		$from['year'] = Input::get('year') ? Input::get('year') : date('Y');
		$from['month'] = Input::get('month') ? Input::get('month') : date('m');

		$hours = hours($from['year'], $from['month']);
		$usage['months'] = $user->usage_months($hours['month']['start']);
		$usage['days'] = $user->usage_days($hours['month']['start'], $hours['month']['end']);

		return View::make('users/view')
			->with('from', $from)
			->with('user', $user)
			->with('usage', $usage);
	}

	function getViewDay($id, $year, $month, $day)
	{
		$user = User::find($id);

		$hours = hours($year, $month, $day);
		$usage['days'] = $user->usage_days($hours['day']['start']);
		$usage['hours'] = $user->usage_hours($hours['day']['start'], $hours['day']['end']);

		return View::make('users/view_day')
			->with('user', $user)
			->with('usage', $usage);

	}
}
?>