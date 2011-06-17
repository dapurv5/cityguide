<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">


<html>
<head>
<script type="text/javascript">
function writeText(txt)
{
document.getElementById("desc").innerHTML=txt;
}
</script>
</head>

<body>
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
					<p>Click on a region of the map to know more about that region. </p>
					<img src="images/title3.gif" alt="" width="258" height="21" /><br />
					<div id="items">
					<div class="item">

                                          <img src="images/map.jpg" width="500" height="500"
                                        alt="Planets" usemap="#planetmap" />

                                        <map name="planetmap">
                                        <area shape ="rect" coords ="0,0,500,205"
                                        onMouseOver="writeText('<font size=6>Delhi</font>')"
                                        href ="city.php?city_id='c1'"  alt="Sun" />

                                        <area shape ="circle" coords ="90,58,3"
                                        onMouseOver="writeText('CITY')"
                                        href ="city.php" target ="_blank" alt="Mercury" />
                                        


                                        <area shape ="circle" coords ="124,58,8"
                                        onMouseOver="writeText('CITY')"
                                        href ="city.php" target ="_blank" alt="Venus" />
                                        </map>

                                        <p id="desc"></p>

                         
                       	</div>
      				</div>
				</div>
             <?php include("includes/right_navigation.php"); ?>
			</div>
		</div>
	</div>
 <?php include("includes/footer.php"); ?>


    </body>
</html>