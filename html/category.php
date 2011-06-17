<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
	<div id="wrapper">
		<div id="sidebar">
          <?php include("includes/navigation.php"); ?>
        </div>

		<div id="content">
			<?php include("includes/search.php"); ?>
			<div class="bg">
				<div class="column1">
           			<div id="items">
						<div class="item">
                             <?php
                             if (isset($_GET['cat_id']))
                             {
                                $sel_cat=$_GET['cat_id'];
                                printSpotsOfCategoryID($sel_cat);
                                printEventsOfCategoryID($sel_cat);
                             }
                             if(isset($_GET['ts_id'])){
                                 printSpotsOfID($_GET['ts_id']);
                             }


                               function printEventsOfCategoryID($sel_cat){
                                 global $connection;
                                  $sel_query1="SELECT * FROM events_of_interest WHERE category_id='{$sel_cat}'";
                                $sel_query_set1=mysql_query($sel_query1,$connection);

                                while($sel_item1=mysql_fetch_array($sel_query_set1)){

                                    #$sel_item1=mysql_fetch_array($sel_query_set1);
                                    #$ts_id=$sel_item1['ts_id'];
                                    $city_id=$sel_item1['city_id'];

                                    $query="SELECT name FROM city WHERE city_id='{$city_id}'";
                                    $query_result=mysql_query($query,$connection);
                                    $item=mysql_fetch_array($query_result);


                                    echo "<font size=6>{$sel_item1['name']}</font> <br/>";
                                    echo "<font size=4> in   {$item['name']}</font>";
                                    echo "<br/>";
                                    echo $sel_item1['description'];
                                    echo "<br/>";
                                    
                                    echo "<img src=\"{$sel_item1['image']}\" \"width=\"300\" height=\"200\">";
                                    echo "<br/>";

                                    echo "<br/>";
                                    echo "<br/>";

                                    echo "<br/>";
                                    echo "<br/>";
                                    echo "More About:<a href=\"city.php?city_id='{$city_id}'\"><font size=2 color=RED> {$item['name']} </font></a>";
                                     echo "<br/><br/><br/><br/>";
                                    echo "<br/>";echo "<br/>";

                                }
                               }
                            

                             function printSpotsOfCategoryID($sel_cat){
                                 global $connection;
                                  $sel_query1="SELECT * FROM tourist_spot WHERE category_id='{$sel_cat}'";
                                $sel_query_set1=mysql_query($sel_query1,$connection);

                                while($sel_item1=mysql_fetch_array($sel_query_set1)){

                                    #$sel_item1=mysql_fetch_array($sel_query_set1);
                                    $ts_id=$sel_item1['ts_id'];
                                    $city_id=$sel_item1['city_id'];

                                    $query="SELECT name FROM city WHERE city_id='{$city_id}'";
                                    $query_result=mysql_query($query,$connection);
                                    $item=mysql_fetch_array($query_result);


                                    echo "<font size=6>{$sel_item1['name']}</font> <br/>";
                                    echo "<font size=4> in   {$item['name']}</font>";
                                    echo "<br/>";
                                    echo $sel_item1['description'];
                                    echo "<img src={$sel_item1['image']} \"width=\"300\" height=\"200\">";
                                    echo "<br/>";

                                    echo "<br/>";
                                    echo "<br/>";

                                    echo "<br/>";
                                    echo "<br/>";
                                    echo "More About:<a href=\"city.php?city_id='{$city_id}'\"><font size=2 color=RED> {$item['name']} </font></a>";
                                     echo "<br/><br/><br/><br/>";
                                    echo "<br/>";echo "<br/>";

                                }
                             }


                              function printSpotsOfID($sel_ts){
                                 global $connection;
                                  $sel_query1="SELECT * FROM tourist_spot WHERE ts_id='{$sel_ts}'";
                                $sel_query_set1=mysql_query($sel_query1,$connection);

                                while($sel_item1=mysql_fetch_array($sel_query_set1)){

                                    #$sel_item1=mysql_fetch_array($sel_query_set1);
                                    $ts_id=$sel_item1['ts_id'];
                                    $city_id=$sel_item1['city_id'];

                                    $query="SELECT name FROM city WHERE city_id='{$city_id}'";
                                    $query_result=mysql_query($query,$connection);
                                    $item=mysql_fetch_array($query_result);


                                    echo "<font size=6>{$sel_item1['name']}</font> <br/>";
                                    echo "<font size=4> in   {$item['name']}</font>";
                                    echo "<br/>";
                                    echo $sel_item1['description'];
                                    echo "<img src={$sel_item1['image']} \"width=\"300\" height=\"200\">";
                                    echo "<br/>";

                                    echo "<br/>";
                                    echo "<br/>";

                                    echo "<br/>";
                                    echo "<br/>";
                                    echo "More About:<a href=\"city.php?city_id='{$city_id}'\"><font size=2 color=RED> {$item['name']} </font></a>";
                                     echo "<br/><br/><br/><br/>";
                                    echo "<br/>";echo "<br/>";

                                }
                             }
                            ?>
                       	</div>
      				</div>
				</div>
             <?php include("includes/right_navigation.php"); ?>
			</div>
		</div>
	</div>

 <?php include("includes/footer.php"); ?>
