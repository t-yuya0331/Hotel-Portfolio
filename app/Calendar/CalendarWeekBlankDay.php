<?php
namespace App\Calendar;

class CalendarWeekBlankDay extends CalendarWeekDay {

    public function getClassName(){
		return "day-blank";
	}

	public function render(){
		return '';
	}

}
