<?php
	$pathToUserData =  __DIR__.'\data\users.txt';
	$f = fopen($pathToUserData, 'a+');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Users table</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<a href="index.php" id="home">
		<i class="fas fa-home"></i>
	</a>
	<?php
		$rowCount = 0;
		while(!feof($f))
		{
			$boof = fgetc($f);
			if($boof == "\n")
			{
				$rowCount++;
			}
		}
		fclose($f);
		if($rowCount == 0)
		{
			?>
			<h1>No user data available</h1>
		<?php
		}
		else
		{
			?>
			<table>
				<?php
				$f = fopen($pathToUserData, 'a+');
				for($i = 0; $i <= $rowCount;)
				{
					if($i == 0)
					{
						?>
						<tr>
							<th id="login">Login</th>
							<th id="password">Password</th>
							<th id="email">Email</th>
							<th id="avatar">Avatar</th>
						</tr>
					<?php
						$i++;	
					}
					else
					{
					?>
					<tr>
						<?php
						for($j = 0;;$j++)
						{
							$temp = fgetc($f);
							if($temp == " ")
							{
								?>
								<td> <?php echo $data ?></td>
								<?php
								$data = "";
								continue;
							}
							if($temp == "\n")
							{
								?>
								<td><img src="<?= $data ?>"></td>
								<?php
								$i++;
								$data = "";
								break;
							}
							$data .= $temp;
						}
						?>
					</tr>
					<?php
					}
				
				}
				?>
			</table>
		<?php
		}
	?>
	
</body>
</html>