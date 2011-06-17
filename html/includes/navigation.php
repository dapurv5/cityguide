        <div class="logo_block">
				<a href="#"><img src="images/logo.jpg" alt="setalpm" width="198" height="156" /></a><br />																																																																									<div class="inner_copy"><a href="http://www.bestfreetemplates.org/">free templates</a><a href="http://www.bannermoz.com/">banner templates</a></div>
				<span class="slogan">Best offers for You</span>
				<p class="text1">Welcome to city guide.</p>
		</div>
		
		<img src="images/title1.gif" alt="" width="126" height="21" /><br />

        <ul id="navigation">
			<?php
                    $i=0;
                    $sel_query="SELECT * FROM category";
                    $sel_query_set=mysql_query($sel_query,$connection);

                    while ($sel_items=mysql_fetch_array($sel_query_set))
                    {
                     $i++;
                     if($i % 2 == 1)
                         echo "<li class=\"color\"><a href=\"category.php?cat_id=".urlencode($sel_items['category_id'])."\">".$sel_items["name"]."</a></li>";
                     else
                         echo "<li><a href=\"category.php?cat_id=".urlencode($sel_items["category_id"])."\">".$sel_items["name"]."</a></li>";
                    }
            ?>

		</ul>

