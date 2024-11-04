<?php
  require_once ('../includes/config.php');
  session_start();
  if(isset($_SESSION['username'])){
    echo "<script> window.location.href='http://localhost/DarkDevilsLiteFashion/user/'; </script>";
  }


  if(isset($_POST['submit'])){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password']))){
        echo "<script>alert('Missing value');</script>";
    }else{
        $username=trim($_POST['username']);
        $password=$_POST['password'];

        $login=$connection->query("select * from customers where C_username='$username' and C_status='1'");
        $login->execute();
        $fetchLog=$login->fetch(PDO::FETCH_ASSOC);


        if($login->rowCount()>0){
            if($password == trim($fetchLog['C_hashpassword'])){
            /*if(password_verify(trim($password),trim($fetchLog['C_hashpassword']))){*/
                  
                 $_SESSION['username']=$fetchLog['C_username'];
                 $_SESSION['email']=$fetchLog['C_email'];
                 $_SESSION['mobile']=$fetchLog['C_mobile'];
                 $_SESSION['address']=$fetchLog['C_address'];
                 $_SESSION['image']=$fetchLog['C_image'];
                 $_SESSION['custormerId']=$fetchLog['CustermerId'];
                 $_SESSION['Full name']=$fetchLog['C_fullname'];
                //echo "<script>alert('succuss');</script>";
                echo "<script> window.location.href='http://localhost/DarkDevilsLiteFashion/user/'; </script>";


            }else{
                //echo password_hash("12345",PASSWORD_DEFAULT);
                //echo password_hash(12345,PASSWORD_DEFAULT);
                echo "<script>alert('Missing value');</script>";
                echo "<script> window.location.href='http://localhost/DarkDevilsLiteFashion/user/'; </script>";
                // $dd=password_hash("7898",PASSWORD_DEFAULT);
                // if(password_verify(trim("7898"),trim($dd))){
                //   echo "<script>alert('1');</script>";
                // }
            }
        }else{
            echo "<script>alert('invalid');</script>";
            echo "<script> window.location.href='http://localhost/DarkDevilsLiteFashion/user/'; </script>";

        }
    }
  }
?>