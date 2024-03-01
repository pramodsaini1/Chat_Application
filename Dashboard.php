<?php
session_start();
if(isset($_COOKIE["login"]) && isset($_SESSION["session"])){
    $email=$_COOKIE["login"];
    $session=$_SESSION["session"];
    $conn=mysqli_connect("localhost","root","","chat");
    $rs=mysqli_query($conn,"select * from user where email ='$email'");
    if($r=mysqli_fetch_array($rs)){
        ?>
         
    <?php include_once "header.php"?>
    <script>
       $(document).ready(function(){
           $("input").keyup(function(){
              var ch="";
               var ch=$(this).val();
                var email="<?php echo $email;?>";
               if(ch==""){
                  $.post(
                      "new_dashboard.php",{email:email},function(data){
                        $("#record").html(data);
                      }
                  )
               }
               else{
                    $.post(
                        "search.php",{ch:ch},function(data){
                            $("#record").html(data);
                        }
                   )
               }
               
           });
       });
    </script>
<style>
body{
    background-color: lightblue;
}
hr{
    border: 5px solid green;
  border-radius: 2px;
}
</style>
<body>
<div class="container-fluid">
    <div class="row" style="margin-top:130px;">
           <div class="col-sm-4"></div>
            <div class="col-sm-4">
              <div class="card">
                   <div class="card-body">
                       <div class="row">
                            <table class="table table-borderless">
                                <tr>
                                    <td><img src="images/<?php echo $r["userId"]?>.jpg" class="rounded-circle" style="width:80px;height:80px;"></td>
                                    <td><?php echo $r["first_name"]." ".$r["last_name"];?>
                                      <?php
                                         $status= $r["status"];
                                         if($status==1){
                                            ?>
                                            <br><strong>Active Now </strong>
                                            <?php
                                         }
                                          
                                     ?>
                                   </td>
                                    <td><button class="btn btn-primary"><a href="logout.php" style="text-decoration:none;color:white">Logout</a></button></td>
                                </tr>
                            </table> 
                       </div>
                       <hr>
                       <div class="row">
                           <span class="text">Select an user to start chat</span>
                           <input type="text" id="Search" placeholder="search here.......">
                       </div>
                       <div class="row" id="record">
                        <?php
                           $rp=mysqli_query($conn,"select * from user where email<>'$email'");
                              echo "<table class='table table-borderless'>";
                           while($rn=mysqli_fetch_array($rp)){
                                 ?>
                                    
                                    <tr>
                                        <td><a href="chat.php?userid=<?php echo $rn["userId"]?>" style="text-decoration:none;color:black;"><img src="images/<?php echo $rn["userId"]?>.jpg" class="rounded-circle" style="width:60px;height:60px;">
                                          <span><?php echo $rn["first_name"]." ".$rn["last_name"];?></span>
                                          <span><p>message...</p></span>
                           </a></td>

                                    </tr>
                                   
                                 <?php
                           }
                           echo "</table>";
                        ?>
                       </div>
                       
                       

                 </div>
             </div>
            </div>
            
    </div>
</div>  
</body>
</html>

      <?php
    }
}
else{
    header("location:login.php");
}
 

?>
 