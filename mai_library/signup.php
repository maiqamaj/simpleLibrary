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
?>

<!DOCTYPE html>  
<html>  
<head>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> 
 <link href="css.css" rel="stylesheet" />

</head>  
<body >  
    <br>
                       

    <br>
    <br>
<form  method="post">  
  <div class="container">  
      
  <center>  <h1> Sign Up</h1> </center>  

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
 <button type="submit" class="registerbtn" name="submit">Sign Up</button>   
      </div>  </div>
</form> 
</body>  
</html>  