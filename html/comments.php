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
                             if (isset($_GET['city_id']))
                             {
                                $city_id=$_GET['city_id'];
                                $query="SELECT * FROM tourist_comment WHERE city_id={$city_id}";
                                $query_result=mysql_query($query,$connection);

                                $query_cityName="SELECT name FROM city WHERE city_id={$city_id}";
                                $result_cityName=mysql_query($query_cityName,$connection);
                                $cityName=mysql_fetch_array($result_cityName);
                                echo "<font size=3><u>Comments on {$cityName['name']} </u></font>";

                                echo "<br/>";
                                
                                while($item =  mysql_fetch_array($query_result)){
                                    
                                    #Printing tourist information
                                    $tourist_id=$item['tourist_id'];
                                    $query2="SELECT name,email FROM tourist WHERE tourist_id='{$tourist_id}'";
                                    
                                    $query2result=mysql_query($query2, $connection);
                                    $item2=mysql_fetch_array($query2result);
                                    
                                    echo "{$item2['name']}";
                                    echo "<br/>";
                                    echo $item2['email'];
                                    
                                    echo "<br/><br/>";
                                    echo "Time of visit: {$item['time_of_visit']} <br/>";
                                    echo "<br/>";
                                    echo $item['comments'];
                                    echo "<br/>";
                                    echo $item['suggestions'];
                                    echo "<br/>";echo "<br/>";echo "<br/>";
                                    echo "Expected Expenditure:  {$item['expected_expenditure']} <br/>";
                                    $i=0;
                                    while($i<$item['rating']){
                                        echo "<font size=5>*</font>";
                                        $i++;
                                    }
                                    echo "<br/><br/> <br/><br/> <br/><br/>";
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
