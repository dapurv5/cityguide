<?php
/* To be used for information.php
 CREATE VIEW, AVG, GROUP BY, NATURAL JOIN, DROP : To obtain the cities as per the users average rating.*/
$sel_query1="CREATE VIEW example
AS SELECT city_id, AVG(rating)
   FROM tourist_comment
   GROUP BY city_id
   HAVING COUNT(*) > 1
   LIMIT 0,4;"
$sel_query_set1=mysql_query($sel_query1,$connection);
$sel_query2="SELECT * FROM example NATURAL JOIN city NATURAL JOIN how_to_reach";
$sel_query_set2=mysql_query($sel_query,$connection);
$sel_item=mysql_fetch_array($sel_query_set);

$sel_query3="DROP VIEW example";
$sel_query_set3=mysql_query($sel_query,$connection);
?>
<?php
/* AVG, GROUP BY : To obtain the cities as per the users average rating.*/
$sel_query="$result=mysql_query("SELECT * FROM city WHERE name LIKE \"%".$_POST["search"]."%\" ",$connection);";
?>


<?php
$sel_query_set=mysql_query($sel_query,$connection);
$sel_items=mysql_fetch_array($sel_query_set);
?>
