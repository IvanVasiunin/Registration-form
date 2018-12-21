<?php
	$pathToUserData =  __DIR__.'\data\users.txt';
	$counter = 0;
	$f = fopen($pathToUserData, 'a+');
	while(!feof($f))
	{
		$boof = fgetc($f);
		if($boof == "\n")
		{
			$counter++;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Main page</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="menu">
		<a href="addUsers.php">Add user</a>
		<a href="showUsers.php">Show users</a>
		<div class="usersCount">
			Total number of users: <?php echo $counter ?>
		</div>
	</div>
	
</body>
</html>