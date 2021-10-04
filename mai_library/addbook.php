<?php
session_start();
if($_SESSION['adminlogin']!=1)
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
if(isset($_POST['submit']))
{
$title=$_POST['title'];
$publisher=$_POST['publisher'];
$edition=$_POST['edition'];
$price=$_POST['price'];
$vir=true; 	
$result =mysqli_query($con,"SELECT title FROM book WHERE title='$title'");
$count=mysqli_num_rows($result);
if($count>0)
{   
 $vir=false;
 echo "موجود مسبقا";
}

if($vir){
	$reg1 = '/\d{0,8}(\.\d{1,4})?/';
	if(!preg_match($reg1,$price)){
		echo " الرجاء التأكد من كتابة السعر";
		$vir=false;}
}
if($vir){   
    $ret=mysqli_query($con,"insert into book(title,publisher,edition,price) values('$title','$publisher','$edition','$price')");
if($ret)
{
echo "تم أضافة بنجاح";
}
else
{
  echo " خطأ : لم يتم أضافة بنجاح ";
}
}}

if(isset($_POST['delete']))
      {     $denum=$_POST['denum'];
             
              mysqli_query($con,"delete from book where id = '".$denum."'");
                  echo "تم الحذف";
      }
if(isset($_POST['search']))
      {     $title=$_POST['title'];
             
           $ret= mysqli_query($con,"select * from book where title = '".$title."'");
            $row=mysqli_fetch_assoc($ret);
            
          header("Location: addbookS.php?id=" . $row['id']);
     
         
       
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
<form  method="post">  
  <div class="cont">  
      
  <center>  <h1>Add Book</h1> </center>  

   <br>
 <label><b>Title</b></label>   
<input type="text" name="title" placeholder= "Enter the title for the book"  required id='title'/>   

      
 <label for="email"><b>Publisher</b></label>  
 <input type="text" placeholder="Enter the publisher for the book" id="publisher" name="publisher" required>


 <label for="pass"><b>Edition</b></label>  
 <input id="edition" type="text" placeholder="Enter edition the book"  name="edition" required data-eye/>

     <br>
 <label for="phone"><b>Price</b></label>  
 <input type="text" placeholder="Enter psrice for the book like(4.7JD)" id="price" name="price" required/>  
<div> 



 <button type="submit" class="registerbtn" name="submit">Add</button>   
      </div>  </div>
</form> <br>
    <hr style="width:900px; ">
    
    <center>
      <b><h2>ALL Book</h2></b>
    </center>
   
      <form method="POST"style="padding-left:200px;">  
 <label><b>Search Book 
 <input  placeholder="Enter title of the book " id="title" name="title" required>  
 <button type="submit" name="search" >Search </button>
 
 </b></label> 
</form>
   
    <br>
    <form method="POST"  style="padding-left:200px;">  
 <label><b>Delete Book 
 <input  placeholder="Enter num of the book " id="denum" name="denum" required>  
 <button type="submit" name="delete">delete </button>
 </b></label> 
</form> 
    
  
        <br/>
  <?php
     
$query="SELECT * FROM book";
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

