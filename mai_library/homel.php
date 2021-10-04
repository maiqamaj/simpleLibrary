<?php
session_start();
if($_SESSION['userlogin']!=1)
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
    
    
    $query="SELECT * FROM borrower WHERE email='$email' and pass='$pass'";
    $result = mysqli_query($con, $query) or die( mysqli_error($con));
    $num=mysqli_fetch_array($result);
    if($num<=0)
    {echo"LOGIN FAILED(INVALID Email OR PASSWORD)</br>";
        echo"<a href='signin.php'>Back</a><br/>";
        exit();}
    
}
?>
<html>
     <link href="css.css" rel="stylesheet" />
    <body style="margin-left:10%;
    margin-right:10%;" >
       <br>
        <center>  <h2><b>Welcome   <?php  
            $query="SELECT * FROM borrower WHERE email='".$_SESSION['email']."' ";
          $result = mysqli_query($con, $query) or die( mysqli_error($con));
          $num=mysqli_fetch_array($result);
            
          echo "<b style='color:red; font-size:27px' >".$num['name']."</b>";     ?> to Web Library</b></h2></center>
     

       
        <center>
             <br>
       
        <center>
       
     <div style=" background-color: #fafafa;  width:800px; " >  
           <div id="outer">
   <?php
         
         
         $sql=mysqli_query($con,"SELECT * FROM `book` ");

while($row=mysqli_fetch_array($sql) )
{
  ?>
         
      
                 <div class="inner" style="width:170px; height: 200px;">

    <button class="button"  style="width:140px; height: 200px; border: 0; " >  <img src="do.jpg" style="width:130px; height: 100px;" >
        <h4> <?php echo $row['title'];?> </h4>
  
        <h4> price : <?php echo $row['price'];?> </h4>
       
     <button> <a href= "SELLbo.php?id=<?php echo $row['id']?>">Sell</a></button>
  &nbsp; 
        
        <button>  <a href= "loanbo.php?id=<?php echo $row['id']?>">Loan</a></button>
        
                     
                     </button>
                     
     
    </div>
               <div class="inner"> &nbsp;  </div>



		<?php  }
			
		?>    
     
               </div>
    </div>
    <br>
   
                 </center> 
       <div class="inner">  <a href="logoutuser.php"><button  class="button"  style="  background-color: #C097C7;width: 90px;height: 70px;"><h2>Log out </h2></button></a></div>
                 </center> 
              
    </body>
    

</html>