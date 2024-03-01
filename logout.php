<?php
setcookie("login","",time()-1);
session_destroy();//unset($_SESSION["session"]); there are two ways of destroy the session
header("location:login.php")
?>