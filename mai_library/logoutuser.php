<?php
session_start();
$_SESSION['userlogin']=="";
session_unset();
//session_destroy();

?>
<script language="javascript">
document.location="home.php";
</script>
