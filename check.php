<?php
session_start();

if(empty($_POST["email"])||empty($_POST["pass"])){
    header("location:login.php?empty=1");
}
else{
    $conn=mysqli_connect("localhost","root","","chat");
     $email= mysqli_real_escape_string($conn,$_POST["email"]);
     $pass= md5(mysqli_real_escape_string($conn,$_POST["pass"]));
     $rs=mysqli_query($conn,"select * from user where email='$email'");
     if($r=mysqli_fetch_array($rs)){
        if($r["password"]==$pass){
            setcookie("login",$email,time()+3600);
            $_SESSION["session"]=$email;
            header("location:Dashboard.php");
        }
        else{
            header("location:login.php?invalid_password=1");
        }
     }
     else{
        header("location:login.php?invalid_record=1");
     }
} 
?>