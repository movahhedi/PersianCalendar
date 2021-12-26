<?php
date_default_timezone_set("Asia/Tehran");
var_dump(PersianCalendar::PersianToGregorian(1400,9,20,1,10,30));
var_dump(PersianCalendar::GregorianToPersian(2021,12,11,1,10,30));
/*
echo PersianCalendar::FromNumeralPersian(1400,8,28,1,10,30, PersianCalendar::GREGORIAN, PersianCalendar::DT_FORMAT_DB_DATETIME);
echo "<br/>";
PersianCalendar::p2g(1400,8,28,1,10,30, PersianCalendar::GREGORIAN, PersianCalendar::DT_FORMAT_DB_DATETIME);
echo "<br/>";
echo PersianCalendar::FromTextualGregorian("@" . time(), PersianCalendar::PERSIAN, PersianCalendar::DT_FORMAT_DB_DATETIME);
echo "<br/>";
echo PersianCalendar::FromTextualGregorian("@" . time(), PersianCalendar::TIMESTAMP);
echo "<br/>";
echo PersianCalendar::FromNumeralPersian(1400,8,28,1,10,30, PersianCalendar::GREGORIAN, PersianCalendar::DT_FORMAT_DB_DATETIME);
var_dump(PersianCalendar::FromNumeralPersian(1400,8,28,1,10,30, PersianCalendar::GREGORIAN));
echo "<br/>";*/
// echo PersianCalendar::date(PersianCalendar::DT_FORMAT_DB_DATETIME, time(), false, 3, 30);

 /**
 * Persian Calendar - Created by Shahab Movahhedi
 *
 * Persian Calendar
 * Created by Shahab Movahhedi
 *
 * @author     Shahab Movahhedi <s@shmovahhedi.com>
 * @link       https://shmovahhedi.com
 * @copyright  2021 Shahab Movahhedi
 * @license    GNU GPLv3.0
 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0
 */
class PersianCalendar {

	public const DT_FORMAT_DB_DATETIME = "Y-m-d H:i:s";

	public const TIMESTAMP = 0;
	public const GREGORIAN = 1;
	public const PERSIAN = 2;

	public const PERSIAN_MONTHS = array(
		1 => array(
			"FaName" => "فروردین",
			"FaNameShort" => "",
			"EnName" => "",
			"EnShortName" => "",
			"DaysInMonth" => 31,
		),
		2 => array(
			"FaName" => "اردیبهشت",
			"FaNameShort" => "",
			"EnName" => "",
			"EnShortName" => "",
			"DaysInMonth" => 31,
		),
		3 => array(
			"FaName" => "خرداد",
			"FaNameShort" => "",
			"EnName" => "",
			"EnShortName" => "",
			"DaysInMonth" => 31,
		),
		4 => array(
			"FaName" => "تیر",
			"FaNameShort" => "",
			"EnName" => "",
			"EnShortName" => "",
			"DaysInMonth" => 31,
		),
		5 => array(
			"FaName" => "مرداد",
			"FaNameShort" => "",
			"EnName" => "",
			"EnShortName" => "",
			"DaysInMonth" => 31,
		),
		6 => array(
			"FaName" => "شهریور",
			"FaNameShort" => "",
			"EnName" => "",
			"EnShortName" => "",
			"DaysInMonth" => 31,
		),
		7 => array(
			"FaName" => "مهر",
			"FaNameShort" => "",
			"EnName" => "",
			"EnShortName" => "",
			"DaysInMonth" => 30,
		),
		8 => array(
			"FaName" => "آبان",
			"FaNameShort" => "",
			"EnName" => "",
			"EnShortName" => "",
			"DaysInMonth" => 30,
		),
		9 => array(
			"FaName" => "آذر",
			"FaNameShort" => "",
			"EnName" => "",
			"EnShortName" => "",
			"DaysInMonth" => 30,
		),
		10 => array(
			"FaName" => "دی",
			"FaNameShort" => "",
			"EnName" => "",
			"EnShortName" => "",
			"DaysInMonth" => 30,
		),
		11 => array(
			"FaName" => "بهمن",
			"FaNameShort" => "",
			"EnName" => "",
			"EnShortName" => "",
			"DaysInMonth" => 30,
		),
		12 => array(
			"FaName" => "اسفند",
			"FaNameShort" => "",
			"EnName" => "",
			"EnShortName" => "",
			"DaysInMonth" => 29,
		),
	);

