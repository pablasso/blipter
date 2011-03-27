<?php 
require_once 'lib/registrations.php';
$registrations = new Registrations();
$user = $registrations->get_user($_POST['email'], $_POST['password']);
?>

<?php if ($user != null): ?>
	<div>
		<div class="toolbar">
	    	<h1>Logged user!</h1>
            <a class="button" id="infoButton" href="signout.php">Sign out</a>
		</div>
	</div>
<?php else: ?>
	<div>
        <div class="toolbar">
            <h1>Oops</h1>
            <a class="back" href="#signup">Back</a>
        </div>

		<?php foreach ($registrations->error_messages as $message): ?>
        <div class="info"><?php echo $message ?></div>	
		<?php endforeach ?>
	</div>
<?php endif ?>