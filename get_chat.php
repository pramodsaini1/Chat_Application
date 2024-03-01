 <?php
  $email=$_POST["email"];
  $session=$_POST["session"];
  if(isset($email) && isset($session)){
 $from_userid=$_POST["senderid"];
 $receiver_userid=$_POST["receiverid"];
 $conn=mysqli_connect("localhost","root","","chat");
 ?>
 <div class="row">
      <div class="col-sm-6">
      </div>
        <div class="col-sm-6">
                <?php
           
                        $ry=mysqli_query($conn,"select * from message where (sender_userid = '$from_userid' AND receiver_userid='$receiver_userid')OR(sender_userid = '$receiver_userid' AND receiver_userid='$from_userid')");
                        while($qr=mysqli_fetch_array($ry)){
                            
                            $fuid = $qr["sender_userid"];
                            $dt=$qr["time"];
                            list($date, $time) = explode(" ", $dt);//split the string used of the explode 
                             
                            
                              if($fuid==$from_userid){ 
                                ?> 
                                  <!-- <div class="alert alert-success"> <span style="float:right"></span> -->
                                  <!-- <div class="icon">
                                      <i class="fa fa-edit"></i>
                                      <i class="fa fa-trash"></i>
                                  </div>
                                </div><span>Sender</span> -->
                                <div class="chat outgoing">
                                    <div class="details">
                                      <p><?php echo $qr["message"]?></p>
                                    </div>
                                </div>
                                   
                                    
                            <?php
                              }
                            else{

                                ?>
                                  
                                  <!-- <div class="alert alert-info"> <span style="float:right"> </span></div><span>receiver</span> -->
                                  <div class="chat incoming">
                                    <div class="details">
                                      <p><?php echo $qr["message"]?></p>
                                    </div>
                                </div>
                            
                            <?php
                            }
                          
                            
                            
                        }
                    
                ?>
                </div>
              
            </div> 
<?php
  }
?>