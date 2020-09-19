<?php
if(!isset($_POST['kwerenda'])){ header("Location: index.php"); }

session_start();
$_SESSION['query'] = $_POST['query'];
$_SESSION['return_query'] = htmlentities($_SESSION['query'] , ENT_QUOTES, "UTF-8") ;
if($_SESSION['query'] == "")
{
    $_SESSION['error'] = "Nic nie wpisałeś";
    header("Location: index.php");
    exit();
}
else
{
    require_once "connect.php";

    try{
        $db = new PDO("mysql:host=".$host.";dbname=".$db_name.";charset=utf8", $user, $pass,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);//Łączenie z bazą

        //Query execution
        $result= $db ->prepare($_SESSION['query']);
        $result -> execute();

        $getTable = $result->fetchAll(PDO::FETCH_ASSOC);

        $_SESSION["db_table"] = $getTable;
        header("Location: write_out.php");
        exit();

    }   catch(PDOException $error ){

       // echo $error->getMessage();

        if ($error->getCode() == "42000")//Wrong SQŁ code (user mistake)
        {
            $_SESSION['error'] = "Pomyliłeś się w składni SQL";
            header("Location: index.php");
            exit();
        }
        else if ($error->getCode() == "42S02")//wrong table / column
        {
            $_SESSION['error'] = "Zła tablica / kolumna";
            header("Location: index.php");
            exit();
        }
        else if ($error->getCode() == "42S22")//Bad field name
        {
            $_SESSION['error'] = "Błąd nazw";
            header("Location: index.php");
            exit();
        }
        else if($error->getCode() == "HY000")//Nothing to show
        {
            header("Location: after_execution.php");
            exit();
        }
        else // Db connection error

        {
            echo "Nie znany błąd o kodzie: ".$error->getCode();
        }

    }
}

?>
