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
                             if (isset($_GET['city_id']))
                             {
                                $city_id=$_GET['city_id'];
                                $query="SELECT * FROM restaurant WHERE city_id={$city_id}";
                                $query_result=mysql_query($query,$connection);

                                $query_cityName="SELECT name FROM city WHERE city_id={$city_id}";
                                $result_cityName=mysql_query($query_cityName,$connection);
                                $cityName=mysql_fetch_array($result_cityName);
                                echo "<font size=3><u>Restaurants in {$cityName['name']} </u></font>";

                                echo "<br/>";

                                while($item =  mysql_fetch_array($query_result)){

                                                                     
                                    echo "{$item['name']}";
                                    echo "<br/>";
                                    echo $item['address'];

                                    echo "<br/><br/>";
                                    echo "Speciality: {$item['speciality']} <br/>";
                                    echo "<br/>";
                                    echo "Cuisine: {$item['cuisine']}";
                                    echo "<br/>";
                                    echo $item['phone'];
                                                                       
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
