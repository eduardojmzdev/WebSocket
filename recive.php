<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script  src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>

</head>
<body>
<table class="table">
	<thead>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Order</th>
		</tr>
	</thead>
	<tbody id="body_table">

	</tbody>
</table>

<script>
	var socket = io.connect("http://localhost:3001");
	socket.on("new_order",function(data){
		// console.log(data);
		$('#body_table').append("<tr><td>"+data.first_name+"</td><td>"+data.last_name+"</td><td>"+data.email+"</td><td>"+data.message+"</td>")
	});
</script>

</body>
</html>