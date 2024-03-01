<?php
session_start();
if(isset($_COOKIE["login"]) && isset($_SESSION["session"])){
     $conn=mysqli_connect("localhost","root","","chat");
     $email=mysqli_real_escape_string($conn,$_COOKIE["login"]);
     $session=$_SESSION["session"];
     $rs2=mysqli_query($conn,"select * from user where email='$email'");
        $r2=mysqli_fetch_assoc($rs2);
        $from_userid = $r2['userId'];
     if(isset($_GET["userid"])){
        $userId=mysqli_real_escape_string($conn,$_GET["userid"]);
        $rs=mysqli_query($conn,"select * from user where userId='$userId'");
        if($r=mysqli_fetch_array($rs)){
            ?>
            <?php include_once "header.php"?>
            <style>
            body{
                background-color:lightblue;
            }
            hr{
                border: 5px solid green;
                border-radius: 2px;
            }
            #chat-box{
                position: relative;
                min-height: 300px;
                max-height: 300px;
                overflow-y: auto;
                padding: 10px 30px 20px 30px;
                background: #f7f7f7;
                box-shadow: inset 0 32px 32px -32px rgba(0 0 0 / 5%),
                    inset 0 -32px 32px -32px rgba(0 0 0 / 5%);   
            }
            #chat-box .chat{
                margin: 15px 0;
            }

            #chat-box .chat p{
                word-wrap: break-word;
                padding: 8px 16px;
                box-shadow: 0 0 32px rgb(0 0 0 / 8%),
                            0 16px 16px -16px rgb(0 0 0 / 10%);
            }

            #chat-box .outgoing{
                display: flex;
            }

            .outgoing .details{
                margin-left: auto;
                max-width: calc(100%-130px);
            }

            .outgoing .details p{
                background: #333;
                color: #fff;
                border-radius: 18px 18px 0 18px;
            }

            #chat-box .incoming{
                display: flex;
                align-items: flex-end;
            }

            #chat-box .incoming img{
                height: 35px;
                width: 35px;
            }

            .incoming .details{
                margin-left: 10px;
                margin-right: auto;
                max-width: calc(100%-130px);
            }

            .incoming .details p{
                background: #fff;
                color: #333;
                border-radius: 18px 18px 18px 0;
            }

            .fa.fa-paperclip{
                font-size:25px;
                color:blue;
                cursor:pointer;
            }
            .rounded-file-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px; /* Adjust width as needed */
            height: 60px; /* Adjust height as needed */
            background-color: #007bff; /* Adjust background color as needed */
            border-radius: 50%; /* Make it rounded */
            color: #fff; /* Icon color */
            font-size: 24px; /* Adjust icon size as needed */
            cursor:pointer;
            }
            .rounded-camera-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px; /* Adjust width as needed */
            height: 60px; /* Adjust height as needed */
            background-color: #FFA500; /* Adjust background color as needed */
            border-radius: 50%; /* Make it rounded */
            color: #fff; /* Icon color */
            font-size: 24px; /* Adjust icon size as needed */
            cursor:pointer;
            }
            .rounded-image-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px; /* Adjust width as needed */
            height: 60px; /* Adjust height as needed */
            background-color:  #A52A2A; /* Adjust background color as needed */
            border-radius: 50%; /* Make it rounded */
            color: #fff; /* Icon color */
            font-size: 24px; /* Adjust icon size as needed */
            cursor:pointer;
            }
            .rounded-volume-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px; /* Adjust width as needed */
            height: 60px; /* Adjust height as needed */
            background-color: #00FF00; /* Adjust background color as needed */
            border-radius: 50%; /* Make it rounded */
            color: #fff; /* Icon color */
            font-size: 24px; /* Adjust icon size as needed */
            cursor:pointer;
            }
            .rounded-map-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px; /* Adjust width as needed */
            height: 60px; /* Adjust height as needed */
            background-color: #808080; /* Adjust background color as needed */
            border-radius: 50%; /* Make it rounded */
            color: #fff; /* Icon color */
            font-size: 24px; /* Adjust icon size as needed */
            cursor:pointer;
            }
            .rounded-address-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px; /* Adjust width as needed */
            height: 60px; /* Adjust height as needed */
            background-color: #0000FF; /* Adjust background color as needed */
            border-radius: 50%; /* Make it rounded */
            color: #fff; /* Icon color */
            font-size: 24px; /* Adjust icon size as needed */
            cursor:pointer;
            }
            .icon{
                display:none;
            }
            .fa.fa-edit,.fa.fa-trash{
                 color:blue;
                 font-size:15px;
                 cursor:pointer;
            }
             
             
            </style>
            <script>
                 
                 $(document).ready(function(){
                      $(".fa.fa-telegram").click(function(){
                        var msg=$("#message").val();
                        var userid="<?php echo $userId ;?>";
                        // insert concept
                         
                         if(msg.length!=0) {
                                $.ajax({
                                url:"message.php",
                                type:"POST",
                                data:{msg:msg,userid:userid},
                                success:function(data){
                                    if(data.trim()=="success"){
                                        loadData();
                                    }
                                }
                            })
                         }
                      })
                      // get the record
                      function loadData(){
                        var senderid="<?php echo $from_userid ;?>";
                        var receiverid="<?php echo $userId ;?>";
                        var email="<?php echo $email ;?>";
                        var session="<?php echo $session ;?>";
                         $.ajax({
                              url:"get_chat.php",
                              type:"POST",
                              data:{senderid:senderid,receiverid:receiverid,email:email,session:session},
                              success:function(data){
                                   $("#chat-box").html(data);
                              }
                         })
                      }
                      loadData();
                      //load the page with this interval without refresh 
                      setInterval(() => {
                            loadData();
                      }, 500);  
                      
                 });
                 // modal and image concept
                 $(document).ready(function(){
                    //open the model concept
                   $("#openModalBtn").click(function(){
                         $("#myModal").modal('show');
                    });
                    //for image upload concept
                    $('#uploadIcon').click(function() {
                        $('#fileInput').click(); //Trigger click on file input
                    });
                    //save image concept
                    $("#fileInput").change(function(){
                        var send_userid="<?php echo $from_userid ?>";
                        const file=this.files[0]; //this is given the object
                        if(file){
                             const formData=new FormData();
                             formData.append("image",file);
                              //send the formData to the server through the Ajax
                              
                              $.ajax({
                                  url:"chat-image-upload.php",
                                  type:"POST",
                                  data:{formData:formData,send_userid:send_userid},
                                  success:function(data){
                                        alert(data);
                                  }
                              })

                        }
                    })

                });
                $(document).on("mouseover",".alert.alert-success",function(){
                       $(".icon").show();
                })
                $(document).on("mouseout",".alert.alert-success",function(){
                       $(".icon").hide();
                })
                $(document).on("click",".fa.fa-edit",function(){
                       
                })
                $(document).on("click",".fa.fa-trash",function(){
                    
                })
                  
            </script>
            <body>
