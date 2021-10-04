<?php
session_start();
$_SESSION['adminlogin']=="";
session_unset();
//session_destroy();

?>
<script language="javascript">
document.location="home.php";
</script>