	public const PERSIAN_WEEKDAYS = array(
		1 => array(
			"FaName" => "شنبه",
			"FaNameShort" => "ش",
			"EnName" => "Saturday",
			"EnShortName" => "Sat",
		),
		2 => array(
			"FaName" => "یکشنبه",
			"FaNameShort" => "ی",
			"EnName" => "Sunday",
			"EnShortName" => "Sun",
		),
		3 => array(
			"FaName" => "دوشنبه",
			"FaNameShort" => "د",
			"EnName" => "Monday",
			"EnShortName" => "Mon",
		),
		4 => array(
			"FaName" => "سه شنبه",
			"FaNameShort" => "س",
			"EnName" => "Tuesday",
			"EnShortName" => "Tue",
		),
		5 => array(
			"FaName" => "چهارشنبه",
			"FaNameShort" => "چ",
			"EnName" => "Wednesday",
			"EnShortName" => "Wed",
		),
		6 => array(
			"FaName" => "پنجشنبه",
			"FaNameShort" => "پ",
			"EnName" => "Thursday",
			"EnShortName" => "Thu",
		),
		7 => array(
			"FaName" => "جمعه",
			"FaNameShort" => "ج",
			"EnName" => "Friday",
			"EnShortName" => "Fri",
		),
	);

	public const PERSIAN_NUMBERS = array(
		"0" => "&#1776;",
		"1" => "&#1777;",
		"2" => "&#1778;",
		"3" => "&#1779;",
		"4" => "&#1780;",
		"5" => "&#1781;",
		"6" => "&#1782;",
		"7" => "&#1783;",
		"8" => "&#1784;",
		"9" => "&#1785;"
	);

	public static function IsGregorianLeapYear($y = 0) {
		return (( ! ($y % 100)) ? ( ! ($y % 400)) : ( ! ($y % 4)));
	}

	public static function MasterConvert($inputType = self::TIMESTAMP, $outputType = self::PERSIAN, $input = "now") { }

	public static function TimestampToFormattedPersian($format, $ts = 0, $persianNumber = false, $tz_h = 0, $tz_m = 0) {
		if ( ! $ts || $ts == "now") $ts = time();

		// TimeZone stuff
		// date_default_timezone_set("Asia/Tehran");
		$ts += ($tz_h * 3600) + ($tz_m * 60);

		// Getting Persian Year, Month, Day & Day-In-Year
		list($g_y, $g_m, $g_d, $h, $min, $s) = self::FromTimestamp($ts, self::GREGORIAN);
		list($p_y, $p_m, $p_d, $h, $min, $s, $p_dayinyear) = self::GregorianToPersian($g_y, $g_m, $g_d, $h, $min, $s);

		// Persian Weekday number starting from 1 (Saturday)
		$p_weekday = date("N", $ts) + 2;
		if ($p_weekday > 7) $p_weekday -= 7;

		$result = "";
		$Previous_i = "";
		$ForPhpDateFunc = array('B','g','G','h','H','i','s','u','v','e','I','O','P','p','T','Z','c','r','U');

		foreach (str_split($format) as $i) {
			if ($i == "\\") {
				$Previous_i = $i;
				continue;
			}
			if ($Previous_i == "\\") {
				$result .= $i;
				$Previous_i = $i;
				continue;
			}

			else if ($i == 'd') $result .= str_pad($p_d, 2, "0", STR_PAD_LEFT);
			else if ($i == 'D') $result .= self::PERSIAN_WEEKDAYS[$p_weekday]["FaNameShort"];
			else if ($i == 'j') $result .= $p_d;
			else if ($i == 'l') $result .= self::PERSIAN_WEEKDAYS[$p_weekday]["FaName"];
			else if ($i == 'N') $result .= $p_weekday;
			else if ($i == 'S') $result .= "";
			else if ($i == 'w') $result .= $p_weekday - 1;
			else if ($i == 'z') $result .= $p_dayinyear + 1;

			else if ($i == 'W') $result .= floor(($p_dayinyear + 1) / 7);

			else if ($i == 'F') $result .= self::PERSIAN_MONTHS[$p_m]["FaName"];
			else if ($i == 'm') $result .= str_pad($p_m, 2, "0", STR_PAD_LEFT);
			else if ($i == 'M') $result .= self::PERSIAN_MONTHS[$p_m]["FaNameShort"];
			else if ($i == 'n') $result .= $p_m;
			else if ($i == 't') $result .= self::PERSIAN_MONTHS[$p_m]["DaysInMonth"];

			else if ($i == 'L') $result .= intval(IsLeapYear($p_y));
			else if ($i == 'o') $result .= $p_y;
			else if ($i == 'Y') $result .= $p_y;
			else if ($i == 'y') $result .= substr($p_y, -2);
		
			else if ($i == 'a') $result .= (date("a", $ts) == "pm") ? "ب.ظ" : "ق.ظ";
			else if ($i == 'A') $result .= (date("a", $ts) == "pm") ? "بعدازظهر" : "قبل ازظهر";

			else if (in_array($i, $ForPhpDateFunc, true)) $result .= date($i, $ts);
			else $result .= $i;
		}

		return $persianNumber ? self::ConvertToPersianNumbers($result) : $result;
	}

