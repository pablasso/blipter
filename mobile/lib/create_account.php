<?php 

require_once 'registrations.php';
$registrations = new Registrations();
$account_created = $registrations->create_account($_POST);

?>

<?php if ($account_created): ?>
	<div>
		<div class="toolbar">
	    	<h1>Link accounts</h1>
	    	<a href="#" class="button back">Back</a>
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