<?php
// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 3600);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(3600);
session_start();

error_reporting(E_ALL^E_NOTICE);
error_reporting(E_STRICT);
?>
<?php
if(isset($_SESSION['username']) and isset($_SESSION['password'])){
	
	
include("dbconnect.php");
if($_GET['did']){mysql_query("delete from submit_alumni where id='$_GET[did]'"); }
?>

<?php
if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] != admin) and ($_SESSION['user_type'] != superadmin)) {
    header('Location: profile.php');
    exit;
}
?>

<html>
<head>
<title>PHP Project</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script language="javascript">
function deluser(did)
{
	var msg=confirm("Are you sure you want to delete this?");
	if(msg)
	{window.location="edit_alumni.php?did="+did;}
	
	
	}
</script>
</head>
<body>

<div id="main_section">
<div id="header">
    	<div class="logo"><img src="images/logo.jpg" alt="" width="242" height="109" title="" border="0" /> <img src="images/banner.jpg" alt="" width="755" height="109" title="" border="0" /></div>      
    </div>
        <div class="menu">
        	<ul>                                                                         
        		<li class="selected"><a href="home.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="account_info.php">Account Info</a></li>
                <li><a href="change_password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
        	</ul>
        </div>
    
    <div id="container">
  <div id="main">
  
    <div id="leftcol_container">
    	<br><div class="leftcol">
        	<h2>Admin Panel</h2>
            <br>
            
            <?php
		include('dbconnect.php');
		
		$user_type = $_SESSION['user_type'];
		$sql=mysql_query("select * from bac.menu where user_type='$user_type' ");		
		
		while($m=mysql_fetch_array($sql))
		{
			echo "<a class=\"menus\" style=\"font-family:Arial; font-size:16px;\" href=\"".$m['link'].".php\">".$m['link_name']."</a>";
			echo "<br>";
		}
		?>   
        <br>   
    	</div>
    </div>
<h2 id=title>Search Result</h2>     
    <div id="maincol_container4">
      <div class="maincol_middle">
        <div class="maincol1">         
<form action="edit_alumni.php" method="post" onSubmit="return validate(this)">

  <div align="center">
    <table width="639">
    <tr>          <td width="90"></td>
                  <td>Enter Year: </td>
                  <td><select name="year">
                    <option value="0" selected="selected">Chose One</option>
                    <option value="1995">1995</option>
                    <option value="1996">1996</option>
                    <option value="1997">1997</option>
                    <option value="1998">1998</option>
                    <option value="1999">1999</option>
					<option value="2000">2000</option>
                    <option value="2001">2001</option>
					<option value="2002">2002</option>
					<option value="2003">2003</option>
					<option value="2004">2004</option>
					<option value="2005">2005</option>
					<option value="2006">2006</option>
					<option value="2007">2007</option>
					<option value="2008">2008</option>
					<option value="2009">2009</option>
					<option value="2010">2010</option>
                    <option value="2011">2011</option>
					<option value="2012">2012</option>
					<option value="2013">2013</option>
					<option value="2014">2014</option>
					<option value="2015">2015</option>
					<option value="2016">2016</option>
					<option value="2017">2017</option>
					<option value="2018">2018</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
                    <option value="2021">2021</option>
					<option value="2022">2022</option>
					<option value="2023">2023</option>
					<option value="2024">2024</option>
					<option value="2025">2025</option>
					<option value="2026">2026</option>
					<option value="2027">2027</option>
					<option value="2028">2028</option>
					<option value="2029">2029</option>					
					<option value="2030">2030</option>
                    <option value="2031">2031</option>
					<option value="2032">2032</option>
					<option value="2033">2033</option>
					<option value="2034">2034</option>
					<option value="2035">2035</option>
					<option value="2036">2036</option>
					<option value="2037">2037</option>
					<option value="2038">2038</option>
					<option value="2039">2039</option>
					<option value="2040">2040</option>
                    <option value="2041">2041</option>
					<option value="2042">2042</option>
					<option value="2043">2043</option>
					<option value="2044">2044</option>
					<option value="2045">2045</option>
					<option value="2046">2046</option>
					<option value="2047">2047</option>
					<option value="2048">2048</option>
					<option value="2049">2049</option>
					<option value="2050">2050</option>
                    </select>
					<td width="45"></td>
					</td>
	   <td>
          <input class="btn" name="action" id="action" type="submit"  value="     Search Result     ">
       </td>
					</tr>
  </div>
</form>
        <?php
		include('dbconnect.php');
	    $sql=mysql_query("select * from bac.submit_alumni where year='$_POST[year]' order by student_id");		
		echo "<table border=\"1\" width=\"100%\" style=\"color: #fff;\">";
		echo "<tr>";
		echo "<th style=\"background-color:#1D5174;\">Student Id</th>";
		echo "<th style=\"background-color:#1D5174;\">Name Of The Candidate</th>";
		echo "<th style=\"background-color:#1D5174;\">CGPA(On scale of 4)</th>";
		echo "<th style=\"background-color:#1D5174;\">Year</th>";
		echo "<th style=\"background-color:#1D5174;\">Edit</th>";
		echo "<th style=\"background-color:#1D5174;\">Delete</th>";
		echo "<tr>";	
		while($user=mysql_fetch_array($sql))
		{
		echo "<tr  style=\"color: #1D5174;\">";
		echo "<td>".$user['student_id']."</td>";
		echo "<td>".$user['name']."</td>";
		echo "<td>".$user['cgpa']."</td>";
		echo "<td>".$user['year']."</td>";
		echo "<td><a href=\"edit_alumni_1.php?eid=".$user['id']."\">Edit</a></td>";
		echo "<td><a class=\"foot_style\" href=\"javascript:deluser(did=$user[id])\">Delete</a></td>";

		echo "<tr>";		
		}
		echo "</table>";
		?>
        
        </div>
        <br>
      </div>
    </div>
        <div class="clear"></div>
  </div>

</div>
  
  
    <div id="footer">                                              
        <div class="left_footer"><a href="index.php">Home</a> &nbsp;|<a href="about.php">About School</a> &nbsp;|<a href="registration.php">Registration</a> &nbsp;|<a href="photos.php">Photo Gallery</a>&nbsp;|<a href="contact.php">Contact Us</a></div> 
        <div class="right_footer"><a href="privacy.php">Privacy Policy</a>&nbsp;| <a> Copyright &copy; 2014 &nbsp;| <a href="aion.php">Designed By RSJ Developers</a></a>
        </div>   
    
    
</div>


</body>
</html>         
<?php
}
else
{trigger_error("You are not Admin");}
?>