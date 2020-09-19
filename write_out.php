<?php
	session_start();
	$db_table = $_SESSION["db_table"];

	$_SESSION["table"]="<table>";
	$i=true;
	while($i==true)
	{
		while( list($key, $value) = each($db_table[1]) )
		{
			$_SESSION["table"]= $_SESSION["table"]."<th>".$key."</th>";
		}
		$i=false;
	}

	foreach($db_table as $record)
	{
		$_SESSION["table"] = $_SESSION["table"]."<tr>";
		foreach($record as $attribute)
		{
			$_SESSION["table"] = $_SESSION["table"]."<td>".$attribute."</td>";
		}
		$_SESSION["table"] = $_SESSION["table"]."</tr>";
	}
	$_SESSION["table"] = $_SESSION["table"]."</table>";

	header("Location: index.php");
?>