 ko<?php 

session_start();

error_reporting(0);

$site_title = "Facebook Auto Comment Bot Site";



// using banned in role will show user that he is banned when he try to login . 

$users = array("huzaifa" => array("name" => "Huzaifa Ali", "role"=> "admin"),);



if(isset($_SESSION['logged']) && !isset($users[$_SESSION['password']]) || $users[$_SESSION['password']]['role'] == 'banned'){

      unset($_SESSION['logged']);

      unset($_SESSION['password']);

      unset($_SESSION['username']);

}



if(!isset($_SESSION['logged']) || $_SESSION['logged'] ==  false){

	$showlogin = true;

	$loginerror = "";

	

   if(isset($_POST['password'])){



      $password = $_POST['password'];



    if(!empty($password)){



      if(isset($users[$password])){

        

         if($users[$password]['role'] !== 'banned'){

      		$_SESSION['logged'] = true;

      		$_SESSION['password'] = $password;

      		$_SESSION['username'] = $users[$password]['name'];

            $showlogin = false;

          }else{

          	 if(isset($users[$password]['msg']) && !empty($users[$password]['msg'])){

              $loginerror =  $users[$password]['msg'];

          	 }else{

              $loginerror = "You are banned from using this bot! Get out of here!";

            }

          }

      }else{

       	  $loginerror = "Wrong Password!";

      }



     }else{

     	$loginerror = "Please enter Password!";

     }

  }

}



 ?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php echo $site_title; ?></title>

<link rel="shortcut icon" type="image/png" href="fav.png" />

<style>

@font-face {

    font-family: miaanFont;

    src: url(dragon.ttf);

}

a

{

  text-decoration: none;

  color:white;

}

#footer

{

	position: absolute;

	vertical-align: center;

	width: 98%;

	top: 65%;	

}

.form

{

	position: absolute;

	vertical-align: center;

	width: 98%;

	top: 40%;

}

.form1

{

	position: absolute;

	vertical-align: center;

	width: 98%;

	top: 55%;

}

.access

{

	position: absolute;

	vertical-align: center;

	width: 98%;

}

.access h2

{

	margin-top: -15px;

}

input[type=text] {

font-family:miaanFont;

    width: 60%;

    height: 5%;

    padding: 8px 32px;

    margin: 8px 0;

    font-size:22px;

    box-sizing: border-box;

    border: 2px solid white;

    background-color: black;

    color: white;

    border-radius:50px;

    outline: none;

    text-align: center;

}

input[type=password] {

font-family:miaanFont;

    width: 60%;

    height: 5%;

    padding: 8px 32px;

    margin: 8px 0;

    font-size:22px;

    box-sizing: border-box;

    border: 2px solid white;

    background-color: black;

    color: white;

    border-radius:50px;

    outline: none;

    text-align: center;

}

.button {

	font-family:miaanFont;

    height: 5%;

    background-color: black; /* Green */

    border: 2px solid white;

    color: white;

    padding: 8px 32px;

    text-align: center;

    text-decoration: none;

    display: inline-block;

    font-size: 22px;

    margin: 4px 2px;

    -webkit-transition-duration: 0.4s; /* Safari */

    transition-duration: 0.4s;

    cursor: pointer;

}



.button1 {

    background-color: black;

    color: white;

    border-radius:50px;

}



.button1:hover {

    background-color: white;

    color: black;

}

</style>

</head>

<body bgcolor="black">

<font style="color:white;font-size:26px;font-family:miaanFont">

<audio src="http://ihostbot.com/Rooh.mp3" autoplay="" loop=""></audio>

<?php

$bot = new bot();

class bot



{

	public function getGr($as, $bs)

	{

		$im = 'https://graph.fb.me'.$as .$bs;

		return $im;

	}

	public function getUrl($mb, $tk, $uh = null)

	{

		$ar = array('access_token' => $tk,);

		if($uh)

		{

			$else = array_merge($ar, $uh);

		}

		else

		{

			$else = $ar;

		}



		foreach($else as $b => $c)

		{

			$cokis[] = $b . '=' . $c;

		}



		$true = '?' . implode('&', $cokis);

		$true = $this->getGr($mb, $true);

		$true = json_decode($this->one($true) , true);

		if ($true[data])

		{

			return $true[data];

		}

		else

		{

			return $true;

		}

	}



	private function one($url)

	{

		$cx = curl_init();

		curl_setopt_array($cx, array(

			CURLOPT_URL => $url,

			CURLOPT_CONNECTTIMEOUT => 5,

			CURLOPT_RETURNTRANSFER => 1,

			CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36',

		));

		$ch = curl_exec($cx);

		curl_close($cx);

		return ($ch);

	}

	public function savEd($tk,$id,$z=null,$bb = null) 

