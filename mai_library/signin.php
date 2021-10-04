<?php

session_start();
$_SESSION['userlogin']=1;
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
<form method="POST" action="homel.php" onsubmit="return validate(this);">  
  <div class="container">  
  <center>  <h1> Sign In</h1> </center>  
   
   

 <label for="email"><b>E-mail</b></label>  
 <input type="text" placeholder="Enter Your email" id="email" name="email" required>  

 <label for="password"><b>Password</b></label>  
 
 <input id="pass" type="password" placeholder="Enter Your Password"  name="pass" required data-eye>

 <button type="submit" class="registerbtn" name="submit">Sign In </button>
  </div>
</form> 
</body>  
</html>  