	/**
	 * Converts 
	 *
	 * @author	Shahab Movahhedi
	 * @access	public
	 * @return	array	Persian Year, Month, Day and Day-In-Year
	 */
	public static function FromTimestamp($ts, $outputType = self::TIMESTAMP, $outputFormat = null) {
		if ($outputType == self::TIMESTAMP || (isset($outputFormat) && $outputFormat && $outputFormat == "@")) return $ts;
		if ($outputType == self::PERSIAN && (isset($outputFormat) && $outputFormat && $outputFormat != "@")) return self::TimestampToFormattedPersian($outputFormat, $ts);

		$dt = new DateTime('@' . $ts);
		$g_y = $dt->format('Y');
		$g_m = $dt->format('n');
		$g_d = $dt->format('j');
		$g_h = $dt->format('G');
		$g_min = intval($dt->format('i'));
		$g_s = intval($dt->format('s'));

		if ($outputType == self::GREGORIAN) {
			if (isset($outputFormat) && $outputFormat) return $dt->format($outputFormat);
			else return array($g_y, $g_m, $g_d, $g_h, $g_min, $g_s);
		}
		else return self::GregorianToPersian($g_y, $g_m, $g_d, $g_h, $g_min, $g_s);
	}

	public static function FromNumeralGregorian($g_y = 0, $g_m = 0, $g_d = 0, $g_h = 0, $g_min = 0, $g_s = 0, $outputType = self::TIMESTAMP, $outputFormat = null) {
		$NeedsFormatting = (isset($outputFormat) && $outputFormat && $outputFormat != "@");

		// To Timestamp
		if ($outputType == self::TIMESTAMP || (isset($outputFormat) && $outputFormat && $outputFormat == "@")) {
			return mktime($g_h, $g_min, $g_s, $g_m, $g_d, $g_y);
		}

		// To Numeral Persian
		if ($outputType == self::PERSIAN && ! $NeedsFormatting) {
			return self::GregorianToPersian($g_y, $g_m, $g_d, $g_h, $g_min, $g_s);
		}

		// To Formatted Persian
		if ($outputType == self::PERSIAN && $NeedsFormatting) {
			$dt = new DateTime();
			$dt->setDate($g_y, $g_m, $g_d);
			$dt->setTime($g_h, $g_min, $g_s);
			return self::TimestampToFormattedPersian($outputFormat, $dt->getTimestamp());
		}

		// To Numeral Gregorian
		if ($outputType == self::GREGORIAN && ! $NeedsFormatting) {
			return array($g_y, $g_m, $g_d, $g_h, $g_min, $g_s);
		}

		// To Formatted Gregorian
		if ($outputType == self::GREGORIAN && $NeedsFormatting) {
			$dt = new DateTime();
			$dt->setDate($g_y, $g_m, $g_d);
			$dt->setTime($g_h, $g_min, $g_s);
			return $dt->format($outputFormat);
		}

		// FallBack to Timestamp
		return mktime($g_h, $g_min, $g_s, $g_m, $g_d, $g_y);
	}

