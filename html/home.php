<?php require_once("includes/connection.php");?>
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
					<p>Detailed  guide on Indian states, tourist spots, hotels, climate and festivals  in India are available.
                    Whether you are planning a laid back family holiday, or adventure trip or are on way to a business trip to any of the
                    Indian states, we give you detailed interactive and best travel options to make your journey a memorable one! </p>
					<img src="images/title3.gif" alt="" width="258" height="21" /><br />
					<div id="items">
						<div class="item">
                             <?php
                               $sel_query1="DROP VIEW IF EXISTS temp";
                               $sel_query2="CREATE VIEW temp
                                            AS SELECT city_id, AVG(rating) As rating
                                               FROM tourist_comment
                                               GROUP BY city_id
                                               HAVING COUNT(*) > 1";
                               $sel_query3="SELECT * FROM temp ORDER by rating DESC LIMIT 0,4";

                               $sel_query_set1=mysql_query($sel_query1,$connection);
                               $sel_query_set2=mysql_query($sel_query2,$connection);
                               $sel_query_set3=mysql_query($sel_query3,$connection);
                               
                               if (!$sel_query_set1 || !$sel_query_set2 || !$sel_query_set3) {
		                               die("Database query failed: " . mysql_error());
                               }

                               while ($sel_item3=mysql_fetch_array($sel_query_set3))
                               {
                                 $sel_query4="SELECT city_id,name,image FROM city WHERE city_id = '{$sel_item3['city_id']}'";
                                 $sel_query_set4=mysql_query($sel_query4,$connection);
                                 $sel_item4=mysql_fetch_array($sel_query_set4);

                                 echo "<a href=\"city.php?city_id='{$sel_item4['city_id']}'\"><img src=\"".$sel_item4['image']." \"width=\"200\" height=\"150\"/></a>";
                                 echo "<span><a href=\"city.php?city_id='{$sel_item4['city_id']}'\">".$sel_item4['name']."</a></span>";
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
