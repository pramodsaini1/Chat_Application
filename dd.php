$(document).ready(function(){
                   $(".fa.fa-telegram").click(function(){
                      var msg=$("#message").val();
                      var userid="<?php echo $userId ;?>";
                      if(msg.length!=0){
                            $.post(
                                "message.php",{msg:msg,userid:userid},function(data){
                                        $("#chat-box").html(data);
                                }
                            );
                        }
                      
                   });
                   

                });






                ?>
             <div class="row">
                                                         <div class="col-sm-6">
                                                                  

                                                         </div>
                                                         <div class="col-sm-6">
                                                                 <?php
                                                           

                                                                        $ry=mysqli_query($conn,"select * from message where (sender_userid = '$sender_userid' AND receiver_userid='$receiver_userid')OR(sender_userid = '$receiver_userid' AND receiver_userid='$sender_userid')");
                                                                        while($qr=mysqli_fetch_array($ry)){
                                                                            
                                                                            $fuid = $qr["sender_userid"];
                                                                             
                                                                              if($fuid==$sender_userid){ 
                                                                                ?> 
                                                                                  <div class="alert alert-success"><?php echo $qr["message"]?></div><span>Sender</span>
                                                                                    
                                                                            <?php
                                                                              }
                                                                            else{

                                                                                ?>
                                                                                  
                                                                                  <div class="alert alert-info"><?php echo $qr["message"]?></div><span>receiver</span>
                                                                            
                                                                             <?php
                                                                            }
                                                                           
                                                                            
                                                                            
                                                                        }
                                                                    
                                                                ?>
                                                                </div>
                                                       
                                                    </div>
             <?php