	public static function FromTextualGregorian($input = "now", $outputType = self::TIMESTAMP, $outputFormat = null, $inputFormat = null) {
		$NeedsFormatting = (isset($outputFormat) && $outputFormat && $outputFormat != "@");

		// To Timestamp
		if ($outputType == self::TIMESTAMP || (isset($outputFormat) && $outputFormat && $outputFormat == "@")) {
			return strtotime($input);
		}
		
		if (isset($inputFormat) && $inputFormat) {
			$dt = new DateTime();
			$dt->createFromFormat($inputFormat, $input);	
		}
		else $dt = new DateTime($input);

		// To Numeral Persian
		if ($outputType == self::PERSIAN && ! $NeedsFormatting) {
			$g_y = $dt->format('Y');
			$g_m = $dt->format('n');
			$g_d = $dt->format('j');
			$g_h = $dt->format('G');
			$g_min = intval($dt->format('i'));
			$g_s = intval($dt->format('s'));

			return self::GregorianToPersian($g_y, $g_m, $g_d, $g_h, $g_min, $g_s);
		}

		// To Formatted Persian
		if ($outputType == self::PERSIAN && $NeedsFormatting) {
			return self::TimestampToFormattedPersian($outputFormat, $dt->getTimestamp());
		}

		// To Numeral Gregorian
		if ($outputType == self::GREGORIAN && ! $NeedsFormatting) {
			$g_y = $dt->format('Y');
			$g_m = $dt->format('n');
			$g_d = $dt->format('j');
			$g_h = $dt->format('G');
			$g_min = intval($dt->format('i'));
			$g_s = intval($dt->format('s'));

			return array($g_y, $g_m, $g_d, $g_h, $g_min, $g_s);
		}

		// To Formatted Gregorian
		if ($outputType == self::GREGORIAN && $NeedsFormatting) {
			return $dt->format($outputFormat);
		}

		// FallBack to Timestamp
		return strtotime($input);
	}
	
	public static function FromNumeralPersian($p_y = 0, $p_m = 0, $p_d = 0, $p_h = 0, $p_min = 0, $p_s = 0, $outputType = self::TIMESTAMP, $outputFormat = null) {
		$NeedsFormatting = (isset($outputFormat) && $outputFormat && $outputFormat != "@");
		
		// To Timestamp
		if ($outputType == self::TIMESTAMP || (isset($outputFormat) && $outputFormat && $outputFormat == "@")) {
			return self::FromNumeralGregorian(...self::PersianToGregorian($p_y, $p_m, $p_d, $p_h, $p_min, $p_s), ...[self::TIMESTAMP]);
		}
		
		// To Numeral Persian
		if ($outputType == self::PERSIAN && ! $NeedsFormatting) {
			return array($p_y, $p_m, $p_d, $p_h, $p_min, $p_s);
		}

		// To Formatted Persian
		// if ($outputType == self::PERSIAN && $NeedsFormatting) {
		// 	return array($p_y, $p_m, $p_d, $p_h, $p_min, $p_s);
		// }

		// To Numeral Gregorian
		if ($outputType == self::GREGORIAN && ! $NeedsFormatting) {
			return self::PersianToGregorian($p_y, $p_m, $p_d, $p_h, $p_min, $p_s);
		}

		// To Formatted Gregorian
		if ($outputType == self::GREGORIAN && $NeedsFormatting) {
			list($g_y, $g_m, $g_d, $g_h, $g_min, $g_s) = self::PersianToGregorian($p_y, $p_m, $p_d, $p_h, $p_min, $p_s);
			return self::FromNumeralGregorian($g_y, $g_m, $g_d, $g_h, $g_min, $g_s, self::GREGORIAN, $outputFormat);
		}

		// FallBack to Timestamp
		return self::FromNumeralGregorian(...self::PersianToGregorian($p_y, $p_m, $p_d, $p_h, $p_min, $p_s), ...[self::TIMESTAMP]);
	}

