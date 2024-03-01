<?php
session_start();
if(isset($_COOKIE["login"]) && isset($_SESSION["session"])){
     $conn=mysqli_connect("localhost","root","","chat");
     $sender_email=strtolower(mysqli_real_escape_string($conn,$_COOKIE["login"]));
     if(isset($_REQUEST["msg"]) && isset($_REQUEST["userid"])){
        $msg=validation($_REQUEST["msg"]);
        $receiver_userid=mysqli_real_escape_string($conn,$_REQUEST["userid"]);
        $sn=0;
        $rs=mysqli_query($conn,"select MAX(sn) from message");
        if($r=mysqli_fetch_array($rs)){
            $sn=$r[0];
        }
        $sn++;

        $code="";
        $a=array();
        for($i='A';$i<='Z';$i++){
            array_push($a,$i);
            if($i=='Z'){
                break;
            }
        }
        for($i='a';$i<='z';$i++){
            array_push($a,$i);
            if($i=='z'){
                break;
            }
        }
        for($i=0;$i<=9;$i++){
            array_push($a,$i);
        }
        $b=array_rand($a,6);
        for($i=0;$i<sizeof($b);$i++){
            $code=$code.$a[$b[$i]];
        }
        $code=$code."_".$sn;
        $new_user_id=$code;
        $receiver_email="";

        $rn=mysqli_query($conn,"select * from user where userId='$receiver_userid'");
        if($rp=mysqli_fetch_array($rn)){
            $receiver_email=$rp["email"];
        }
        $sender_userid="";
        $rp=mysqli_query($conn,"select * from user where email='$sender_email'");
        if($rb=mysqli_fetch_array($rp)){
          $sender_userid=$rb["userId"];
        }
        $dt=date("l jS \of F Y h:i:s A");

        if(mysqli_query($conn,"insert into message(sn,userId,sender_email,sender_userid,receiver_email,receiver_userid,message,chat_time) values($sn,'$new_user_id','$sender_email','$sender_userid','$receiver_email','$receiver_userid','$msg','$dt')")>0){
              echo"success";
        }
         
     }
      
}
else{
    header("location:login.php");
}
function validation($data){
  $data=trim($data);
  $data=htmlspecialchars($data);
  return $data;
}
?>
 