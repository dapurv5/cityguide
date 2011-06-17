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
					<img src="images/title2.gif" alt="" width="258" height="21" /><br />
					<div id="items">
                                        <div class="item">
                                          <?php
                                          if(isset($_POST['search_text'])){
                                             $qry=$_POST['search_text'];
                                             printCityResults($qry);
                                             printEventResults($qry);
                                             printHotelResults($qry);
                                             printSpotResults($qry);
                                             
                                          }

                                          function printCityResults($qry){
                                            global $connection;
                                            $sql_qry="select * from city where city_id like '%{$qry}%' or name like '%{$qry}%' or state like '%{$qry}%' or zone like '%{$qry}%' or country like '%{$qry}%' or weather like '%{$qry}%' or best_time_to_visit like '%{$qry}%' or description like '%{$qry}%' ";
                                            $result= mysql_query($sql_qry,$connection);
                                            while($item=mysql_fetch_array($result)){
                                                echo "<a href=city.php?city_id='{$item['city_id']}'><font color=red>{$item['name']}</font></a>";
                                                echo "<br/>";
                                                for($k=0;$k<50;$k++)
                                                    echo $item['description'][$k];
                                                echo "....";
                                                echo "<br/><br/><br/><br/>";
                                            }
                                          }

                                          function printEventResults($qry){
                                              global $connection;
                                              $sql_qry="select * from events_of_interest where name like '%{$qry}%' or description like '%{$qry}%' ";
                                              $result=mysql_query($sql_qry,$connection);
                                              while($item=mysql_fetch_array($result)){
                                                echo "<a href=event.php?eoi_id={$item['eoi_id']}><font color=red>{$item['name']}</font></a>";
                                                echo "<br/>";
                                                for($k=0;$k<50;$k++)
                                                    echo $item['description'][$k];
                                                echo "....";
                                                echo "<br/><br/><br/><br/>";
                                            }

                                          }
                                           function printHotelResults($qry){
                                              global $connection;
                                              $sql_qry="select * from hotel where name like '%{$qry}%' or address like '%{$qry}%' ";
                                              $result=mysql_query($sql_qry,$connection);
                                              while($item=mysql_fetch_array($result)){
                                                echo "<a href=hotel.php?hotel_id={$item['hotel_id']}><font color=red>{$item['name']}</font></a>";
                                                echo "<br/>";
                                                //for($k=0;$k<50;$k++){
                                                    echo $item['address'];
                                                //}
                                                echo "....";
                                                echo "<br/><br/><br/><br/>";
                                              }
                                          }
                                           function printSpotResults($qry){
                                             global $connection;
                                              $sql_qry="select * from tourist_spot where name like '%{$qry}%' or image like '%{$qry}%' or description like '%{$qry}%'";
                                              $result=mysql_query($sql_qry,$connection);
                                              while($item=mysql_fetch_array($result)){
                                                echo "<a href=category.php?ts_id={$item['ts_id']}><font color=red>{$item['name']}</font></a>";
                                                echo "<br/>";
                                                for($k=0;$k<50;$k++)
                                                    echo $item['description'][$k];
                                                echo "....";
                                                echo "<br/><br/><br/><br/>";
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

