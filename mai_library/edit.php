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
if(isset($_POST['submit']))
{
$title=$_POST['title'];
$publisher=$_POST['publisher'];
$edition=$_POST['edition'];
$price=$_POST['price'];
$vir=true; 	
$result =mysqli_query($con,"SELECT title FROM book WHERE title='$title'");


if($vir){
	$reg1 = '/\d{0,8}(\.\d{1,4})?/';
	if(!preg_match($reg1,$price)){
		echo " الرجاء التأكد من كتابة السعر";
		$vir=false;}
}
if($vir){   
    $ret=mysqli_query($con,"update book set title='$title',publisher='$publisher',edition='$edition',price='$price' where id='$id'");

if($ret)
{
echo "تم التعديل بنجاح";
}
else
{
  echo " خطأ : لم يتم التعديل بنجاح ";
}
}}


?>

<html>
    <link href="c1.css"rel="stylesheet"/ >
<body >
    <form  method="post">
<?php
$sql=mysqli_query($con,"select * from book where id='$id'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
   
 	
<form  method="post">  
  <div class="cont">  
      
  <center>  <h1>Edit Book</h1> </center>  

   <br>
 <label><b>Title</b></label>   
<input type="text" name="title" value="<?php echo $row['title'];?>"  required id='title'/>   

      
 <label for="email"><b>Publisher</b></label>  
 <input type="text" id="publisher" name="publisher" value="<?php echo $row['publisher'];?>" required>


 <label for="pass"><b>Edition</b></label>  
 <input id="edition" type="text"   name="edition" value="<?php echo $row['edition'];?>"required data-eye/>

     <br>
 <label for="phone"><b>Price</b></label>  
 <input type="text"  id="price" name="price" value="<?php echo $row['price'];?>" required/>  
<div> 



 <button type="submit" class="registerbtn" name="submit">Edit</button>   
      </div>  </div>
</form> 
  
  <?php }?>
    </form>
    
    </body>
</html>