<!DOCTYPE html>
<html>
<head lang="pl">
<?php session_start();?>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
	<div class="bg_grey"></div>
		<div class="usable">

				<form action="processing.php" method="post">
					<label>
						<input type="text" class="query" name="query" value="<?php if(isset($_SESSION['return_query'])) echo $_SESSION['return_query'];?>">
						<div class="error"><?php if(isset($_SESSION['error']))  {echo $_SESSION['error'];}; unset($_SESSION['error']);?></div>
					</label>
					<label><input type="submit" value="Wykonaj" class="submit"></label>
				</form>
		</div>

		<div id="odpowiedz">
			<?php if(isset($_SESSION['table']))echo $_SESSION['table'];?>
		</div>
	</div>
</body>
</html>