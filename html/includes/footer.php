<div id="footer">
    	<ul>
         <?php include("includes/links.php"); ?>
		</ul>
		<p>Copyright &copy;. All rights reserved.</div>
	</div>
</body>
</html>
<?php
    if (isset($connectio))
	   mysql_close($connection);
?>
