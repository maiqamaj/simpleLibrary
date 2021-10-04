<?php
session_start();
if($_SESSION['adminlogin']!=1)
{
echo"ACCESS DENIED";
exit();
}
?>
<?php


$id=intval($_GET['id']);
$con = mysqli_connect ('localhost','root','');//---1
if (!$con)
	die("Not Connected".mysqli_connect_error());
$DB = mysqli_select_db ($con,'library');
if (!$DB)
	die("No DB");

?>

<?php


if(isset($_POST['delete']))
      {     $denum=$_POST['denum'];
             
              mysqli_query($con,"delete from book where id = '".$denum."'");
                  echo "تم الحذف";
      }


?>

<!DOCTYPE html>  
<html>  
<head>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> 


</head>
    <link href="c1.css"rel="stylesheet"/ >


<body >  
    <br>
                       

    <br>
    <br> 		

    <hr style="width:900px; ">
    
    <center>
      <b><h2> Book</h2></b>
    </center>
   

    <br>
    <form method="POST"  style="padding-left:200px;">  
 <label><b>Delete Book 
 <input  placeholder="Enter num of the book " id="denum" name="denum" required>  
 <button type="submit" name="delete">delete </button>
 </b></label> 
</form> 
    
  
        <br/>
  <?php
     
$query="SELECT * FROM book where id=$id";
$results=mysqli_query($con,$query) or die(mysqli_error($con));
if (mysqli_num_rows($results) > 0) {

echo "<center>       	
<table  style='width:50%' id='table' name='table'";
echo "<tr>
<th  style='text-align:center'> Number </th>
<th style='text-align:center'> Title </th>
<th  style='text-align:center'> Publisher </th>
<th  style='text-align:center'> Edition </th>
<th  style='text-align:center'> Price </th>
<th  style='text-align:center'> Action </th>
</tr>";

while ($row=mysqli_fetch_assoc($results)) {
echo "<tr>

<td  style='text-align:center'>".$row["id"]."</td>
<td  style='text-align:center'>".$row["title"]."</td>
<td  style='text-align:center'>".$row["publisher"]."</td>
<td  style='text-align:center'>".$row["edition"]."</td>
<td  style='text-align:center'>".$row["price"]."</td>
<td  style='text-align:center'><a href='edit.php?id=".$row["id"]."'><button>Edit</button></a></td>


</tr>";
}
echo "</table></center>";}
else { 
echo"<center><b><br/><h4>No Book</h4><br/></b></center>";
}

        ?>


</body> 
    
</html>  

