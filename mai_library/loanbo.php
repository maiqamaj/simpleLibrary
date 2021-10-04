<?php
session_start();
if($_SESSION['userlogin']!=1)
{
echo"ACCESS DENIED";
exit();
}
?>
<?php
    $con = mysqli_connect ('localhost','root','');//---1
if (!$con)
	die("Not Connected".mysqli_connect_error());
$DB = mysqli_select_db ($con,'library');
if (!$DB)
	die("No DB");
    
    $id=intval($_GET['id']);

echo $id."<br>";  #id for book 

$query="SELECT * FROM book WHERE id='$id' ";
          $result = mysqli_query($con, $query) or die( mysqli_error($con));
          $num=mysqli_fetch_array($result);
echo $num['title']."<br>";   #title of book

$query="SELECT * FROM borrower WHERE email='".$_SESSION['email']."' ";
          $result = mysqli_query($con, $query) or die( mysqli_error($con));
          $num=mysqli_fetch_array($result);
echo $num['num'];  #num for user 
            


?>