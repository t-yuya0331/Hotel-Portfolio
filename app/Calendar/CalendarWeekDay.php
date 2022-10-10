<?php
namespace App\Calendar;
use Carbon\Carbon;

class CalendarWeekDay {
	protected $carbon;

	public function __construct($date){
		$this->carbon = new Carbon($date);
	}

	public function getClassName(){
		return "day-" . strtolower($this->carbon->format("D"));
	}

	public function render(){
		return '<p class="day">' . $this->carbon->format("j"). '</p>';
	}
}
