function listenPushOnChannel(userID) {
	Pusher.log = function() {
	  if (window.console) window.console.log.apply(window.console, arguments);
	};

	Pusher.channel_auth_endpoint = 'lib/presence_auth.php';
	var socket = new Pusher('1720c383aed9661954fd');
	var presenceChannel = socket.subscribe('presence-' + userID);

	socket.bind('basecamp_push',function(data) {
		var elm = '<div class="info"><img src="img/icon_basecamp.png"> <strong>time: ' + data.time + '</strong>: Basecamp '  +  data.content+'</div>';
		$('.push_stream').prepend(elm);
	});
	
	socket.bind('dropbox_push',function(data) {
		var elm = '<div class="info"><img src="img/icon_dropbox.png"> <strong>time: ' + data.time + '</strong>: Dropbox '  +  data.content+'</div>';
		$('.push_stream').prepend(elm);
	});
	
	socket.bind('github_push',function(data) {
		var elm = '<div class="info"><img src="img/icon_github.png"> <strong>time: ' + data.time + '</strong>: Github '  +  data.content+'</div>';
		$('.push_stream').prepend(elm);
	});
}