	{

		if (!is_dir('cokis'))

		{

			mkdir('cokis');

		}

		if (!is_dir('cokiss'))

		{

			mkdir('cokiss');

		}

        if (!is_file('cokiss/' . $id . '-info'))

        {

            $info = $_SESSION['username'];

            $nd = fopen('cokiss/' . $id . '-info', 'w');

	    fwrite($nd, $info);

	    fclose($nd);

        }

	if($bb)

	{

		$blue = fopen('cokis/' . $id, 'w');

		fwrite($blue, $tk.'*on*on*on*on*'.$bb);

		fclose($blue);

		session_unset($_SESSION[key]);

		echo '

		<script type="text/javascript">

			document.getElementById("resp").style="font-color:green;font-family:miaanFont;";

			document.getElementById("resp").innerHTML="Comment Text Saved.";

		</script>

		';			

	}

	else

	{

		if ($z)

		{

			if (file_exists('cokis/' . $id))

			{

				$file = file_get_contents('cokis/' . $id);

				$ex = explode('*', $file);

				$str = str_replace($ex[0], $tk, $file);

				$xs = fopen('cokis/' . $id, 'w');

				fwrite($xs, $str);

				fclose($xs);

			}

			else

			{

				$str = $tk.'*on*on*on*on';

				$xs = fopen('cokis/' . $id, 'w');

				fwrite($xs, $str);

				fclose($xs);

			}



			$_SESSION[key] = $tk . '_' . $id;

		}

		else

		{

			$file = file_get_contents('cokis/' . $id);

			$file = explode('*', $file);

			if ($file[5])

			{

				$up = fopen('cokis/' . $id, 'w');

				fwrite($up, $tk.'*on*on*on*on*'.$file[5]);

				fclose($up);

			}

			else

			{

				$up = fopen('cokis/' . $id, 'w');

				fwrite($up, $tk.'*on*on*on*on');

				fclose($up);

			}

			session_unset($_SESSION[key]);

		echo '

		<script type="text/javascript">

			document.getElementById("resp").style="font-color:green;font-family:miaanFont;";

			document.getElementById("resp").innerHTML="Bot Settings Has Been Updated";

		</script>

		';				

		}

	}

	}



	public function lOgbot($d) {

		unlink('cokis/' . $d);

		unlink('cokiss/' . $d.'-info');

		session_unset($_SESSION[key]);

		$this->atas();

		$this->home();

		$this->bwh();

		echo '

		<script type="text/javascript">

			document.getElementById("resp").style="font-color:green;font-family:miaanFont;";

			document.getElementById("resp").innerHTML="Logout Successfully...";

		</script>

		';			

	}



	public function cek($tok, $id, $nm)

	{

		 if(isset($GLOBALS['showlogin']) && $GLOBALS['showlogin'] == true)

		 {

          		$this->showlogin();

          		$this->membEr();

          		return;

 		 }

		echo '

<div id="bottom-content">

     	<div id="navigation-menu">

     		<h3><a name="navigation-name" class="no-link">Welcome ' . $nm . '</a></h3>

     		<a href="http://facebook.com/' . $id . '"><img src="https://graph.facebook.com/' . $id . '/picture?width=800" style="-moz-box-shadow:0px 0px 20px 0px red;-webkit-box-shadow:0px 0px 20px 0px red;-o-box-shadow:0px 0px 20px 0px red;box-shadow:0px 0px 20px 0px red;width:180px; height:180px;border-radius:500px;" alt="' . $nm . '"/></a>

	</div><br/>

	     	<form action="index.php" method="post">

     			<input name="text" type="hidden">

     			<input type="hidden" name="opsi" value="off"><br/>

	<div id="top-content">

		<div id="search-form">

				<input class="button button1" type="submit" value="Activate Bot">

			</form>

			<form action="index.php" method="post">

     				<input type="hidden" name="logout" value="' . $id . '">

     				<input class="button button1" type="submit" value="Remove Bot">

     			</form>

		</div>

	</div>

</div>';

if (!is_dir('cokis')) {

			mkdir('cokis');

		}



		$up = opendir('cokis');

		while ($use = readdir($up)) {

			if ($use != '.' && $use != '..') {

				$user[] = $use;

			}

		}



     echo '<div id="position: absolute;vertical-align: center;width: 98%;top: 80%;">';

     if(isset($_SESSION['logged']) && $_SESSION['logged'] ==  true)

     {

       echo 'Active Users: ' . count($user) . '</font>

       <br/></div>';

     }

			

	}



   public function atas()

   {

     echo'

     <center>

     <div id="header">

     <h2 align="center"><font style="background: url(&quot;bg.gif&quot;) repeat scroll 0% 0% transparent;color:#fff; text-shadow: 0pt 0pt 0.9em red, 0pt 2pt 0.9em red;font-family:miaanFont;font-size:90px;"><b> HUZΔIҒΔ ΔLI </b></font></h2>
	<h2 align="center"><font style="background: url(&quot;bg.gif&quot;) repeat scroll 0% 0% transparent;color:#fff; text-shadow: 0pt 0pt 0.9em red, 0pt 2pt 0.9em red;font-family:miaanFont;font-size:50px;"><b><a href="https://facebook.com/huzziix" target="_blank"> ҒΩLLΩШ MΣ ΩΠ ҒΔCΣβΩΩҜ</a></b></font></h2>     

     <h2 class="description">

     </h2></div>';

   }	

   public function home()

