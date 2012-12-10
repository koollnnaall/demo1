<?php

function getsign($date){
     list($month,$day,$year)=explode("/",$date);
     if(($month==1 && $day>20)||($month==2 && $day<20)){
          return "Aquarius";
     }else if(($month==2 && $day>18 )||($month==3 && $day<21)){
          return "Pisces";
     }else if(($month==3 && $day>20)||($month==4 && $day<21)){
          return "Aries";
     }else if(($month==4 && $day>20)||($month==5 && $day<22)){
          return "Taurus";
     }else if(($month==5 && $day>21)||($month==6 && $day<22)){
          return "Gemini";
     }else if(($month==6 && $day>21)||($month==7 && $day<24)){
          return "Cancer";
     }else if(($month==7 && $day>23)||($month==8 && $day<24)){
          return "Leo";
     }else if(($month==8 && $day>23)||($month==9 && $day<24)){
          return "Virgo";
     }else if(($month==9 && $day>23)||($month==10 && $day<24)){
          return "Libra";
     }else if(($month==10 && $day>23)||($month==11 && $day<23)){
          return "Scorpio";
     }else if(($month==11 && $day>22)||($month==12 && $day<23)){
          return "Sagittarius";
     }else if(($month==12 && $day>22)||($month==1 && $day<21)){
          return "Capricorn";
     }
}


function UserDayNum($start) {
	$start_ts = strtotime($start);
	list($m, $d, $y) = explode("/", $start);
	$today = date("m/d/y");
	list($mt, $dt, $yt) = explode("/", $today);
	$d1=strtotime(date("$y-$m-$d"));
	$d2=strtotime(date("$y-$mt-$dt"));
	$d1=($d1 / (60 * 60 * 24));
	$d2=($d2 / (60 * 60 * 24));
	if ($d1 > $d2)
	{
		$days=$d1-$d2;
	}
	else
	{
		$days=$d2-$d1;
	}
	$days = $days+1;
	$days = round($days);
	return "$days";
}
function ShortCodes($inline){
	global $lucky,$Ud,$Umm,$Uy,$UStarSign,$UDob,$Uname,$URdm1,$URdm2,$URdm3,$appname;
	
	$inline = str_replace("{luck}", $lucky, $inline);
	$inline = str_replace("{ddno}", $Ud, $inline);
	$inline = str_replace("{mmno}", $Umm, $inline);
	$inline = str_replace("{year}", $Uy, $inline);
	$inline = str_replace("{sign}", $UStarSign, $inline);
	$inline = str_replace("{dob}", $UDob, $inline);
	$inline = str_replace("{name}", $Uname, $inline);
	$inline = str_replace("{ran1}", $URdm1, $inline);
	$inline = str_replace("{ran2}", $URdm2, $inline);
	$inline = str_replace("{ran3}", $URdm3, $inline);
	$inline = str_replace("{title}", $appname, $inline);
	
	Return $inline;
}

?>