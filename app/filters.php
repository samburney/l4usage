<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

function baseURL()
{
	return URL::to('');
}

// Quick function to call print_r within a HTML <pre>
function debug($arr)
{
	$backtrace = debug_backtrace();
	$file = $backtrace[0]['file'];
	$line = $backtrace[0]['line'];
	
	echo '<pre>';
	echo "<b>$file:$line</b>\n";
	print_r($arr);
	echo '</pre>';
}

function hours($year = NULL, $month = NULL, $day = NULL)
{
	$year = isset($year) ? $year : date('Y');
	$month = isset($month) ? $month : date('m');
	$day = isset($day) ? $day : date('d');

	$hours = array(
		'year' => array(
			'start' => strtotime("$year-1-1 00:00:00"),
			'end' => strtotime("$year-12-31 23:59:59"),
		),
		'month' => array(
			'start' => strtotime("$year-$month-1 00:00:00"),
			'end' => strtotime("$year-$month-" . date('t', strtotime("$year-$month-1 00:00:00")) . " 23:59:59"),
		),
		'day' => array(
			'start' => strtotime("$year-$month-$day 00:00:00"),
			'end' => strtotime("$year-$month-$day 23:59:59"),
		),
	);

	for($i = 1; $i <= 24; $i++) {
		$hours['hour'][$i] = strtotime("$year-$month-$day $i:00:00");
	}

	return $hours;
}

function generate_sort_url($fieldname, $default_direction = 'asc')
{
	$page = Paginator::getCurrentPage();
	$sort = $fieldname;
	
	if($default_direction == 'asc') {
		$direction = Input::get('direction') == 'asc' && Input::get('sort') == $fieldname ? 'desc' : 'asc';
	}
	else {
		$direction = Input::get('direction') == 'desc' && Input::get('sort') == $fieldname ? 'asc' : 'desc';
	}

	$from_year = Input::get('from_year') ? Input::get('from_year') : date('Y');
	$from_month = Input::get('from_month') ? Input::get('from_month') : date('m');
	$from_day = Input::get('from_day') ? Input::get('from_day') : date('1');

	$to_year = Input::get('to_year') ? Input::get('to_year') : date('Y');
	$to_month = Input::get('to_month') ? Input::get('to_month') : date('m');
	$to_day = Input::get('to_day') ? Input::get('to_day') : date('t');

	return "?page=$page&amp;sort=$sort&amp;direction=$direction&amp;from_year=$from_year&amp;from_month=$from_month&amp;from_day=$from_day&amp;to_year=$to_year&amp;to_month=$to_month&amp;to_day=$to_day";
}