<?php

require_once 'facebook.php';
require_once 'appinclude.php';

if (isset($_GET['code'])){
  header("Location: " . $canvasPage);
  exit;
}


$fb = new Facebook(array(
	'appId' => $appid,
	'secret' => $appsecret,
	'cookie' => true
));

$me = null;
 $user = $fb->getUser();

if($user) {
	try {
		$me = $fb->api('/me');
	} catch(FacebookApiException $e) {
		error_log($e);
	}
}
$permsneeded='';
if ($apptype=="1"){
	$permsneeded='user_birthday';
}
if($me) {}
else {
	$loginUrl = $fb->getLoginUrl(array(
        'scope' => $permsneeded,
	));
	echo "
		<script type='text/javascript'>
		window.top.location.href = '$loginUrl';
		</script>
	";
	
	exit;
}


if(isset($_GET['signed_request'])) {
	$fb_args = "signed_request=" . $_REQUEST['signed_request'];
}


include 'spinc.php';
@include 'ads/topads.php';

?>

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="cache-control" content="max-age=0">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="0">
<meta http-equiv="imagetoolbar" content="no">
<title><?=$appname?></title>
</head>
<body>

<style>
.submitButton {
	border-top: 1px solid #D4DBE7;
	border-left: 1px solid #D4DBE7;
	border-bottom: 1px solid #0A1850;
	border-right: 1px solid #0A1850;
	background: #314E8E;
	color: #fff;
	font-size: 1em;
	padding: 2px 15px 2px 15px;
	cursor: pointer;
	cursor: hand;

}
</style>

<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({appId  : '<?=$appid?>',
             status : true,
             cookie : false,
             xfbml  : true
           });
	FB.Canvas.setAutoResize();
};

  (function() {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
  }());
</script>

<?php



if ($_GET['m'] == 1)

{
// Invite code
$inviteactiontext='';
$inviteactiontext=ShortCodes($inviteactiontext);
$invitecontent='ihi';
$invitecontent=ShortCodes($invitecontent);

         $message = $invitecontent;

         $requests_url = "https://www.facebook.com/dialog/apprequests?app_id=" 
                . $appid . "&redirect_uri=" . urlencode($canvasURL)
                . "&message=" . $message;

         if (empty($_REQUEST["request_ids"])) {
            echo("<script> top.location.href='" . $requests_url . "'</script>");
         } else {
            echo "Request Ids: ";
            print_r($_REQUEST["request_ids"]);
         }



@include 'ads/bottomads.php';
exit;
}
else
{
if ($appimagename=='')
	{
		$appimagename='xxxxxx.jpg';
	}
$textsize = '3';
?>
<iframe src="http://www.facebook.com/plugins/like.php?href=<?=rawurlencode("http://www.facebook.com/apps/application.php?id=$appid");?>&amp;layout=box_count&amp;show_faces=true&amp;width=50&amp;action=like&amp;colorscheme=light&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:65px;" allowTransparency="true"></iframe>
<?php
echo "<table border=0><tr><td>";
echo '<img src='.$callBackURL.$appimagename.'>';
echo "</td><td bgcolor=white>";
echo "<font face=\"Times New Roman, Times, serif\">";
echo "<h2><Font color=$titlecolor>$appname</font></h2></font>";
echo "<font face=\"Times New Roman, Times, serif\">";
echo "<h4><Font color=$greetcolor>$greet</font></h4>"; 
echo "<center>";
echo "<Font color=$textcolor size='$textsize'><i>$sttext</font><br><br>";
echo "<b><Font color=$cookiecolor>$line</font></b>";
echo "<br><br></i></font>";
?>
<font size="-1">
<FORM><INPUT TYPE=BUTTON OnClick="publishToWall();" VALUE="Post to Wall" class="submitButton">  <INPUT TYPE="BUTTON" VALUE="Invite Friends" ONCLICK="top.location.href='<?php echo $canvasPage;?>?m=1'" class="submitButton"><?php if ($linetype!="1"){echo '  <INPUT TYPE="BUTTON" VALUE="Try Again" ONCLICK="top.location.href=\''.$canvasURL.'\'" class="submitButton">';}?></FORM>
</font>
<?php
echo "</font></center>";
echo "</tr><tr></table>";
@include 'ads/bottomads.php';
}

?>
<script>
function publishToWall() {

FB.ui(
   {
     method: 'feed',
     name: '<?= $appname;?>',
     link: '<?= $canvasURL;?>',
     picture: '<?php echo $callBackURL.$appimagename;?>',
     caption: '<?=$wallpub;?>',
     description: '<?= json_encode(strip_tags($line, ''));?>',
	 actions: [
    { name: '<?= $walllink;?>', link: '<?= $canvasURL;?>'}
  ],
	 message: ''
   },
function(response) {
     if (response && response.post_id) {
       //alert('Post was published.');
     } else {
       //alert('Post was not published.');
     }
   }
 );
}

</script>
</body>



