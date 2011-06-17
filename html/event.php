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

					<p>
                                        </p>

					<div id="items">
						<div class="item">
                           <?php
                             if (isset($_GET['city_id']))
                             {
                                $sel_city=$_GET['city_id'];
                                printEventInCity($sel_city);
                             }
                             elseif (isset($_GET['eoi_id'])){
                                 printBriefEventInfo($_GET['eoi_id']);
                             }
                               else
                               {
                                   listAllEvents();
                               }

                               function printEventInCity($sel_city){
                                   global $connection;
                                   $sel_query2="SELECT * FROM events_of_interest
                                                WHERE city_id= {$sel_city}";

                                   $sel_query_set2=mysql_query($sel_query2,$connection);

                                   if (!$sel_query_set2 ){
		                               die("Database query failed: " . mysql_error());
                                    }

                                    while($item_event=mysql_fetch_array($sel_query_set2)){
                                        echo "<br/><br/>";
                                        printBriefEventInfo($item_event['eoi_id']);
                                        echo "<br/>";
                                    }


                                    echo "<br/><br/>";

                               }

                               function printBriefEventInfo($sel_event){
                                   global $connection;
                                   $sel_query2="SELECT * FROM events_of_interest
                                                WHERE eoi_id='{$sel_event}'";

                                   $sel_query_set2=mysql_query($sel_query2,$connection);

                                   if (!$sel_query_set2 ){
		                               die("Database query failed: " . mysql_error());
                                    }

                                    $item_event=mysql_fetch_array($sel_query_set2);
                                    echo "<br/><br/>";
                                    echo "<font size=4>{$item_event['name']}</font>";
                                    echo "<br/>";
                                     
                                    echo "<br/>";
                                    echo "{$item_event['description']}";
                                    echo "<br/>";
                                    echo "Start Date:{$item_event['start_date']}";
                                    echo "<br/>";
                                    echo "End Date: {$item_event['end_date']}";
                                    echo "<br/>";
                                    echo "<img src=\"{$item_event['image']}\" width=300 height=200>";
                                    echo "Image";
                                    echo "<br/><br/><br/><br/><br/>";


                               }
                               /*
                                * Selects the cities in alphabetical order and displays them by calling printCityInfo()
                                * on each city
                                */
                               function listAllEvents(){
                                   global $connection;
                                   $query1 = "SELECT * FROM events_of_interest ORDER BY name ASC";
                                   $query1_result=mysql_query($query1,$connection);

                                   while($item=mysql_fetch_array($query1_result) ){

                                       printBriefEventInfo($item['eoi_id']);

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

