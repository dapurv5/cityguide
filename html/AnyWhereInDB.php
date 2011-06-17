<?php
include("includes/constants.php");
print<<<_HTML_
<a href="home.php">Go To Home</a>
_HTML_;

/***********************************************************************
* @name  AnyWhereInDB
* @author Nafis Ahmad
* @abstract This project is to find out a part of string from anywhere in database
* @version 0.22
* @package anywhereindb
*
*
*
*
*************************************************************************/




session_start();
// @abstract  We will keep the  authentication information in Session.
// @todo  1. delete the line and
// @todo  2.  chage the values of the variable
// @uses  it will not show the login screen.


 $_SESSION['server']=DB_SERVER;
 $_SESSION['dbuser']=DB_USER;
 $_SESSION['pass']=DB_PASS;
 $_SESSION['dbname']=DB_NAME;




if(!(isset($_SESSION['server'])&&
   isset($_SESSION['dbuser'])&&
   isset($_SESSION['pass'])&&
   isset($_SESSION['dbname'])
   ))
// @abstract this is to check the  session is not avilaable
{
	if(isset($_POST['server']) && isset($_POST['dbuser']) && isset($_POST['pass']) && isset($_POST['dbname']))
	// @abstract this is to check the  session information else it will show the login prompt
	{
		$_SESSION['server'] = $_POST['server'];
		$_SESSION['dbuser']= $_POST['dbuser'];
		$_SESSION['pass']	= $_POST['pass'];
		$_SESSION['dbname']= $_POST['dbname'];
		header("Refresh:0;url=http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
	}
	else
	// @abstract  it will show the login prompt
	{
			//  @link  html_head will printed here!!
			html_header();

			if(isset($_REQUEST['error_message']))
			// @uses Error in DB connection
			{
				echo '<span style="color:red;">'.$_REQUEST['error_message'].'</span>';
			}
			?>

			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
				<table>
					<tbody>
						<tr>
							<td><label for="server">Server Name </label></td>
							<td><input type="text" name="server" value="localhost"/></td>
						</tr>
						<tr>
							<td><label for="dbuser">User Name </label></td>
							<td><input type="text" name="dbuser" /></td>
						</tr>
						<tr>
							<td><label for="pass">Password </label></td>
							<td><input type="password" name="pass" /></td>
						</tr>
						<tr>
							<td><label for="dbname">Database Name </label></td>
							<td><input type="text" name="dbname" /></td>
						</tr>
						<tr>
							<td><input type="submit" value="Login to your Database" /></td>
						</tr>
					</tbody>
				</table>
			</form>

<?php
	}// @endof Else  isset($_POST )

} // @endof Else  !isset($_SESSION )
else
// @abstract  the session has the login information
{

	if(isset($_REQUEST['logout']))
	// @name  Logout module
	// @abstract    distroy session and page reload.
	{
		session_destroy();
		header("Refresh:0;url=http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
	}

	$server = $_SESSION['server'];
	$dbuser = $_SESSION['dbuser'];
	$dbpass = $_SESSION['pass'];
	$dbname = $_SESSION['dbname'];

	// @name Databse Connection
	// @abstract  connected with database. and without showing any error ...
	$link = @mysql_connect($server, $dbuser, $dbpass);
	if (!$link) {  session_destroy(); header("Refresh:0;url=http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?error_message=Username OR password Missmatch');}
	if(!@mysql_select_db($dbname, $link)){ session_destroy(); header("Refresh:0;url=http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?error_message=Database Not found');};
	///@endof Databse Connection

	html_header();	 //  @link  html_head will printed here!!

	// @abstract  Show the html search Form !!
	?>

	<div style="position:absolute; right:100px; width:100px;"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?logout=out">Disconnect/Change Database</a></div>
	<div>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
			<label for="search_text"> Search on Database '<?php echo $dbname ?>'</label><br />
			<input type="text" name="search_text" <?php if(isset($_POST['search_text'])) echo 'value="'.$_POST['search_text'].'"';  ?> />
			<input type="submit" value="Search" />
		</form>
	</div>
	<?php
	//endof html search form


	if(isset($_POST['search_text']))
	 // @abstract for each Search Text we seach in the database
	{

		$search_text = $_POST['search_text'];
		$result_in_tables = 0;

		echo '<a href="javascript:hide_all()">Collapse All Result</a>
			 <a href="javascript:show_all()">Expand All Result</a>';
		echo "<h4>Results for: <i>". $search_text.'</i></h4>';

		// @abstract  table count in the database
		$sql= 'show tables';
		$res = mysql_query($sql);
		//@abstract  get all table information in row tables
		$tables = fetch_array($res);
		//endof table count



	   for($i=0;$i<sizeof($tables);$i++)
	   // @abstract  for each table of the db seaching text
	   {
			//@abstract querry bliding of each table
			$sql = 'select * from '.$tables[$i]['Tables_in_'.$dbname];
			$res = mysql_query($sql);

			if(mysql_affected_rows()>0)
			//@abstract Buliding search Querry, search
			{
				//@abstract taking the table data type information
				$sql = 'desc '.$tables[$i]['Tables_in_'.$dbname];
				$res = mysql_query($sql);
				$collum = fetch_array($res);

				$search_sql = 'select * from '.$tables[$i]['Tables_in_'.$dbname].' where ';
				$no_varchar_field = 0;

				for($j=0;$j<sizeof($collum);$j++)
				// @abstract only finding each row information
				{

						if(substr($collum[$j]['Type'],0,7)=='varchar'|| substr($collum[$j]['Type'],0,7)=='text')
						// @abstractonly type selection part of query buliding
						// @todo seach all field in the data base put a 1 in if(1)
						// @example if(1)
						{
							//echo $collum[$j]->Field .'<br />';
							if($no_varchar_field!=0){$search_sql .= ' or ' ;}
							$search_sql .= '`'.$collum[$j]['Field'] .'` like "%'.$search_text.'%" ';
							$no_varchar_field++;
						} // endof type selection part of query bulidingtype selection part

				}//@endof for |buliding search query


				if($no_varchar_field>0)
				// @abstract only main searching part showing the data
				{
					$res = mysql_query($search_sql);
					$search_result = fetch_array($res);
					if(sizeof($search_result))
					// @abstract found search data showing it!
					{
						$result_in_tables++;

						echo '<div class="table_name">&nbsp;&nbsp; Table : '
							 . $tables[$i]['Tables_in_'.$dbname]
							 .' &nbsp;&nbsp;</div>
							  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
							'<span class="number_result"> Total Results for <i>"'.$search_text .'"</i>: '.mysql_affected_rows().'</span>
							<br/>
							<div class="link_wrapper"><a href="javascript:toggle(\''.$tables[$i]['Tables_in_'.$dbname].'_sql'.'\')">SQL</a></div>
							<div id="'.$tables[$i]['Tables_in_'.$dbname].'_sql" class="sql keys"><i>'.$search_sql.'</i	></div>
							<div class="link_wrapper"><a href="javascript:toggle(\''.$tables[$i]['Tables_in_'.$dbname].'_wrapper'.'\')">Result</a></div>
							<script language="JavaScript">
								table_id.push("'.$tables[$i]['Tables_in_'.$dbname].'_wrapper");
							</script>
							<div class="wrapper" id="'.$tables[$i]['Tables_in_'.$dbname].'_wrapper">';

						table_arrange($search_result);
						echo '</div><br/><br/>';
					}// @endof showing found search

				}//@endof  main searching
			}//@endof  querry building and searching


	   }

	   if(!$result_in_tables)
	   // @abstract if result is not found
	   {
			echo '<p style="color:red;">Sorry, <i>'.
					$search_text.
					'</i> is not found in this Database ('.$dbname.') !</p>';
	   }

	mysql_close($link);
	}
}// @endof Else

// @abstract common  footter
?>
<br/>
<br/>
<span  class="me">AnyWhereInDB is a Open Source Project, developed by <a href="http://twitter.com/happy56">Nafis Ahmad</a>.
<br />
<a href="http://code.google.com/p/anywhereindb">http://code.google.com/p/anywhereindb </a>
</span>
</body>
</html>
<?php
//@endof common fotter

//*********************
//* PHP functions
//*********************
function fetch_array($res)
// @method    fetch_array
// @abstract taking the mySQL $resource id and fetch and return the result array
// @param   string| MySQL resouser
// @return  array
{
	   $data = array();
	while ($row = mysql_fetch_assoc($res))
	{
		$data[] = $row;
	}
	return $data;
} //@endof  function fetch_array


function table_arrange($array)
// @method  table_arrange
// @abstract taking the mySQL the result array and return html Table in a string. showing the search content in a diffrent css class.
// @param  array
// @post_data  search_text
// @return  string | html table
{

	$table_data = ''; // @abstract  returning table

	$max =0; // @abstract  max lenth of a row

	$max_i =0; // @abstract  number of the row which is maximum max lenth of a row

	$search_text = $_POST["search_text"];

	for($i=0;$i<sizeof($array);$i++)
	{
		//@abstract table row
		$table_data .= '<tr class='.(($i&1)?'"odd_row"':'"even_row"') .' >';
		//
		$j=0;

		foreach($array[$i] as $key => $data)
		{

			//@abstract a class around the search text
			$data = preg_replace("|($search_text)|Ui" , "<pre class=\"search_text\"><b>$1</b></pre>" , htmlspecialchars($data));

			$table_data .= '<td>'. $data .' &nbsp;</td>';

			$j++;
		}

		if($max<$j)
		{
			$max = $j;
			$max_i = $i;
		}
		$table_data .= '</tr>'."\n";
	}
	$table_data .= '</table></div>';
	unset($data);
	// @endof html table

	//@abstract populating the table head

	// @varname $data_a
	//@abstract  taking the highest sized array and printing the key name.
	$data_a = $array[$max_i];


	$table_head =  '<tr>';
		foreach($data_a as $key => $value)
		{
			$table_head .= '<td class="keys">'. $key.'</td>';
		}

	$table_head .= '</tr>'."\n";
	//@endof populating the table head

	// @abstract printing the table data
	echo '<div class="table_bor">
					<table cellspacing="0" cellpadding="3" border="0" class="data_table">'.$table_head.$table_data;
}//@endof  function table_arrange




function html_header()
// @method  html_header
// @abstract showing the html header of the instance.
// @result prints the html header
{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<!--
//----------------------------------------------------------------------------------------------------------------------//
* @name  AnyWhereInDB
* @author Nafis Ahmad happy56[at]gmail.com // http://twitter.com/happy56
* @abstract This project is to find out a part of string from anywhere in database
* @version 0.22
* @package anywhereindb
//----------------------------------------------------------------------------------------------------------------------//
-->
<title>Any where In DB || AnyWhereInDB.php</title>
<script language="JavaScript">
	//@var array| initilazed
	var table_id =new Array();

	function hide_all()
	// @method  hide_all
	// @abstract hideing all the result tables

	{
		for(i=0;i<table_id.length;i++){
			document.getElementById(table_id[i]).style.display = 'none';
		}
	} //@endof function hide_all

	function show_all()
	// @method  show_all
	// @abstract showing all the result tables

	{
		for(i=0;i<table_id.length;i++){
			document.getElementById(table_id[i]).style.display = 'block';
		}
	}//@endof function show_all

	function toggle(id)
	// @method  toggle
	// @abstract hide/showing a html contianer

	{

		if(get_style(id,'display') =='block')
		{
			document.getElementById(id).style.display = 'none';
		}else {

			document.getElementById(id).style.display = 'block';

		}

	}//@endof function show_all

	function get_style(el,styleProp)
	// @method  get_style
	// @abstract making life easier to Get CSS properties from that table.
	{
		var x = document.getElementById(el);
		if (x.currentStyle)
			var y = x.currentStyle[styleProp];
		else if (window.getComputedStyle)
			var y = document.defaultView.getComputedStyle(x,null).getPropertyValue(styleProp);
		return y;
	}// @endof function get_style

</script>

<style>
/*
* @style by farnar.net
* @author Nurul Amin Russel
*
*/
h1{color:  #233E99;}
td{ font-size:11px; font-family:arial;vertical-align:top;border:1px solid #fff;}
a{font-size:11px; font-family:arial;}
.table_name{background: #233E99 none repeat scroll 0% 0%;display:inline;font-size: 18px;color: rgb(255, 255, 255);border-bottom: 4px solid rgb(35, 62, 153);margin-top: 20px;}
.wrapper{width:90%; overflow:scroll;overflow-y:hidden; margin-bottom:50px; padding:10px}
.number_result{font-size:13px;color: #233E99;}
.search_text{background: #FFFF00;}
.table_bor{margin: 0pt auto;}
.data_table{text-align: center;width:680px;cellspacing:0;cellpadding:10px;border:0;}
.keys{background-color:#cccccc;font-size:11px; font-family:arial;}
.odd_row{background-color:#E5E5E5 ;}
.even_row{background-color:#f5f5f5;}
.sql{display:none;width:680px;padding:10px;border:0;}
.link_wrapper{margin-top:10px;}
.me{font-size:11px; font-family:arial;color:#333;}
</style>
</head>
<body>
<h1>AnyWhereInDB.php</h1>
<?php

}//@endof  function html_head
//---------------------------------------------------------------------------------------------------------------------------------//
//@endof file anywhereindb.php
//@note if you have querry, need, idea, help; fell free to contact happy56[at]gmail.com