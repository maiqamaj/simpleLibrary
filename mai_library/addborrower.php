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
$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$Bdate=date('Y-m-d', strtotime($_POST['Bdate']));
$vir=true;
$result =mysqli_query($con,"SELECT email FROM borrower WHERE email='$email'");
$count=mysqli_num_rows($result);
if($count>0)
{   
 $vir=false;
 echo "موجود مسبقا";
}
if($vir){
    
    $r='/^[a-z\d\.\+_\'%-]+@([a-z\d-]+\.)+[a-z]{2,6}$/i';
	if (!preg_match($r,$email)) {
        echo "الرجاء التأكد من كتابة اﻷيميل بالشكل الصحيح";
		$vir=false; }
}
if($vir){
      
    $rrr='/[a-z0-9]{6}/i';
	if (!preg_match($rrr,$pass)) {
        echo "الرجاء التأكد من كتابة كلمه السر بالشكل الصحيح";
		$vir=false; }
}
if($vir){
	  $v11='/^([a-zA-Z]){2,8}\s([a-zA-Z]){2,8}$/';
	if(!preg_match($v11,$name)){
		echo " الرجاء التأكد من كتابة الأسم بالشكل الصحيح";
		$vir=false;}
}   

if($vir){
	$reg1 = '/07[789]\d{7}/';
	if(!preg_match($reg1,$phone)){
		echo " الرجاء التأكد من كتابة رقم الهاتف بالشكل الصحيح";
		$vir=false;}
}
if($vir){   
    $ret=mysqli_query($con,"insert into borrower(name,email,pass,phone,Bdate) values('$name','$email','$pass','$phone','$Bdate')");
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
             
              mysqli_query($con,"delete from borrower where num = '".$denum."'");
                  echo "تم الحذف";
      }

?>

<!DOCTYPE html>  
<html>  
<head>  

 <link href="c1.css"rel="stylesheet"/ >
</head>



<body >  
    <br>
                       

    <br>
    <br>
<form  method="post">  
  <div class="cont">  
      
  <center>  <h1>Add Borrower</h1> </center>  

   <br>
 <label><b>First & Last Name</b></label>   
<input type="text" name="name" placeholder= "Enter Your Name" size="15" required id='name'/>   

      
 <label for="email"><b>E-mail</b></label>  
 <input type="text" placeholder="Enter Your E-mail" id="email" name="email" required>


 <label for="pass"><b>Password</b></label>  
 <input id="pass" type="password" placeholder="Enter Your Password"  name="pass" required data-eye/>

     <br>
 <label for="phone"><b>Phone</b></label>  
 <input type="text" placeholder="Enter Your Phone Number" id="phone" name="phone" required/>  
<div> 


    <label required><b>Your Birthday</b></label>

<input type="date" id="Bdate" name="Bdate" required/>
      <br>
      <br>
 <button type="submit" class="registerbtn" name="submit">Add</button>   
      </div>  </div>
</form> <br>
    <hr style="width:900px; ">
    
    <center>
      <b><h2>ALL Borrower</h2></b>
    </center>
    <form method="POST"  style="padding-left:200px;">  
 <label><b>Delete Borrower 
 <input  placeholder="Enter Num of borrower " id="denum" name="denum" required>  
 <button type="submit" name="delete">delete </button>
 </b></label> 
</form> 
        <br/>
  <?php
     
$query="SELECT * FROM borrower";
$results=mysqli_query($con,$query) or die(mysqli_error($con));
if (mysqli_num_rows($results) > 0) {

echo "<center>
<table  style='width:50%' ";
echo "<tr>
<th  style='text-align:center'> Number </th>
<th style='text-align:center'> Name </th>
<th  style='text-align:center'> E-mail </th>
<th  style='text-align:center'> Password </th>
<th  style='text-align:center'> Phone </th>
<th  style='text-align:center'> Birthday </th>

</tr>";

while ($row=mysqli_fetch_assoc($results)) {
echo "<tr>

<td  style='text-align:center'>".$row["num"]."</td>
<td  style='text-align:center'>".$row["name"]."</td>
<td  style='text-align:center'>".$row["email"]."</td>
<td  style='text-align:center'>".$row["pass"]."</td>
<td  style='text-align:center'>".$row["phone"]."</td>
<td  style='text-align:center'>".$row["Bdate"]."</td>


</tr>";
}
echo "</table></center>";}
else { 
echo"<center><b><br/><h4>No borrower</h4><br/></b></center>";
}

        ?>


</body> 
    
</html>  

