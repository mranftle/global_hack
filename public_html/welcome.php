<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

</head>
<body> 

	<form action = "login_police.php" method = "Post"> 
		<input id = "start" name = "start" type = "hidden" value = "true" />
		<td>
			POLICE LOGIN/USER CREATE
		</td>
		<label>Username:<input type = "text" name = "user" id = "user"/></label>
		</br>
		<label>Password:<input type = "password" name = "passwd" id = "passwd"/></label>
		</br>
		<label>Badge ID(if creating user):<input type = "text" name = "badge_id" id = "badge_id"/></label>
		</br>
		
		<label>Login<input type = "submit" name = "action" value = "login"/></label>
		<label>Create User<input type = "submit" name = "action" value = "create"/></label>
	</form>
</body>

</html>








