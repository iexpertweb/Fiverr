<!DOCTYPE html>
<html lang="en">
<head>
	<script src="https://analytics.ahrefs.com/analytics.js" data-key="dErUc1/JTcsii3f/zUV8vw" async></script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Fiverr Always Active</title>
	<link rel="icon" type="image/png" href="//assetsv2.fiverrcdn.com/assets/favicon-16x16-5eb118ca03b795f9dca72cd0d84d5775.png" sizes="16x16">
	
	<style>
		.container{
		    margin: auto;
		    text-align: center;
		    vertical-align: middle;
		}

		mark{
			padding: 0px 10px;
		}

		body{
			display: grid;
		    vertical-align: middle;
		    height: 100%;
		    width: 100%;
		    position: fixed;
		}
		
		input{
		    border: 0;
            box-shadow: inset 0 0 2px grey;
            height: 40px;
            width: 300px;
            padding-left: 15px;
		}
		
		button{
		    border: 0;
            box-shadow: inset 0 0 2px grey;
            height: 40px;
            padding-left: 25px;
            padding-right: 25px;
		}
	</style>
</head>
<body>
	<?php if(!isset($_GET['username'])): ?>
		<div class="container">
			<h1>Type your username</h1>
			<form method="get" action="">
			    <input type="number" style="width: 150px;" name="min" value="3" placeholder="Min Refresh Time(Minutes)"> 
			    <input type="number" style="width: 150px;" name="max" value="5" placeholder="Max Refresh Time(Minutes)"> <br><br>
				<input type="text" name="username" placeholder="Type username here...">
				<button>Submit</button>
			</form>
		</div>
	<?php else: ?>
		<div class="container">
			<h1>Current URL: <mark id="url"></mark></h1>
			<h2>Open next URL in <mark id="sec"></mark></h2>
			<h1>Next URL: <mark id="next_url"></mark></h1>
		</div>
		<script>
			var username = <?php 
				echo "'" . str_replace([ 
					'"',
					"'"
				], 
				"", 
				strip_tags($_GET['username'])) . "'"; 
			?>;
			var sec = 0;
			var urls = [ 
				'https://www.fiverr.com/users/' + username + '/seller_dashboard',
				'https://www.fiverr.com/inbox',
				'https://www.fiverr.com/users/' + username + '/manage_orders?source=header_navigation',
				'https://www.fiverr.com/users/' + username + '/manage_gigs',
				'https://www.fiverr.com/users/' + username + '/seller_analytics_dashboard',
				'https://www.fiverr.com/users/' + username + '/balance/sales',
			];
			var url = urls[0];

			openURL();
			setInterval(function(){
				sec--;
				refresh_sec();
			}, 1000);


			function refresh_sec(){
				r('sec').innerHTML = sec.toHHMMSS();
			}

			function openURL(){
				var i = getRandomInt(0, urls.length - 1);

				if(url == urls[i]){
					openURL();
					return;
				}

				window.open(url, '_fiverr');
				r('url').innerHTML = url;

				url = urls[i];
				r('next_url').innerHTML = url;

				sec = getRandomInt(60 * <?php echo (int)$_GET['min']; ?>, 60 * <?php echo (int)$_GET['max']; ?>);
				
				setTimeout(openURL, sec * 1000);

				return i;
			}

			function getRandomInt(min, max) {
			    min = Math.ceil(min);
			    max = Math.floor(max);
			    return Math.floor(Math.random() * (max - min + 1)) + min;
			}

			function r(id){
				return document.getElementById(id);
			}

			Object.prototype.toHHMMSS = function () {
			    var sec_num = parseInt(this, 10); // don't forget the second param
			    var hours   = Math.floor(sec_num / 3600);
			    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
			    var seconds = sec_num - (hours * 3600) - (minutes * 60);

			    if (hours   < 10) {hours   = "0"+hours;}
			    if (minutes < 10) {minutes = "0"+minutes;}
			    if (seconds < 10) {seconds = "0"+seconds;}
			    return minutes+':'+seconds;
			}

		</script>
	<?php endif; ?>
</body>
</html>
