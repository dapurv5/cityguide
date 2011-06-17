<?php require_once("includes/connection.php"); ?>

<?php
	if(isset($_SESSION['login_id']) && isset($_POST['comments']) && isset($_POST['suggestions']) )
        {
            $city = $_POST['city'];
            $time_of_visit = $_POST['time_of_visit'];
            $expected_expenditure = $_POST['expected_expenditure'];
            $rating = $_POST['rating'];
            $comments = $_POST['comments'];
            $suggestions = $_POST['suggestions'];

            $sel_query1="SELECT COUNT(*)+ 1 As count FROM tourist_comment";
            $sel_query_set1=mysql_query($sel_query1,$connection);
            $sel_item1=mysql_fetch_array($sel_query_set1);

            $tc_id = "tc"."{$sel_item1['count']}"."{$session_id}";
            echo "<br> {$tc_id} <br>";


            

            $sel_query2="SELECT city_id FROM city WHERE name = '{$city}'";
            $sel_query_set2=mysql_query($sel_query2,$connection);
            $sel_item2=mysql_fetch_array($sel_query_set2);

            $sel_query3="INSERT INTO tourist_comment
            VALUES('{$tc_id}', '{$sel_item2['city_id']}',
            '{$_SESSION['login_id']}','{$time_of_visit}',{$expected_expenditure},
             {$rating}, '{$comments}', '{$suggestions}')";

             $sel_query_set3=mysql_query($sel_query3,$connection);

             if (!$sel_query_set1 || !$sel_query_set2 || !$sel_query_set3)
             {
                  die("Database query failed: " . mysql_error());
              }
        ;
    	
        header("Location: home.php");
        exit;
        }

?>

<?php mysql_close($connection); ?>
