<?php
/**
 * Created by PhpStorm.
 * User: Orhan Gazi
 * Date: 28.10.2016
 * Time: 16:47
 */

include "configure.php";

if (isset($_GET['logout'])){
	session_destroy();
	session_unset();
	$oturum = false;
}

if($_SESSION['user-name']!=""){
	$oturum = true;
}else{
	$oturum = false;
}

var_dump($_SESSION['user-name']);

if(isset($_POST['loginin'])) {
	$user_name = $_POST['user-name'];
	$password = $_POST['password'];
	if ($user_name == $user_name_config && $password == $password_config) {
		$_SESSION['user_name'] = $user_name;
		$_SESSION['password'] = $password;
		$form = "";
		$oturum = true;
	}else{
		$message = "Login unsuccessful";
		$oturum = false;
	}
}

if(isset($_POST['save'])){
	$info_json = json_decode(file_get_contents("json/info.json"));
	$info_json_file = fopen("json/info.json","w");
	$info_json->name = trim($_POST["streamer-name"]);
	$info_json->image = trim($_POST["streamer-picture"]);
	$info_json->channel_name = trim($_POST["channel-name"]);
	$info_json->channel_url = trim($_POST["channel-address"]);

	$stream_time = explode(":",$_POST["stream-time"]);
	$stream_time_clock = trim($stream_time[0]);
	$stream_time_minutes = trim($stream_time[1]);
	$info_json->stream_date = trim(trim($_POST["stream-date"])."/$stream_time_clock/$stream_time_minutes");

	$info_json->logo_url = trim($_POST["channel-logo"]);
	$info_json->background_image_url = trim($_POST["channel-background"]);
	$info_json->biography = trim($_POST["biography"]);
	$info_json->phone = trim($_POST["phone"]);
	$info_json->email = trim($_POST["email"]);

	$info_json = json_encode($info_json);
	$write = fwrite($info_json_file,$info_json);
	$message = $write ? "Successfully saved" : "Unuccessfully saved";
	fclose($info_json_file);
}

if($oturum){
	$info = json_decode(file_get_contents("json/info.json"),true);
	$streamer_name = $info["name"];
	$streamer_picture = $info["image"];
	$channel_name = $info["channel_name"];
	$channel_url = $info["channel_url"];
	$stream_time = explode("/",$info["stream_date"]);
	$stream_date_day = $stream_time[0];
	$stream_date_mounth = $stream_time[1];
	$stream_date_year = $stream_time[2];
	$stream_date_clock = $stream_time[3];
	$stream_date_minutes = $stream_time[4];
	$stream_date = "$stream_date_day/$stream_date_mounth/$stream_date_year";
	$stream_time = "$stream_date_clock:$stream_date_minutes";

	$logo_url = $info["logo_url"];
	$background_image_url = $info["background_image_url"];
	$biography = $info["biography"];
	$phone = $info["phone"];
	$email = $info["email"];
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/clockpicker.css">
	<link rel="stylesheet" href="css/bootstrap-datepicker3.min.css">

	<title>User Panel</title>
</head>
<body>
	<?php
		if (!$oturum) {
			echo "<div class='col-md-4 container-login'>
					<form action='login' method='post'>
						<h3>Login info:</h3>
						<input type='text' class='form-control' name='user-name' placeholder='User name'>
						<input type='password' class='form-control' name='password' placeholder='Password'>
						<button name='loginin' class='btn btn-block btn-primary' value='true'>Login in</button>
						<span>$message</span>
					</form>
					</div>";
		}
		else {
			echo "<div class='container-login'>
		<form action='' method='post'>
			<h2 class='login-title'>SETTİNGS</h2><h3 class='login-title-logout'><a href='?logout=true'>Logout</a></h3><div class='clearfix'></div>
			<div class='channel-settings'>
				<h3>Channel Settings</h3>
				<span>Channel name:</span>
				<input type='text' name='channel-name' class='form-control channel-settings-item' placeholder='Channel name' value='$channel_name'>
				<span>Channel address:</span>
				<input type='text' name='channel-address' class='form-control channel-settings-item' placeholder='With http://' value='$channel_url'>
				<span>Logo image:</span>
				<input type='text' name='channel-logo' class='form-control channel-settings-item' placeholder='With http://' value='$logo_url'>
				<span>Background image:</span>
				<input type='text' name='channel-background' class='form-control channel-settings-item' placeholder='With http://' value='$background_image_url'>
				<div class='stream-date'>
					<h4>Stream Date:</h4>
					<input type='text' name='stream-date' class='form-control' id='stream-date' placeholder='Stream Date' value='$stream_date'>
				</div>
				<div class='stream-time'>
					<h4>Stream Time:</h4>
					<div class='input-group clockpicker' data-placement='top' data-align='top' data-autoclose='true'>
						<input type='text' class='form-control' id='stream-time' name='stream-time' value='$stream_time'>
						<span class='input-group-addon'>
						<span class='glyphicon glyphicon-time'></span>
					</span>
					</div>
				</div>
			</div>
			<div class='biography-settings'>
				<h3>Streamer's Biography Settings</h3>
				<span>Steamer name:</span>
				<input type='text' name='streamer-name' class='form-control channel-settings-item' placeholder='Streamer name' value='$streamer_name'>
				<span>Streamer picture:</span>
				<input type='text' name='streamer-picture' class='form-control channel-settings-item' placeholder='Channel name' value='$streamer_picture'>
				<span>Biography:</span>
				<textarea name='biography' class='form-control channel-settings-item' placeholder='Biography'>$biography</textarea>
				<span>Phone:</span>
				<input type='text' name='phone' class='form-control channel-settings-item' placeholder='Phone' value='$phone'>
				<span>E-mail:</span>
				<input type='email' name='email' class='form-control channel-settings-item' placeholder='Email' value='$email'>
			</div>
			<button class='btn btn-success btn-block' name='save' value='true'>SAVE</button>
			<span class='text-center'>$message</span>
		</form>
	</div>";
		}
	?>
	<script src="js/jquery3.1.min.js"></script>
	<script src='js/clockpicker.js'></script>
	<script src='js/bootstrap-datepicker.min.js'></script>
	<script src='js/script.js'></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