<!---show the edit and delete icon through the jquery event------->
 <!---hiddent input  --->
  
 <input type="file" id="fileInput" accept="image/*"   style="display: none;">
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
     
      
      <!-- Modal Body -->
      <div class="modal-body">
           <div class="container-fluid">
              <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                           <div class="row">
                                <div class="col-sm-4">
                                        <i class="fa fa-file rounded-file-icon"></i><span>Document</span>
                                </div>
                                <div class="col-sm-4">
                                        <i class="fa fa-camera  rounded-camera-icon"></i><span>Camera</span>
                                </div>
                                <div class="col-sm-4">
                                        <i id="uploadIcon" class="fa fa-image rounded-image-icon"></i><span>Gallery</span>
                                </div>
                           </div>
                           <div class="row">
                                <div class="col-sm-4">
                                        <i class="fa fa-volume-up rounded-volume-icon"></i><span>Audio</span>
                                </div>
                                <div class="col-sm-4">
                                        <i class="fa fa-map-marker  rounded-map-icon"></i><span>Location</span>
                                </div>
                                <div class="col-sm-4">
                                        <i class="fa fa-address-card rounded-address-icon"></i><span>Contact</span>
                                </div>
                           </div>
                    </div>
                    <div class="col-sm-3"></div>
              </div>
           </div>
      </div>
       
    </div>
  </div>
</div>
            <div class="container-fluid">
                 <div class="row" style="margin-top:130px;">
                   <div class="col-sm-2"></div>
                   <div class="col-sm-8">
                         <div class="card">
                            <div class="card-body">
                                  <div class="row">
                                       <table class="table table-borderless">
                                          <tr>
                                            <td align=center>
                                                <img src="images/<?php echo $userId?>.jpg" class="rounded-circle" style="width:80px;height:80px;">
                                                <span><?php echo $r["first_name"]." ".$r["last_name"];?></span>
                                            </td>
                                            <td>
                                            <button class="btn btn-primary"><a href="logout.php" style="text-decoration:none;color:white">Logout</a></button>
                                            </td>
                                            <td>
                                            <button class="btn btn-primary"><a href="Dashboard.php" style="text-decoration:none;color:white">Home</a></button>
                                            </td>
                                          </tr>
                                       </table>
                                  </div>
                                  <hr>
                                 
                                        <div id="chat-box">
                                                 
                                         </div>
                                   
                                  <div class="row">
                                     
                                      <input type="text" id="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                                      <button><i class="fa fa-telegram"></i></button>
                                      <button id="openModalBtn"><i class="fa fa-paperclip"></i> </button>
                                  
                                  </div>
                            </div>
                             
                         </div>
                   </div>
                   <div class="col-sm-2"></div>
                 </div>
            </div>
           </body>
            <?php
        }
     }
}
else{
    header("location:login.php");
}


?>