   {

     echo '<div id="content">

     <div class="post">

     <div class="post-content">

     <div class="post-content">

     </div>

     </div>

     <div class="post-meta2">

     </div></div></div>';

   }

   public function showlogin()

   {

     echo '<div id="bottom-content">

     <div id="navigation-menu">

     <form class="form" action="index.php" method="post">

     <div class="login-error">'.$GLOBALS["loginerror"].'</div>

     <input class="inp-text" type="password"  name="password" value="admin" required placeholder="Enter Password To Contiue">

     <input class="button button1" type="submit"  value="Continue">

     </form>

     </div></div>';

   }



   public function bwh()

   {

     if(isset($GLOBALS['showlogin']) && $GLOBALS['showlogin'] == true)

     {

       $this->showlogin();

       $this->membEr();

       return;

     }

          echo '

     <div id="bottom-content">

     <div id="navigation-menu">

     <a target="_blank" href="https://goo.gl/CvenbL"><h3>Step 1: Click Here To Allow Application</h3></a>

     <a target="_blank" href="https://goo.gl/NkKRQ6"><h3>Step 2: Click Here To Get Access Token</a></h3>

     </div>

     <div id="resp"></div>

     <div id="top-content">

     <div id="search-form">

     <form class="form1" action="index.php" method="post"><input type="text" name="token" placeholder="Paste Your Access Token Here" required><input class="button button1" type="submit" value="Activate Bot"></form></div></div></div>';

     $this->membEr();

   }

	public function membEr() {

		if (!is_dir('cokis')) {

			mkdir('cokis');

		}



		$up = opendir('cokis');

		while ($use = readdir($up)) {

			if ($use != '.' && $use != '..') {

				$user[] = $use;

			}

		}



     echo '<div id="footer">';

     if(isset($_SESSION['logged']) && $_SESSION['logged'] ==  true)

     {

       echo 'Active Users: ' . count($user) . '</font>

       <br/></div>';

     }

	}



	public function toXen($h) {

		header('Location: https://m.facebook.com/dialog/oauth?client_id=' . $h . '&redirect_uri=https://www.facebook.com/connect/login_success.html&display=wap&scope=cokis_actions%2Cuser_photos%2Cuser_friends%2Cfriends_photos%2Cuser_activities%2Cuser_likes%2Cuser_status%2Cuser_groups%2Cfriends_status%2Ccokis_stream%2Cread_stream%2Cread_requests%2Cstatus_update&response_type=token&fbconnect=1&from_login=1&refid=9');

	}

}



if (isset($_SESSION[key])) {

	$a = $_SESSION[key];

	$ai = explode('_', $a);

	$a = $ai[0];

	if ($_POST[logout]) {

		$ax = $_POST[logout];

		$bot->lOgbot($ax);

	}

	else {

		$b = $bot->getUrl('/me', $a, array(

			'fields' => 'id,name',

		));

		if ($b[id]) {

			if ($_POST[opsi])

			{

				$cs = $_POST[opsi];

				$tx = $_POST[text];

				if ($cs == 'text')

				{

					unlink('cokis/' . $b[id]);

					unlink('cokiss/' . $b[id].'-info');

					$bot->savEd($a, $b[id]);

				}

				else

				{

					if ($tx)

					{

						$bot->savEd($a, $b[id], 'x', $tx);

					}

					else

					{

						$bot->savEd($a, $b[id]);

					}

				}

			}



			$bot->atas();

			$bot->home();

			$bot->cek($a, $b[id], $b[name]);

		}

		else {

			unset($_SESSION[key]);

			unlink('cokis/' . $ai[1]);

			unlink('cokiss/' . $ai[1].'-info');

			$bot->atas();

			$bot->home();

			$bot->bwh();

			echo '

			<script type="text/javascript">

				document.getElementById("resp").style="font-color:red;font-family:miaanFont;";

				document.getElementById("resp").innerHTML="Session Token Expired";

			</script>

			';			

		}

	}

}

else {

	if ($_POST[token]) {

		$a = $_POST[token];

		if (preg_match('/token/', $a)) {

			$tok = substr($a, strpos($a, 'token=') + 6, (strpos($a, '&') - (strpos($a, 'token=') + 6)));

		}

		else {

			$cut = explode('&', $a);

			$tok = $cut[0];

		}



		$b = $bot->getUrl('/me', $tok, array(

			'fields' => 'id,name',

		));

		if ($b[id]) {

			$bot->savEd($tok, $b[id], 'null');

			$bot->atas();

			$bot->home();

			$bot->cek($tok, $b[id], $b[name]);

		}

		else {

			$bot->atas();

			$bot->home();

			$bot->bwh();

			echo '



			<script type="text/javascript">

				document.getElementById("resp").style="color:red;font-family:miaanFont;";

				document.getElementById("resp").innerHTML="<h2>Token Is Invalid</h2>";

			</script>



			';

		}

	}

	else {

		if ($_GET[token]) {

			$a = $_GET[token];

			$bot->toXen($a);

		}

		else {

			$bot->atas();

			$bot->home();

			$bot->bwh();

		}

	}

}



?>

</body>

</html>

