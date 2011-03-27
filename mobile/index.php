<?php session_start(); ?><!doctype html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Blipter</title>
        <style type="text/css" media="screen">@import "jqtouch/jqtouch.css";</style>
        <style type="text/css" media="screen">@import "themes/jqt/theme.css";</style>
        <script src="jqtouch/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="jqtouch/jqtouch.js" type="application/x-javascript" charset="utf-8"></script>
        <script type="text/javascript" charset="utf-8">
            var jQT = new $.jQTouch({
                icon: 'blipter.png',
                icon4: 'blipter4.png',
                addGlossToIcon: true,
                startupScreen: 'splash.png',
                statusBar: 'black',
                preloadImages: [
                    'themes/jqt/img/activeButton.png',
                    'themes/jqt/img/back_button.png',
                    'themes/jqt/img/back_button_clicked.png',
                    'themes/jqt/img/blueButton.png',
                    'themes/jqt/img/button.png',
                    'themes/jqt/img/button_clicked.png',
                    'themes/jqt/img/grayButton.png',
                    'themes/jqt/img/greenButton.png',
                    'themes/jqt/img/redButton.png',
                    'themes/jqt/img/whiteButton.png',
                    'themes/jqt/img/loading.gif'
                    ]
            });
            $(function(){
                $('#jqt').bind('turn', function(e, data){
                    $('#orient').html('Orientation: ' + data.orientation);
                });
				$('input[name="password"]').focus(function() {
					if ($(this).val() == 'somepass') {
						$(this).val('');
					}
				});
				$('input[name="password"]').blur(function() {
					if ($(this).val().length == 0) {
						$(this).val('somepass');
					}
				});
            });
        </script>
        <style type="text/css" media="screen">
            #jqt.fullscreen #signup .info {
                display: none;
            }
            #jqt.fullscreen #signin .info {
                display: none;
            }
			#jqt #signup #small_checkbox {
				font-size: 15px;
			}
			#individual {
				align: center;
			}
        </style>
    </head>
    <body>
        <div id="jqt">
 
           <div id="signup" class="current">
                <div class="toolbar">
                    <h1>Blipter</h1>
                    <a class="button flipright" id="infoButton" href="#signin">Sign in</a>
                </div>
            	<form id="create_account" action="lib/create_account.php" method="POST" class="form">
                    <ul class="edit rounded">
                        <li><input type="email" name="email" placeholder="Email" id="email" /></li>
                        <li><input type="password" name="password" value="somepass" id="password" /></li>
                        <li><input class="small_checkbox" type="checkbox" name="newsletter" value="1" checked="checked" title="Notify me when Blipter launches" /></li>
                    </ul>
          			<a style="margin:0 10px;color:rgba(0,0,0,.9)" href="#" class="submit whiteButton">Create my account</a>
                </form>
				<br /><br />
                <div class="info">
                    <p>Add this page to your home screen for the best experience.</p>
                </div>
            </div>

            <div id="signin">
                <div class="toolbar">
                    <h1>Blipter</h1>
                    <a class="button flipleft" id="infoButton" href="#signup">Sign up</a>
                </div>
            	<form id="login_account" action="lib/login_account.php" method="POST" class="form">
                    <ul class="edit rounded">
                        <li><input type="email" name="email" placeholder="Email" id="email" /></li>
                        <li><input type="password" name="password" value="somepass" id="password" /></li>
                    </ul>
          			<a style="margin:0 10px;color:rgba(0,0,0,.9)" href="#" class="submit whiteButton">Sign in</a>
                </form>
				<br /><br /><br /><br /><br />
                <div class="info">
                    <p>Add this page to your home screen for the best experience.</p>
                </div>
            </div>

        </div>
    </body>
</html>