	public static function GregorianToPersian($g_y, $g_m, $g_d, $h = 0, $min = 0, $s = 0) {
		$g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		$j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

		$gy = $g_y - 1600;
		$gm = $g_m - 1;
		$gd = $g_d - 1;

		$g_day_no = 365 * $gy + floor(($gy + 3) / 4) - floor(($gy + 99) / 100) + floor(($gy + 399) / 400);

		for ($i = 0; $i < $gm; $i++)
			$g_day_no += $g_days_in_month[$i];

		/* leap and after Feb */
		if ($gm > 1 && (($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0)))
			$g_day_no++;

		$g_day_no += $gd;
		$j_day_no = $g_day_no - 79;
		$j_np = floor($j_day_no / 12053);
		$j_day_no %= 12053;
		$jy = 979 + 33 * $j_np + 4 * floor($j_day_no / 1461);
		$j_day_no %= 1461;

		if ($j_day_no >= 366) {
			$jy += floor(($j_day_no - 1) / 365);
			$j_day_no = ($j_day_no - 1) % 365;
		}
		$j_all_days = $j_day_no + 1;

		for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; $i++)
			$j_day_no -= $j_days_in_month[$i];

		$jm = $i + 1;
		$jd = $j_day_no + 1;

		return array($jy, $jm, $jd, $h, $min, $s, $j_all_days);
	}

	public static function PersianToGregorian($j_y, $j_m, $j_d, $h = 0, $min = 0, $s = 0) {
		$g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		$j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
		$jy = $j_y - 979;
		$jm = $j_m - 1;
		$jd = $j_d - 1;
		$j_day_no = 365 * $jy + floor($jy / 33) * 8 + floor(($jy % 33 + 3) / 4);

		for ($i = 0; $i < $jm; $i++)
			$j_day_no += $j_days_in_month[$i];

		$j_day_no += $jd;
		$g_day_no = $j_day_no + 79;
		/* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
		$gy = 1600 + 400 * floor($g_day_no / 146097);
		$g_day_no = $g_day_no % 146097;
		$leap = true;
		/* 36525 = 365*100 + 100/4 */
		if ($g_day_no >= 36525){
			$g_day_no--;
			/* 36524 = 365*100 + 100/4 - 100/100 */
			$gy += 100 * floor($g_day_no / 36524);
			$g_day_no = $g_day_no % 36524;
			if ($g_day_no >= 365) $g_day_no++;
			else $leap = false;
		}
		/* 1461 = 365*4 + 4/4 */
		$gy += 4 * floor($g_day_no / 1461);
		$g_day_no %= 1461;
		if ($g_day_no >= 366){
			$leap = false;
			$g_day_no--;
			$gy += floor($g_day_no / 365);
			$g_day_no = $g_day_no % 365;
		}
		$g_all_days = $g_day_no + 1;
		for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
			$g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);

		$gm = $i + 1;
		$gd = $g_day_no + 1;

		return array($gy, $gm, $gd, $h, $min, $s, $g_all_days);
	}

	public static function ConvertToPersianNumbers($input) {
		$input = str_split($input);
		foreach ($input as &$i) $i = self::PERSIAN_NUMBERS[$i] ?? $i;
		unset($i);
		return implode("", $input);
	}

	public static function IsPersianLeapYear($year) {
		return $year % 4 == 0 && $year % 100 != 0;
	}

	public static function IsPersianDateValid($year, $month, $day) {
		return ($year > 0 && $month > 0 && $day > 0 && $month <= 12 && ((self::PERSIAN_MONTHS[$month]["DaysInMonth"] >= $day) || (IsLeapYear($year) && $month == 12 && $day == 30)));
	}

	// Function Aliases
	public static function date(...$args) {
		return self::TimestampToFormattedPersian(...$args);
	}
	public static function p2g(...$args) {
		return self::PersianToGregorian(...$args);
	}
	public static function g2p(...$args) {
		return self::GregorianToPersian(...$args);
	}
	public static function ts2p($ts) {
		return self::FromTimestamp($ts, self::PERSIAN);
	}
	public static function ts2g($ts) {
		return self::FromTimestamp($ts, self::GREGORIAN);
	}
}
