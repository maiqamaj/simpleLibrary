<?php
session_start();
if($_SESSION['adminlogin']!=1)
{
echo"ACCESS DENIED";
exit();
}
?>

<!DOCTYPE html>  
<html>  
<head>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link href="c1.css"rel="stylesheet"/ >

   
<body >  
    <br>        
<br><br><br>
    <br>



<?php
$con = mysqli_connect ('localhost','root','');//---1
if (!$con)
	die("Not Connected".mysqli_connect_error());
$DB = mysqli_select_db ($con,'library');
if (!$DB)
	die("No DB");

 $query="SELECT * FROM loan";
 $results=mysqli_query($con,$query) or die(mysqli_error($con));
 if (mysqli_num_rows($results) > 0) {
 
 echo "<center>
 <table  style='width:50%' ";
 echo "<tr>
 <th  style='text-align:center'> ID </th>
 <th style='text-align:center'> Num </th>
 <th  style='text-align:center'> Out_date </th>
 <th  style='text-align:center'> Due_date </th>
 <th  style='text-align:center'> Title </th>
 </tr>";
 while ($row=mysqli_fetch_assoc($results)) {
    $res = mysqli_query ($con,"SELECT title FROM book WHERE id =$row[ID]");
    $r = mysqli_fetch_assoc($res);
 echo "<tr>
 <td  style='text-align:center'>".$row["ID"]."</td>
 <td  style='text-align:center'>".$row["Num"]."</td>
 <td  style='text-align:center'>".$row["Out_date"]."</td>
 <td  style='text-align:center'>".$row["Due_date"]."</td>
 <td  style='text-align:center'>".$r["title"]."</td>
 </tr>";
 }
 echo "</table></center>";}
 else { 
 echo"<center><b><br/><h4>No borrower</h4><br/></b></center>";
 }

 ?>