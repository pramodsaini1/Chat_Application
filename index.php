<?php 
//   session_start();
//   if(isset($_SESSION["session"])){
//     header("location:Dashboard.php");
//   }
?>
<?php include_once "header.php" ?>
<style>
body{
    background-color: lightblue;
}
</style>
<body>
<div class="container-fluid">
    <div class="row" style="margin-top:60px;">
          
           <div class="col-sm-4"></div>
            <div class="col-sm-4">
              <div class="card">
                  <div class="card-header">
                      
                    <h3>Real Time Chat App</h3></div>
                   <div class="card-body">
                     <form method="post" enctype="multipart/form-data" action="insert_record.php">
                             <div class="row">
                             <div class="col-sm-12">
                        <?php
                           if(isset($_GET["empty"])){
                               ?>
                               <div class="alert alert-danger">All Fields Are Required</div>
                               <?php
                            }
                            else if(isset($_GET["invalid_name"])){
                                ?>
                                <div class="alert alert-danger">Please Enter Your Valid Name</div>
                                <?php
                             }
                             else if(isset($_GET["invalid_email"])){
                                ?>
                                <div class="alert alert-info">Please Enter Your Valid Email-Id</div>
                                <?php
                             } 
                             else if(isset($_GET["already"])){
                                ?>
                                <div class="alert alert-info">Account Already Registered</div>
                                <?php
                             }
                             else if(isset($_GET["record_inserted"])){
                                ?>
                                <div class="alert alert-success">Registration Successfully</div>
                                <?php
                             } 
                             else if(isset($_GET["again"])){
                                ?>
                                <div class="alert alert-warning">Try Again</div>
                                <?php
                             } 
                             else if(isset($_GET["img_err"])){
                                ?>
                                <div class="alert alert-light">Image Uploading error</div>
                                <?php
                             }
                             else if(isset($_GET["invalid_password"])){
                                ?>
                                <div class="alert alert-warning">Please Enter Valid Password</div>
                                <?php
                             } 
                          ?>
                         </div>
                                <div class="col-sm-6">
                                    <label>First Name</label>
                                    <input type="text" name="fname" placeholder="First Name" required class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label>Last Name</label>
                                    <input type="text" name="lname" placeholder="Last Name"  required class="form-control">
                                </div>
                             </div> 
                             <div class="row" style="margin-top:15px;">
                                 <label>Email-Id</label>
                                 <input type="email" name="email" placeholder="Email-Id"  required class="form-control">
                             </div>
                             <div class="row" style="margin-top:15px;">
                                 <label>Password</label>
                                 <input type="password" name="pass" placeholder="Password"  required class="form-control">
                             </div>
                             <div class="row" style="margin-top:15px;">
                                 <label>Select Image</label>
                                  <input type="file" name="photo"  required class="form-control">
                             </div>
                             <div class="row" style="margin-top:15px;">
                                  <button class="btn btn-info form-control" type="submit">continue to chat</button>
                             </div>
                     </form>
                     <div class="row" style="margin-top:25px;">
                         <h5>Already Sign Up ?</h5><a href="login.php"><strong>Login</strong></a>
                     </div>
                 </div>
             </div>
            </div>
            
    </div>
</div>  
</body>
</html>