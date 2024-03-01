<?php
if(empty($_POST["fname"])||empty($_POST["lname"])||empty($_POST["email"])||empty($_POST["pass"])){
    header("location:index.php?empty=1");
}
else{
    $conn=mysqli_connect("localhost","root","","chat");

    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $pass = mysqli_real_escape_string($conn, $_POST["pass"]);
    if(!preg_match("/^[a-zA-z]*$/",$fname)||!preg_match("/^[a-zA-z]*$/",$lname)){
        header("location:index.php?invalid_name=1");
    }
    else{
            $first_name=validation($fname);
            $last_name=validation($lname);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("location:index.php?invalid_email=1");
            }
            else{
                    $email_id=validation($email);
                    $password=validation(md5($pass));
                    $sn=0;
                    $rs=mysqli_query($conn,"select MAX(sn) from user");
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

                    $unique_id=$code;

                    $status=1;

                    $dt=date("d M,Y");

                    $target ="images/". $code.".jpg";

                    $rp=mysqli_query($conn,"select * from user where email='$email'");
                    if($rq=mysqli_fetch_array($rp)){
                        header("location:index.php?already=1");
                    }
                    else{
                        if(move_uploaded_file($_FILES['photo']['tmp_name'],$target)){
                            if(mysqli_query($conn,"insert into user(sn,userId,first_name,last_name,email,password,status,login_time) values($sn,'$unique_id','$first_name','$last_name','$email_id','$password',$status,'$dt')")>0){
                            header("location:index.php?record_inserted=1");
                            }
                            else{
                                header("location:index.php?again=1");
                            }
                        }
                        else{
                            header("location:index.php?img_err=1");
                        }
                    }
               }

    }

}
function validation($data) {  
    $data = trim($data);  
    $data = stripslashes($data); 
    $data=strtolower($data); 
    $data = htmlspecialchars($data);  
    return $data;  
}  

?>