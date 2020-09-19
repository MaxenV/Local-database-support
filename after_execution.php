<!DOCTYPE html>
<html>
<head lang="pl">
    <?php
        session_start();
        if(!isset($_SESSION['db_table'])){header("Location: index.php");}
    ?>
	<meta charset="utf-8">
</head>
<body>
    <div>Twoje zapytanie zostało wykonane</div>
</body>
</html>