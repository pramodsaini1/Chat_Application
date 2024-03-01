<?php
if(isset($_REQUEST["email"])){
   $conn=mysqli_connect("localhost","root","","chat");
   $email=mysqli_real_escape_string($conn,$_REQUEST["email"]);
    $rs=mysqli_query($conn,"select * from user where email !='$email'");
   echo"<table class='table table-borderless'>";
  while($r=mysqli_fetch_array($rs)){
        ?> 
           <tr>
               <td><a href="chat.php?userid=<?php echo $r["userId"]?>" style="text-decoration:none;color:black;"><img src="images/<?php echo $r["userId"]?>.jpg" class="rounded-circle" style="width:60px;height:60px;">
                 <span><?php echo $r["first_name"]." ".$r["last_name"];?></span>
                 <span><p>message....</p></span>
              </a></td>
           </tr>
          
        <?php
  }
  echo"</table>";
}
?>