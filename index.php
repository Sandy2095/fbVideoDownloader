<html lang="en">
<head>
<title>FB Video Downloader Online</title>
<meta name="description" content="Facebook Video Downloader Online, Download Facebook Videos and Save them directly from facebook to your computer or mobile for Free without Java or Software. We provide also a Video Downloader Chrome Extension. Facebook Video Indir Online.">
<meta name="keywords" content="facebook video downloader,download facebook videos,facebook online downloader, grab facebook online, free facebook video downloader,baixar vídeos do Facebook,baixar facebook,video downloader extension chrome">

		
</head>
<body>
<form name="fbvideodownloader" action="index.php" method="post">
<input id="url" name="url" placeholder="Please Enter Facebook Video URL.." type="url">



<?php 
$url_global ="";
if(isset($_POST['submit']))
{
	if(empty($_POST['url']))
	{
	echo "URL is Required";
	}
	 $url_global=$_POST['url'];
  } 
//echo $url_global[5];
$url_global = explode('/',$url_global);

session_start();
require_once __DIR__ . '/Facebook/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '1882185208703328',
  'app_secret' => '04d65bc8dd4ddb3aada0e4e08f964578',
  'default_graph_version' => 'v2.9',
]);
   $permissions = []; // optional
   $helper = $fb->getRedirectLoginHelper();
   $accessToken = $helper->getAccessToken();


if (isset($accessToken)) {
	
 		$url = "https://graph.facebook.com/v2.9/{$url_global[5]}?fields=source&access_token={$accessToken}";
		$headers = array("Content-type: application/json");
		
	 
		 $ch = curl_init();
		 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		 curl_setopt($ch, CURLOPT_URL, $url);
	         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
		 curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');  
		 curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');  
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		 curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		   
		 $st=curl_exec($ch); 
		 $result=json_decode($st,TRUE);
		 echo var_dump($result);
		 echo "My name: ".$result['name'];
		 echo "<img src=".$result['cover']['source'].">";
		
} 
else {
	$loginUrl = $helper->getLoginUrl('https://fbvideodownloader.herokuapp.com', $permissions);
	#$loginUrl = $helper->getLoginUrl('https://sandy2095.github.io/', $permissions);
	echo '<a class=button href="'. $loginUrl .'"><input id="submit" name="submit" type="submit"></a></div>';
	 
}
?>
</form>
</body>
</html>
