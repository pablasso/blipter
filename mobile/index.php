<?php session_start(); ?><!doctype html>
<?php

$sync_url = "http://blipter.com/s.php";

if (isset($_SESSION['user'])) {
	$home_class = "";
	$accounts_class = "current";
} 
else {
	$home_class = "current";
	$accounts_class = "";
}

?>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Blipter</title>
		<style type="text/css" media="screen">@import "jqtouch/jqtouch.min.css";</style>
		<style type="text/css" media="screen">@import "themes/jqt/theme.min.css";</style>
		<style type="text/css" media="screen">@import "css/blipter.css";</style>
		<script src="jqtouch/jquery.1.3.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="jqtouch/jqtouch.min.js" type="application/x-javascript" charset="utf-8"></script>
		<script src="http://js.pusherapp.com/1.7/pusher.min.js" type="text/javascript"></script>
		<script src="js/md5.js" type="application/x-javascript" charset="utf-8"></script>
		<script src="js/blipter.js" type="application/x-javascript" charset="utf-8"></script>
		<script type="text/javascript" charset="utf-8">
			var jQT = new $.jQTouch({
			    icon: 'jqtouch.png',
			    addGlossToIcon: false,
			    startupScreen: 'jqt_startup.png',
			    statusBar: 'black',
			    preloadImages: [
			        'themes/jqt/img/back_button.png',
			        'themes/jqt/img/back_button_clicked.png',
			        'themes/jqt/img/button_clicked.png',
			        'themes/jqt/img/grayButton.png',
			        'themes/jqt/img/whiteButton.png',
			        'themes/jqt/img/loading.gif'
			        ]
			});
		</script>
	</head>
	<body>

		<!-- Sign up  -->
		
		<div id="home" class="<?php echo $home_class ?>">
			<div class="toolbar">
				<h1>Blipter</h1>
                <a class="button flip" id="infoButton" href="#signin">Sign in</a>
			</div>
			<form id="create_account" action="create_account.php" method="POST" class="form">
				<ul class="edit rounded">
					<li><input type="text" name="email" placeholder="Email" id="email" /></li>
					<li><input type="password" name="password" value="somepass" id="password" /></li>
					<li><input type="checkbox" checked="checked" name="newsletter" value="1" id="newsletter" title="Notify me when Blipter launches" /></li>
				</ul>
				<a style="margin:0 10px;color:rgba(0,0,0,.9)" href="#" class="submit whiteButton">Create my account</a>
			</form>
			<br /><br /><br /><br /><br />
            <div class="info">
                <p>Add this page to your home screen for the best experience.</p>
            </div>
		</div>
		
		<!-- Sign in -->
		
		<div id="signin">
			<div class="toolbar">
				<h1>Blipter</h1>
                <a class="button flip" id="infoButton" href="#home">Sign up</a>
			</div>
			<form id="login_account" action="login_account.php" method="POST" class="form">
				<ul class="edit rounded">
					<li><input type="text" name="email" placeholder="Email" id="email" /></li>
					<li><input type="password" name="password" value="somepass" id="password" /></li>
				</ul>
				<a style="margin:0 10px;color:rgba(0,0,0,.9)" href="#" class="submit whiteButton">Sign in</a>
			</form>
			<br /><br /><br /><br /><br /><br /><br /><br />
			<div class="info">
				<p>Add this page to your home screen for the best experience.</p>
			</div>
		</div>

		<!-- Accounts -->
		
		<div id="accounts" class="<?php echo $accounts_class ?>">
			<div class="toolbar">
				<h1>Accounts</h1>
			</div>
			<div class="info">
				Link the accounts that you want to see on the stream.
			</div>
			
            <ul class="rounded">
                <li class="arrow"><a href="#github">Github</a></li>
                <li class="arrow"><a href="#">Kiln</a></li>
                <li class="arrow"><a href="#">Pivotal Tracker</a></li>
                <li class="arrow"><a href="#">Zendesk</a></li>
            </ul>

            <ul class="rounded">
            	<li class="arrow"><a href="#activity">Continue</a></li>
			</ul>
		</div>
		
		<!-- Github pairing -->

		<div id="github">
			<div class="toolbar">
				<h1>Github Sync</h1>
                <a class="back" href="#link_accounts">Back</a>
			</div>
			<div class="info">
				Enter this URL in your repository <br /> admin section under "Service Hooks":
				<br /><br />				
				<?php echo "{$sync_url}?c=" . intval($_SESSION["user"]["id"], 36) ?>
			</div>
		</div>
		
		<!-- Activity -->

		<div id="activity">
			<div class="toolbar">
				<h1>Blipter Activity</h1>
                <a class="back" href="#accounts">Back</a>
			</div>
			<script type="text/javascript" charset="utf-8">
				listenPushOnChannel('<?php echo intval($_SESSION["user"]["id"], 36) ?>');
			</script>
			<div class="activity_stream">
			</div>
		</div>

	</body>
</html>