<?php
//polls info
/*$poll = file_get_contents("json/poll.json");
$poll_array = json_decode($poll,true);

for($i=0; $i<count($poll_array); $i++){
	//echo $poll_array['poll'][$i][0]['name']."<br>";
}*/

//streamer info
$info = file_get_contents("json/info.json");
$info_array = json_decode($info,true);
$name = $info_array['name'];
$image = $info_array['image'];
$channel_name = $info_array['channel_name'];
$channel_url = $info_array['channel_url'];
$logo_url = $info_array['logo_url'];
$background_image_url = $info_array['background_image_url'];
$biography = $info_array['biography'];
$phone = $info_array['phone'];
$email = $info_array['email'];
$latest_streams = "https://www.twitch.tv/$channel_name/videos/all";

$stream_time = explode("/",$info_array["stream_date"]);
$stream_date_day = $stream_time[0];
$stream_date_mounth = $stream_time[1];
$stream_date_year = $stream_time[2];
$stream_date_clock = $stream_time[3];
$stream_date_minutes = $stream_time[4];

$twitter = $info_array["social_networks"][0]["twitter"]['url'];
$twitter_logo = $info_array["social_networks"][0]["twitter"]['logo'];
$youtube = $info_array["social_networks"][1]["youtube"]['url'];
$youtube_logo = $info_array["social_networks"][1]["youtube"]['logo'];
$twitch_logo = $info_array["social_networks"][2]["twitch"]['logo'];
$twitch = $info_array["social_networks"][2]["twitch"]['url'];

$sponsors = $info_array['sponsors'];//array
?>
<!doctype html>
<html lang="en">
<head>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/flipclock.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"> -->
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="<?= "$channel_name'in websitesi - $name" ?>" />
	<title><?= $channel_name."'s Website" ?></title>
</head>
<body style="<?= "background-image:url($background_image_url);" ?>">
<nav class="header">
	<ul class="nav-menu">
		<li><a class="nav-link" href="<?= $channel_url?>" target="_blank"><img class="nav-logo" src="<?= $logo_url?>" alt="<?= $channel_name ?>"><h1 class="channel-name"><?= $channel_name ?></h1></a></li>

	</ul>
	<ul class="nav-menu right">
		<!-- <li><a class="nav-menu-item" href="<?= $latest_streams ?>">Latest Streams</a></li> -->
		<!-- <li><a onclick="$('.biography-container').animatescroll({scrollSpeed:1500,easing:'easeOutElastic'});" class="nav-menu-item">Biyography</a></li> -->
		<!--<li><a class="nav-menu-item">Vote</a></li>
		<li><a class="nav-menu-item">Weekly Calendar</a></li>-->
		<!-- <li><a href="<?= $channel_url ?>" class="nav-menu-item">Watch Stream</a></li> -->
		<li><a href="<?= $twitter ?>" target="_blank" class="nav-menu-item"><img src="<?= $twitter_logo ?>" width="50px"></a></li>
		<li><a href="<?= $youtube ?>" target="_blank" class="nav-menu-item"><img src="<?= $youtube_logo ?>" width="50px"></a></li>
		<li><a href="<?= $channel_url ?>" target="_blank" class="nav-menu-item"><img src="<?= $twitch_logo ?>" width="50px"></a></li>
		<!-- <div class="nav-menu-social">
			<ul>
				
			</ul>
		</div> -->
	</ul>
</nav>
<div class="container">
	<div class="countdowner-container"><div class="countdowner"></div></div>
	<!-- <div class="biography-container">
		<div class="biography">
			<div class="resim"><img src="<?= $image ?>" alt=""></div>
			<div class="biography-text">
				<h1 class="biography-text-title"><?= "$channel_name ($name)" ?></h1>
				<p><?= $biography ?></p>
			</div>
			<div class="info">
				<p class="email">E-mail: <?= $email ?></p>
				<p class="phone">Phone: <?= $phone ?></p>
			</div>
		</div>
	</div> -->
	<!-- <div class="weakly-calendar-container">

	</div> -->
	<!--<div class="channel-live-video-container">
		<div class="channel-live-video" id="channel-live-video"></div>
		<div class="channel-live-chat"><iframe frameborder="0" scrolling="no" id="chat_embed" src="http://www.twitch.tv/teasycat/chat" height="513" width="450"></iframe>
		</div>
	</div>-->
</div>
<footer class="footer">Developed by <a href="http://orhangazi.info" target="_blank">Orhan Gazi Kılıç</a> (Licence: <a href="http://www.gnu.org/licenses/gpl-3.0.txt" target="_blank">GNU GENERAL PUBLIC LICENSE</a>)</footer>
<script src="js/jquery3.1.min.js"></script>
<script src="js/flipclock.min.js"></script>
<script src="js/animatescroll.js"></script>
<script type="text/javascript" src="js/jquery.countdown.min.js"></script>
<!--<script src= "http://player.twitch.tv/js/embed/v1.js"></script>-->
<script type="text/javascript">
	$(function() {
			//countdown initialize gosterissiz
			var day = <?= $stream_date_day ?>;
			var mounth = <?= $stream_date_mounth ?>;
			var year = <?= $stream_date_year ?>;
			var oclock = <?= $stream_date_clock ?>;
			var minutes = <?= $stream_date_minutes ?>;

			var stream_time = new Date(year,mounth-1,day,oclock,minutes); //years, months, days, hours, minutes

			//console.log(stream_start);
		    $('.countdowner').countdown({
		        date: stream_time.getTime(),
		        render: function(data) {
				var el = $(this.el);
				el.empty()
					/*.append("<div>" + this.leadingZeros(data.years, 4) + " <span>years</span></div>")
					.append("<div>" + this.leadingZeros(data.days, 3) + " <span>days</span></div>")*/
					.append("<div>" + this.leadingZeros(data.hours, 2) + " <span>Saat</span></div>")
					.append("<div>" + this.leadingZeros(data.min, 2) + " <span>Dakika</span></div>")
					.append("<div>" + this.leadingZeros(data.sec, 2) + " <span>Saniye</span></div>");
				}
		    });
		});
</script>
<!-- <script>
	//countdown initialize
	var seconds = 1000; //24*60*60*1000; // hours*minutes*seconds*milliseconds
	var day = <?= $stream_date_day ?>;
	var mounth = <?= $stream_date_mounth ?>;
	var year = <?= $stream_date_year ?>;
	var oclock = <?= $stream_date_clock ?>;
	var minutes = <?= $stream_date_minutes ?>;

	var stream_time = new Date(year,mounth-1,day,oclock,minutes); //years, months, days, hours, minutes
	//var now = new Date(2016,10-1,27,2,0);
	var now = $.now();

	var diff = Math.round(Math.abs((stream_time.getTime() - now)/(seconds)));
	console.log(stream_time.getTime(),now,diff);

	var clock = $('.countdowner').FlipClock(diff,{
		// ... your options here
		countdown:true
	});
	clock.setCountdown(true);
	//countdown initialize

	/*//twitch channel-live-video
	var options = {
		width: 888,
		height: 514,
		channel: "teasycat"
		//video: "{VIDEO_ID}"
	};
	var player = new Twitch.Player("channel-live-video", options);
	player.setVolume(0.5);
	//twitch channel-live-video*/
</script> -->
</body>
</html>