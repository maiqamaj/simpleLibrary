<?php
session_start();
if($_SESSION['adminlogin']!=1)
{
echo"ACCESS DENIED";
exit();
}

$con = mysqli_connect ('localhost','root','');//---1
if (!$con)
	die("Not Connected".mysqli_connect_error());
$DB = mysqli_select_db ($con,'library');
if (!$DB)
	die("No DB");
if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $pass= $_POST['pass'];
    $_SESSION['email']=$email;
    $_SESSION['pass']=$pass;
    
    
    $query="SELECT * FROM admin WHERE email='$email' and password='$pass'";
    $result = mysqli_query($con, $query) or die( mysqli_error($con));
    $num=mysqli_fetch_array($result);
    if($num<=0)
    {echo"LOGIN FAILED(INVALID Email OR PASSWORD)</br>";
        echo"<a href='signinadmin.php'>Back</a><br/>";
        exit();}
    
}
?>
<html>
     <link href="css.css" rel="stylesheet" />
    <body>
       <br>
        <center>  <h2><b>Admin Page :  <?php echo $_SESSION['email']; ?></b></h2></center>
     
       <br>
       
        <center>
       
     <div style=" background-color: #fafafa;  width:600px; " >  
   
           <br>
           <br>    

           <br>
             <div id="outer">
                 <div class="inner"> <a href="addbook.php"><button  class="box111" style="left:0px;background-color:#C097C7; width: 250px; height: 90px; "><h2>Book</h2></button></a></div>
                  &nbsp; 
                   <div class="inner">  <a href="addborrower.php"><button  class="box111"  style=" left:0px; background-color:#979EC7 ;width: 250px;height: 90px;"><h2>borrower</h2></button></a></div>
                  &nbsp; 
                  
                   
                </div> 
  
     <div id="outer">
                   <div class="inner"> <a href="sellbook.php"><button  class="box111" style="left:0px;background-color:#979EC7;  width: 250px; height: 90px; "><h2>Sell Books</h2></button></a></div>
                  &nbsp; 
                   <div class="inner">  <a href="Loanbook.php"><button  class="box111"  style=" left:0px; background-color: #C097C7;width: 250px;height: 90px;"><h2>Loan books </h2></button></a></div>
                  &nbsp; 
                   
                </div> 
        <br>
   
     
       
   <div class="inner">  <a href="logout.php"><button  class="button"  style=" left:0px; background-color: #C097C7;width: 150px;height: 90px;"><h2>Log out </h2></button></a></div>
                 </center> 
        </div>
              
    </body>
    

</html>