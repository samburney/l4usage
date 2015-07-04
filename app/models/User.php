<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable = array('name', 'cn');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}

	function hours()
	{
		return $this->hasMany('Hour');
	}

	function hour_totals()
	{
		return $this->hasMany('Hour')
			->select(
				'user_id',
				DB::raw('sum(downloaded) as downloaded_total'),
				DB::raw('sum(uploaded) as uploaded_total')
			)
			->groupBy('user_id');
	}

	function raw_hours()
	{
		return $this->hasMany('RawHour');
	}

	function usage_hours($start, $end = NULL)
	{
		$end = isset($end) ? $end : $start;

		$hours = Hour::where('user_id', '=', $this->id)
			->where('date', '>=', $start)
			->where('date', '<=', $end)
			->get();

		return $hours;
	}

	function usage_hour($start)
	{
		return $this->usage_hours($start);
	}

	function usage_days($start, $end = NULL)
	{
		$end = isset($end) ? $end : $start;

		$days = array();
		for($date = $start; $date <= $end; $date = $date + (60 * 60 * 24)) {
			$days[] = Hour::where('user_id', '=', $this->id)
				->where('date', '>=', $date)
				->where('date', '<=', $date + 60*60*24)
				->groupBy('user_id')
				->select(
					'user_id',
					'date',
					DB::raw('sum(downloaded) as downloaded_total'),
					DB::raw('sum(uploaded) as uploaded_total')
				)
				->first();
		}

		return $days;
	}

	function usage_months($start, $end = NULL)
	{
		$end = isset($end) ? $end : $start;

		$months = array();
		for($date = $start; $date <= $end; $date = $date + (60 * 60 * 24 * date('t', $date))) {
			$months[] = Hour::where('user_id', '=', $this->id)
				->where('date', '>=', $date)
				->where('date', '<=', $date + 60 * 60 * 24 * date('t', $date))
				->groupBy('user_id')
				->select(
					'user_id',
					'date',
					DB::raw('sum(downloaded) as downloaded_total'),
					DB::raw('sum(uploaded) as uploaded_total')
				)
				->first();
		}

		return $months;
	}
}
?>
