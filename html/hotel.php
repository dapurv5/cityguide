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
                                printHotelInCity($sel_city);
                             }
                             elseif (isset($_GET['hotel_id'])){
                                 printBriefHotelInfo($_GET['hotel_id']);
                             }
                               else
                               {
                                   listAllHotels();
                               }

                               function printHotelInCity($sel_city){
                                   global $connection;
                                   $sel_query2="SELECT * FROM hotel
                                                WHERE city_id= {$sel_city}";
                                   
                                   $sel_query_set2=mysql_query($sel_query2,$connection);

                                   if (!$sel_query_set2 ){
		                               die("Database query failed: " . mysql_error());
                                    }

                                    while($item_hotel=mysql_fetch_array($sel_query_set2)){
                                        echo "<br/><br/>";
                                        printBriefHotelInfo($item_hotel['hotel_id']);
                                        echo "<br/>";
                                    }
                                    

                                    echo "<br/><br/>";

                               }

                               function printBriefHotelInfo($sel_hotel){
                                   global $connection;
                                   $sel_query2="SELECT * FROM hotel
                                                WHERE hotel_id='{$sel_hotel}'";
                                   
                                   $sel_query_set2=mysql_query($sel_query2,$connection);
                                   
                                   if (!$sel_query_set2 ){
		                               die("Database query failed: " . mysql_error());
                                    }
                                  
                                    $item_hotel=mysql_fetch_array($sel_query_set2);
                                    
                                    echo "<br/><br/>";
                                    echo "<font size=4>{$item_hotel['name']}</font>";
                                    echo "<br/>";
                                    echo "<br/>";
                                        echo "<img src=\" ".$item_hotel['image']."\" \"width=\"200\" height=\"150\" >";
                                        echo "<br/><br/>";
                                      $i=0;
                                    while($i<$item_hotel['star']){
                                        echo "<font size=5>*</font>";
                                        $i++;
                                    }
                                    echo "<br/>";
                                    echo "{$item_hotel['address']}";
                                    echo "<br/>";
                                    echo "Rate Per Day:{$item_hotel['rate']}";
                                    echo "<br/>";
                                    echo "Phone: {$item_hotel['phone']}";
                                   echo "<br/>";
                                    echo"Resort:";
                                    if($item_hotel['resort'] ==1)
                                        echo "yes <br/>";
                                    else
                                        echo "no <br/>";
                                    echo "<br/><br/><br/><br/>";


                               }
                               /*
                                * Selects the cities in alphabetical order and displays them by calling printCityInfo()
                                * on each city
                                */
                               function listAllHotels(){
                                   global $connection;
                                   $query1 = "SELECT * FROM hotel ORDER BY name ASC";
                                   $query1_result=mysql_query($query1,$connection);

                                   while($item=mysql_fetch_array($query1_result) ){

                                       printBriefHotelInfo($item['hotel_id']);

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

