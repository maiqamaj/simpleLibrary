<?php
session_start();
if($_SESSION['userlogin']!=1)
{
echo"ACCESS DENIED";
exit();
}
?>
<?php

 $id=intval($_GET['id']);

echo $id;

?> 