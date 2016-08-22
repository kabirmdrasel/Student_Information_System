<?php
error_reporting(E_ALL^E_NOTICE);
error_reporting(E_STRICT);
// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 3600);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(3600);
session_start();
if(isset($_SESSION['username']) and isset($_SESSION['password'])){
	
	
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
<script src="js/edit_validation.js"></script>
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
<h2 id=title>Edit Lab Result</h2>     
    <div id="maincol_container4">
      <div class="maincol_middle">
        <div class="maincol1">
        <?php
        include("dbconnect.php");
		$eid=$_GET['eid'];
		
		$sql=mysql_query("select * from bac.submit_lab_result where id='$eid'");
	 $user=mysql_fetch_array($sql); 
	
		?>
             <form action="action.php" method="post" >
        	   <div align="center">
    <table width="639" border="1">
       <tr>
	    <td align="center" style="background-color: #1D5174;"><font color="white"><strong>Student Id</strong></td>
        <td align="center" style="background-color: #1D5174;"><font color="white"><strong>Online</strong></td>
        <td align="center" style="background-color: #1D5174;"><font color="white"><strong>Attendence</strong></td>
	    <td align="center" style="background-color: #1D5174;"><font color="white"><strong>Mid Term</strong></td> 
	    <td align="center" style="background-color: #1D5174;"><font color="white"><strong>Final Exam</strong></font></td> 
		<td align="center" style="background-color: #1D5174;"><font color="white"><strong>Assaingment<br>/Project</strong></font></td> 		
       </tr>

        <tr>
        <td>
        <input type="text" name="student_id" id="student_id" size="13" value="<?php echo $user['student_id'];?>">
        <?php 
			session_start();
			if($_SESSION['msg']!="")
			{echo $_SESSION['msg'];$_SESSION['msg']="";}
			
	    ?>
        </td>
        <td><input type="text" name="online" id="online" size="10" value="<?php echo $user['online'];?>"></td>
        <td><input type="text" name="attendence" id="attendence"  size="15" value="<?php echo $user['attendence'];?>"></td>
		<td><input type="text" name="mid_term" id="mid_term"  size="10" value="<?php echo $user['mid_term'];?>"></td>
        <td><input type="text" name="final_exam" id="final_exam"  size="13" value="<?php echo $user['final_exam'];?>"></td>
		<td><input type="text" name="assignment_project" id="assignment_project"  size="14" value="<?php echo $user['assingment_project'];?>"></td>
        </tr>        	       
        	 
			 <tr>
        	         <td></td>
        	         <td><input name="eid" type="hidden" value="<?php echo $user['id'];?>"/></td>
       	           </tr>
				   </table>
				   <table>
        	       <tr>
		<td width="330" align="center"  style="color:#69F;border-radius:10px" bgcolor="#AFD3EB" >
           <?php
            session_start();
	    if($_SESSION['msg']){echo $_SESSION['msg'];$_SESSION['msg']="";}
	    ?> 
	    </td> 
       <td>
        	         <td><input class="btn" name="action" id="action" type="submit"  value="    Change Lab Result   "/></td>
       	           </tr>
       	         </table>
      	     </div>
          </form>                
        
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
{header("Location:index.php");}
?>