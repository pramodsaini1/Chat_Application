<?php
if($_SERVER["REQUESTED_MATHOD"]=="POST"){
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
          $senderid=$_POST["sender_userid"];
          $target="chatImages/";
          $targetFile=mkdir($target/.$senderid).basename($_FILES["image"]["name"]);
          if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
              echo"uploaded";
          }
          else{
              echo"again";
          }
    }
}      
?>