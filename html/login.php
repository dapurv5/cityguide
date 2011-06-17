<?php require_once("includes/connection.php"); ?>

<?php

if(isset($_POST['logout']))
{
    session_destroy();
}

else
{
	$tourist_name = $_POST['login'];

	$tourist_set = mysql_query("SELECT * FROM tourist ", $connection);
	if (!$tourist_set) {
	    die("Database query failed: " . mysql_error());
    }
    $true_user=0;
    while ($tourist = mysql_fetch_array($tourist_set)) {
        if (($tourist_name==$tourist['name'])){
            $true_user=1;
            break;
        }
    }
       ;
    	if ($true_user==1)
         {
    	    	$_SESSION['login_id'] = $tourist['tourist_id'];
    	    	$_SESSION['login'] = $tourist['name'];
         }
}

header("Location: home.php");
exit;

?>

<?php mysql_close($connection); ?>
