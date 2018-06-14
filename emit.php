<?php
include("vendor/autoload.php");

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

if (isset($_POST['submit'])) {
	$form_data = array(
		"first_name"=>$_POST["first_name"],
		"last_name"=>$_POST["last_name"],
		"email"=>$_POST["email"],
		"message"=>$_POST["message"]
	);

	// var_dump($_SERVER);
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
		$port_num = 3000;
	}else{
		$port_num = 3001;
	}
	// $port_num = 3000;
	// print_r($port_num);
	$version = new Version2X("http://localhost:$port_num");
	$client = new Client($version);
	$client -> initialize();
	$client -> emit("new_order",$form_data);
	$client -> close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<div>
		<form action="" method="POST">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-1">
					<div class="form-group">
						<label for="first_name">First Name</label>
						<input type="text" id="first_name" name="first_name" class="form-control">
					</div>

					<div class="form-group">
						<label for="last_name">Last Name</label>
						<input type="text" id="last_name" name="last_name" class="form-control">
					</div>

					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" id="email" name="email" class="form-control">
					</div>

					<div class="form-group">
						<label for="message">Special Instructions</label>
						<textarea type="text" id="message" name="message" class="form-control"></textarea>
					</div>

					<div class="form-inline text-center">
						<input type="submit" name="submit" class="btn btn-primary" value="Submit">
					</div>

				</div>
			</div>
		</form>
	</div>
</body>
</html>