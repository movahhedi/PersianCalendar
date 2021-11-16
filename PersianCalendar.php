<?php

/*
	Persian Calendar
	Created by Shahab Movahhedi
	shmovahhedi.com
	s@shmovahhedi.com
	
	@author @movahhedi
*/
/*
Created by : Jalali
modified by : Mohammad Dayyan
1387/5/15
Link: https://www.codeproject.com/Articles/28380/Persian-Calendar-in-PHP
*/

$PersianMonths = array(
	0 => array(
		"FaName" => "",
		"FaNameShort" => "",
		"EnName" => "",
		"EnShortName" => "",
		"DaysInMonth" => 0,
	),
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

$PersianNumbers = array(
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

function PCal_Date($format, $when = "now", $persianNumber = 0) {
	///choose your timezone
	$TZhours=0;
	$TZminute=0;
	$need="";
	$result1="";
	$result="";
	if ($when=="now") {
		$year=date("Y");
		$month=date("m");
		$day=date("d");
		list( $Dyear, $Dmonth, $Dday ) = gregorian_to_mds($year, $month, $day);
		$when=mktime(date("H")+$TZhours,date("i")+$TZminute,date("s"),date("m"),date("d"),date("Y"));
	}
	else {
		//$when=0;
		$when+=$TZhours*3600+$TZminute*60;
		$date=date("Y-m-d",$when);
		list( $year, $month, $day ) = preg_split ( '/-/', $date );

		list( $Dyear, $Dmonth, $Dday ) = gregorian_to_mds($year, $month, $day);
	}

	$need= $when;
	$year=date("Y",$need);
	$month=date("m",$need);
	$day=date("d",$need);
	$i=0;
	$subtype="";
	$subtypetemp="";
	list( $Dyear, $Dmonth, $Dday ) = gregorian_to_mds($year, $month, $day);
	while($i<strlen($format))
	{
		$subtype=substr($format,$i,1);
		if($subtypetemp=="\\")
		{
			$result.=$subtype;
			$i++;
			continue;
		}

		switch ($subtype)
		{

			case "A":
				$result .= (date("a", $need) == "pm") ? "بعدازظهر": "قبل ازظهر";
				break;

			case "a":
				$result .= (date("a", $need) == "pm") ? "ب.ظ": "ق.ظ";
				break;

			case "d":
				// TODO ConvertToPersianNumbers
				$result .= str_pad($Dday, 2, "0", STR_PAD_LEFT);
				break;
			case "D":
				$result1=date("D",$need);
				if ($result1=="Sat") $result1="&#1588;";
				else if($result1=="Sun") $result1="&#1609;";
				else if($result1=="Mon") $result1="&#1583;";
				else if($result1=="Tue") $result1="&#1587;";
				else if($result1=="Wed") $result1="&#1670;";
				else if($result1=="Thu") $result1="&#1662;";
				else if($result1=="Fri") $result1="&#1580;";
				$result.=$result1;
				break;
			case "F":
				$result .= PCal_MonthName($Dmonth);
				break;
			case "g":
				// TODO ConvertToPersianNumbers
				$result .= date("g", $need);
				break;
			case "G":
				$result1=date("G",$need);
				if($persianNumber==1) $result.=ConvertToPersianNumbers($result1);
				else $result.=$result1;
				break;
				case "h":
				$result1=date("h",$need);
				if($persianNumber==1) $result.=ConvertToPersianNumbers($result1);
				else $result.=$result1;
				break;
			case "H":
				$result1=date("H",$need);
				if($persianNumber==1) $result.=ConvertToPersianNumbers($result1);
				else $result.=$result1;
				break;
			case "i":
				$result1=date("i",$need);
				if($persianNumber==1) $result.=ConvertToPersianNumbers($result1);
				else $result.=$result1;
				break;
			case "j":
				$result1=$Dday;
				if($persianNumber==1) $result.=ConvertToPersianNumbers($result1);
				else $result.=$result1;
				break;
			case "l":
				$result1=date("l",$need);
				if($result1=="Saturday") $result1="&#1588;&#1606;&#1576;&#1607;";
				else if($result1=="Sunday") $result1="&#1740;&#1603;&#1588;&#1606;&#1576;&#1607;";
				else if($result1=="Monday") $result1="&#1583;&#1608;&#1588;&#1606;&#1576;&#1607;";
				else if($result1=="Tuesday") $result1="&#1587;&#1607;&#32;&#1588;&#1606;&#1576;&#1607;";
				else if($result1=="Wednesday") $result1="&#1670;&#1607;&#1575;&#1585;&#1588;&#1606;&#1576;&#1607;";
				else if($result1=="Thursday") $result1="&#1662;&#1606;&#1580;&#1588;&#1606;&#1576;&#1607;";
				else if($result1=="Friday") $result1="&#1580;&#1605;&#1593;&#1607;";
				$result.=$result1;
				break;
			case "m":
				if($Dmonth<10) $result1="0".$Dmonth;
				else	$result1=$Dmonth;
				if($persianNumber==1) $result.=ConvertToPersianNumbers($result1);
				else $result.=$result1;
				break;
			case "M":
				$result .= PCal_MonthNameShort($Dmonth);
				break;
			case "n":
				$result1=$Dmonth;
				if($persianNumber==1) $result.=ConvertToPersianNumbers($result1);
				else $result.=$result1;
				break;
			case "s":
				$result1=date("s",$need);
				if($persianNumber==1) $result.=ConvertToPersianNumbers($result1);
				else $result.=$result1;
				break;
			case "S":
				$result.="&#1575;&#1605;";
				break;
			case "t":
				$result.=lastday ($month,$day,$year);
				break;
			case "w":
				$result1=date("w",$need);
				if($persianNumber==1) $result.=ConvertToPersianNumbers($result1);
				else $result.=$result1;
				break;
			case "y":
				$result1=substr($Dyear,2,4);
				if($persianNumber==1) $result.=ConvertToPersianNumbers($result1);
				else $result.=$result1;
				break;
			case "Y":
				$result1=$Dyear;
				if($persianNumber==1) $result.=ConvertToPersianNumbers($result1);
				else $result.=$result1;
				break;
			case "U" :
				$result.=mktime();
				break;
			case "Z" :
				$result.=days_of_year($Dmonth,$Dday,$Dyear);
				break;
			case "L" :
				list( $tmp_year, $tmp_month, $tmp_day ) = mds_to_gregorian(1384, 12, 1);
				echo $tmp_day;
				/*if(lastday($tmp_month,$tmp_day,$tmp_year)=="31")
					$result.="1";
				else
					$result.="0";
					*/
				break;
			default:
				$result.=$subtype;
		}
		$subtypetemp=substr($format,$i,1);
	$i++;
	}
	return $result;
}

function make_time($hour="", $minute="", $second="", $Dmonth="", $Dday="", $Dyear="") {
	if (!$hour && !$minute && !$second && !$Dmonth && !$Dmonth && !$Dday && !$Dyear) return mktime();
	if ($Dmonth > 11) die("Incorrect month number");
	list($year, $month, $day) = mds_to_gregorian($Dyear, $Dmonth, $Dday);
	$i = mktime($hour, $minute, $second, $month, $day, $year);
	return $i;
}

///Find num of Day Begining Of Month ( 0 for Sat & 6 for Sun)
function mstart($month, $day, $year) {
	list($Dyear, $Dmonth, $Dday) = gregorian_to_mds($year, $month, $day);
	list($year, $month, $day) = mds_to_gregorian($Dyear, $Dmonth, "1");
	$timestamp = mktime(0, 0, 0, $month, $day, $year);
	return date("w", $timestamp);
}

//Find Number Of Days In This Month
function lastday($month, $day, $year) {
	$Dday2="";
	$jdate2 ="";
	$lastdayen=date("d",mktime(0,0,0,$month+1,0,$year));
	list( $Dyear, $Dmonth, $Dday ) = gregorian_to_mds($year, $month, $day);
	$lastdatep=$Dday;
	$Dday=$Dday2;
	while($Dday2!="1")
	{
		if($day<$lastdayen)
		{
			$day++;
			list( $Dyear, $Dmonth, $Dday2 ) = gregorian_to_mds($year, $month, $day);
			if($jdate2=="1") break;
			if($jdate2!="1") $lastdatep++;
		}
		else
		{
			$day=0;
			$month++;
			if($month==13)
			{
					$month="1";
					$year++;
			}
		}

	}
	return $lastdatep-1;
}

//Find days in this year untile now
function days_of_year($Dmonth, $Dday, $Dyear) {
	$year="";
	$month="";
	$year="";
	$result="";
	if($Dmonth=="01")
		return $Dday;
	for ($i=1;$i<$Dmonth || $i==12;$i++)
	{
		list( $year, $month, $day ) = mds_to_gregorian($Dyear, $i, "1");
		$result+=lastday($month,$day,$year);
	}
	return $result+$Dday;
}

//translate number of month to name of month
function PCal_MonthName($month) {
	global $PersianMonths;
	return $PersianMonths[intval($month)]["FaName"] ?? "ERROR";
}
function PCal_MonthNameShort($month) {
	global $PersianMonths;
	return $PersianMonths[intval($month)]["FaNameShort"] ?? "ERROR";
}

function ConvertToPersianNumbers($input) {
	global $PersianNumbers;
	$input = str_split($input);
	foreach ($input as &$i) $i = $PersianNumbers[$i] ?? $i;
	unset($i);
	return implode("", $input);
}

function IsLeapYear($year) {
	return $year % 4 == 0 && $year % 100 != 0;
}

function PCal_IsDateValid($year, $month, $day) {
	global $PersianMonths;
	return ($year > 0 && $month > 0 && $day > 0 && $month <= 12 && (($PersianMonths[$month]["DaysInMonth"] >= $day) || (IsLeapYear($year) && $month == 12 && $day == 30)));
}

function PCal_DateFull($ts = "") {
	if ( ! $ts) $ts = mktime();

	return array(
		0 => $ts,
		"seconds" => PCal_Date("s", $ts),
		"minutes" => PCal_Date("i", $ts),
		"hours" => PCal_Date("G", $ts),
		"mday" => PCal_Date("j", $ts),
		"wday" => PCal_Date("w", $ts),
		"mon" => PCal_Date("n", $ts),
		"year" => PCal_Date("Y", $ts),
		"yday" => days_of_year(PCal_Date("m", $ts), PCal_Date("d", $ts), PCal_Date("Y",$ts)),
		"weekday" => PCal_Date("l", $ts),
		"month" => PCal_Date("F", $ts),
	);
}

function div($a, $b) {
	return (int) ($a / $b);
}

function gregorian_to_mds($g_y, $g_m, $g_d) {
	$g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	$m_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

	$gy = $g_y - 1600;
	$gm = $g_m - 1;
	$gd = $g_d - 1;

	$g_day_no = 365 * $gy + div($gy + 3, 4) - div($gy + 99, 100) + div($gy + 399, 400);

	for ($i = 0; $i < $gm; $i++)
		$g_day_no += $g_days_in_month[$i];
	if ($gm > 1 && (($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0)))
		/* leap and after Feb */
		$g_day_no++;
	$g_day_no += $gd;

	$m_day_no = $g_day_no - 79;

	$j_np = div($m_day_no, 12053); /* 12053 = 365*33 + 32/4 */
	$m_day_no = $m_day_no % 12053;

	$jy = 979 + 33 * $j_np + 4 * div($m_day_no, 1461); /* 1461 = 365*4 + 4/4 */

	$m_day_no %= 1461;

	if ($m_day_no >= 366) {
		$jy += div($m_day_no - 1, 365);
		$m_day_no = ($m_day_no- 1 ) % 365;
	}

	for ($i = 0; $i < 11 && $m_day_no >= $m_days_in_month[$i]; $i++) $m_day_no -= $m_days_in_month[$i];
	$jm = $i + 1;
	$jd = $m_day_no + 1;

	return array($jy, $jm, $jd);
}

function mds_to_gregorian($m_y, $j_m, $m_d) {
	$g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	$m_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

	$jy = $m_y - 979;
	$jm = $j_m - 1;
	$jd = $m_d - 1;

	$m_day_no = 365 * $jy + div($jy, 33) * 8 + div($jy % 33 + 3, 4);
	for ($i = 0; $i < $jm; $i++)
		$m_day_no += $m_days_in_month[$i];

	$m_day_no += $jd;

	$g_day_no = $m_day_no + 79;

	$gy = 1600 + 400 * div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
	$g_day_no = $g_day_no % 146097;

	$leap = true;
	if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */ {
		$g_day_no--;
		$gy += 100 * div($g_day_no, 36524); /* 36524 = 365*100 + 100/4 - 100/100 */
		$g_day_no = $g_day_no % 36524;

		if ($g_day_no >= 365) $g_day_no++;
		else $leap = false;
	}

	$gy += 4 * div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */
	$g_day_no %= 1461;

	if ($g_day_no >= 366) {
		$leap = false;

		$g_day_no--;
		$gy += div($g_day_no, 365);
		$g_day_no = $g_day_no % 365;
	}

	for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
		$g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);
	$gm = $i + 1;
	$gd = $g_day_no + 1;

	return array($gy, $gm, $gd);
}
