<?php
session_start();
if(isset($_COOKIE["login"]) && isset($_SESSION["session"])){
     $conn=mysqli_connect("localhost","root","","chat");
     $email=mysqli_real_escape_string($conn,$_COOKIE["login"]);
     if(isset($_REQUEST["ch"])){
        $ch=mysqli_real_escape_string($conn,$_REQUEST["ch"]);
        $rs=mysqli_query($conn,"select * from user where first_name LIKE '%$ch%' OR last_name LIKE '%$ch%' AND email!='$email'");
        $flag=0;
         echo"<table class='table table-borderless'>";
        while($r=mysqli_fetch_array($rs)){
            $flag++;
            ?>
              
                   <tr>
                        <td><img src="images/<?php echo $r["userId"]?>.jpg" class="rounded-circle" style="width:60px;height:60px;">
                          <sapn><?php echo $r["first_name"]." ".$r["last_name"];?></span>
                          <span><p>message...</p></span>
                          </td>

                    </tr>
            

          <?php
        }
        echo"</table>";
        if($flag==0){
            ?>
               <div class="col-sm-12">
                 <div class="alert alert-warning">Record Not Found</div>
               </div>
            <?php
        }
     }

}
else{
  header("location:login.php");
}


?>