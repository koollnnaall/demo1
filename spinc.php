<?php
// SpInclude file.
require_once 'spfunc.php';
srand ((double)microtime()*1000000);

$Uname = $me[first_name];
$UDob = $me[birthday]; // returned as mm/dd/yyyy
$UDayNo =UserDayNum($UDob);
$UStarSign=getsign($UDob);
$URdm1=rand($rd1, $rd1a);
$URdm2=rand($rd2, $rd2a);
$URdm3=rand($rd3, $rd3a);

list($Umm, $Ud, $Uy) = explode("/", $UDob);
$today = date("m/d/y");
list($mt, $dt, $yt) = explode("/", $today);
$num=(($Ud*($dt+1))+($mt*$Umm));
$le=strlen($num);
while ($le > 2){
	$num=round($num/2);
	$le=strlen($num);
}

$lucky=$num;

$file_handle = fopen("lines.txt", "rb");
$lc=0;
while (!feof($file_handle) ) {
	
$line_of_text = fgets($file_handle);
if (trim($line_of_text)!= "")
	{
		$linex[$lc]=$line_of_text;
		$lc=$lc+1;
				
	}
}

fclose($file_handle);

if ($linetype != "1")
   {
	$lp=rand(0,($lc-1));
   }
   else
   {
  	if ($apptype=="1")
	{
	$lp=$UDayNo;
	}
	else
	{
		$tempyear=date("Y");
		$tempdate="01/01/$tempyear";
		$lp=UserDayNum($tempdate); 

	}
	 
    }
	
if ($lp > ($lc-1))
	 {
		while ($lp > ($lc-1)){
			$lp=$lp-($lc-1);
			
		}
	 } 
	
if ($lp <1){
	$lp=1;
}
$line=$linex[$lp];
$line=ShortCodes($line);
$greet=ShortCodes($greet);
$sttext=ShortCodes($sttext);
$appname=ShortCodes($appname);
$wallpub=ShortCodes($wallpub);
$walllink=ShortCodes($walllink);

?>