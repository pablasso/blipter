<?php 
require_once 'lib/registrations.php';
$registrations = new Registrations();
$account_created = $registrations->register_user($_POST);
?>

<?php if ($account_created): ?>
	<div>
		<div class="toolbar">
	    	<h1>Link accounts</h1>
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