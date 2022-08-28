<?php
session_start();

unset($_SESSION['IS_LOGIN']);
unset($_SESSION['ADMIN_USER']);
redirect('login.php');
function redirect($link){
	?>
	<script>
	window.location.href='<?php echo $link?>';
	</script>
	<?php
	die();
}
?>