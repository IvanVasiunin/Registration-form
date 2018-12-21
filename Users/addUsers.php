<?php
	$pathToUserData =  __DIR__.'\data\users.txt';
	$uploadPath = 'data\uploads\\';
	$newRow = '';
	$unique = true;


	function addUser($filesData, $postData, $stream, $path){
		if(!empty($filesData))
		{
			$avatarData = $filesData['avatar'];
			if(move_uploaded_file(
				$avatarData['tmp_name'],
				$path.$avatarData['name']) !== false)
			{
				$newRow = $postData['login'].' '.md5($postData['password']).' '.$postData['email'].' '.$path.$avatarData['name'].PHP_EOL;
			}
			else
			{
				$newRow = $postData['login'].' '.md5($postData['password']).' '.$postData['email'].' '.PHP_EOL;
			}
		}
		else
		{
			$newRow = $postData['login'].' '.md5($postData['password']).' '.$postData['email'].' '.PHP_EOL;
		}
		fwrite($stream, $newRow);
	}

	if(!empty($_POST))
	{
		$f = fopen($pathToUserData, 'a+');
		if(file_get_contents($pathToUserData))
		{
			$f = fopen($pathToUserData, 'a+');
			$login = "";
			while(!feof($f))
			{
				$boof = fgetc($f);
				if($boof == " " && $login != "temp")
				{
					if($login == $_POST['login'])
					{
						$unique = false;
						break;
					}
					else
					{
						$login = "temp";
						continue;
					}
				}
				if($boof == "\n")
				{
					$login = "";
					continue;
				}
				if($login == "temp" && $boof != "\n")
				{
					continue;
				}
				$login = $login.$boof;
			}
			if($unique == true)
			{
				addUser($_FILES, $_POST, $f, $uploadPath);
				?>
				
				<div class="wrap">
					<div id="window">
						<p>Registration successfully completed</p>
						<button id="ok">OK</button>
					</div>
				</div>

			<?php 	
			}
			else
			{
				?>
				<div class="wrap">
					<div id="windowError">
						<p>This user already exists</p>
						<p>Please try again.</p>
						<button id="ok">OK</button>
					</div>
				</div>
			<?php
			}
		}
		else
		{
			addUser($_FILES, $_POST, $f, $uploadPath);
			?>	
			<div class="wrap">
					<div id="window">
						<p>Registration successfully completed</p>
						<button id="ok">OK</button>
					</div>
				</div>
		<?php
		}
		
		fclose($f);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add user</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<a href="index.php" id="home">
		<i class="fas fa-home"></i>
	</a>
	<form action="addUsers.php" enctype="multipart/form-data" method="post">
		<p class="formTitle">Enter the following data</p>
		<label for="login">Login:<span>*</span></label>
		<input type="text" name="login" id="login" placeholder="Enter your login here..." required>
		<label for="password">Password:<span>*</span></label>
		<input type="password" name="password" id="password"  placeholder="Enter your password here..." required>
		<label for="email">Email:<span>*</span></label>
		<input type="email" name="email" id="email"  placeholder="Enter your email here..." required>
		<label for="avatar">You can upload your avatar (*.png, *.jpg, *.jpeg)</label>
		<div class="preview">
			<p>No files currently selected for upload</p>
		</div>
		<input type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg">
		<p class="formInfo"><span>*</span> - required fields</p>
		<input type="submit" value="Registration">
		<div class="message">
			You can use only letters or numbers
		</div>
	</form>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="js/validation.js"></script>
	<script src="js/preview.js"></script>
</body>
</html>