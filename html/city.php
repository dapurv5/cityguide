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
					
					<p> 
                                        </p>
					
					<div id="items">
						<div class="item">
                           <?php
                             if (isset($_GET['city_id']))
                             {
                                $sel_city=$_GET['city_id'];
                                printCityInfo($sel_city);
                               }

                               else
                               {
                                  listAllCities();
                               }

                               function printCityInfo($sel_city){
                                   global $connection;
                                   $sel_query1="DROP VIEW IF EXISTS temp";
                                   $sel_query2="CREATE VIEW temp
                                             AS SELECT * FROM city
                                                WHERE city_id= {$sel_city}";
                                   $sel_query3="SELECT * FROM temp NATURAL JOIN how_to_reach";
                                   
                                   $sel_query_set1=mysql_query($sel_query1,$connection);
                                   $sel_query_set2=mysql_query($sel_query2,$connection);
                                   $sel_query_set3=mysql_query($sel_query3,$connection);
                                   
                                   if (!$sel_query_set1 || !$sel_query_set2 || !$sel_query_set3){
		                               die("Database query failed: " . mysql_error());
                                    }
                                    
                                $sel_item3=mysql_fetch_array($sel_query_set3);
                                   echo "<font size=5>".$sel_item3['name']."</font>";
                                   echo "<br/>";
                                   echo "<br/>";
                                   echo "<b>  Location: </b>".$sel_item3['name'];
                                        echo "<br/>";
                                        echo $sel_item3['description'];
                                        echo "<br/>";
                                        echo "<img src=\" ".$sel_item3['image']."\" \"width=\"200\" height=\"150\" >";
                                        echo "<br/><br/>";
                                        echo "<b> HOW TO REACH </b>";
                                        echo "<br/><br/>";
           				echo " Railway Station: ".$sel_item3['railway_station'];
                                        echo "<br/><br/>";
           				echo " Roadways: ".$sel_item3['roadways'];
                                        echo "<br/><br/>";
           				echo " Airport: ".$sel_item3['airport'];
                                        echo "<br/><br/>";
                                        echo "BEST TIME TO VISIT:".$sel_item3['best_time_to_visit']; echo "<br/>";
                                        echo "WEATHER".$sel_item3['weather'];
                                        echo "<br/><br/>";
                                        echo "<a href=comments.php?city_id={$sel_city}><font color=blue>View Comments</font></a>";
                                        echo "<br/>";
                                        echo "<a href=hotel.php?city_id={$sel_city}><font color=blue>View Hotels</font></a>";
                                        echo "<br/>";
                                        echo "<a href=restaurant.php?city_id={$sel_city}><font color=blue>View Restaurants</font></a>";
                                        echo "<br/>";
                                        echo "<a href=event.php?city_id={$sel_city}><font color=blue>View Events</font></a>";
                                        echo "<br/>";
                                        echo "<a href=guide.php?city_id={$sel_city}><font color=blue>View Guides</font></a>";
                                        
                               }

                               function printBriefCityInfo($sel_city){
                                   global $connection;
                                   $sel_query1="DROP VIEW IF EXISTS temp";
                                   $sel_query2="CREATE VIEW temp
                                             AS SELECT * FROM city
                                                WHERE city_id= '{$sel_city}'";
                                   $sel_query3="SELECT * FROM temp NATURAL JOIN how_to_reach";

                                   $sel_query_set1=mysql_query($sel_query1,$connection);
                                   $sel_query_set2=mysql_query($sel_query2,$connection);
                                   $sel_query_set3=mysql_query($sel_query3,$connection);

                                   if (!$sel_query_set1 || !$sel_query_set2 || !$sel_query_set3){
		                               die("Database query failed: " . mysql_error());
                                    }

                                $sel_item3=mysql_fetch_array($sel_query_set3);
                                   echo "<font size=5>".$sel_item3['name']."</font>";
                                   echo "<br/>";
                                   echo "<br/>";
                                   echo "<b>  Location: </b>".$sel_item3['name'];
                                        echo "<br/>";
                                        #echo $sel_item3['description'];
                                        echo "<br/>";
                                        echo "<a href=city.php?city_id='{$sel_item3['city_id']}'><img src=\" ".$sel_item3['image']."\" \"width=\"200\" height=\"150\" ></a>";
                                        echo "<br/><br/>";
                                        

                               }
                               /*
                                * Selects the cities in alphabetical order and displays them by calling printCityInfo()
                                * on each city
                                */
                               function listAllCities(){
                                   global $connection;
                                   $query1 = "SELECT * FROM city ORDER BY name ASC";
                                   $query1_result=mysql_query($query1,$connection);

                                   $k=0;
                                   while($item=mysql_fetch_array($query1_result) ){
                                       
                                       printBriefCityInfo($item['city_id']);
                                       
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
