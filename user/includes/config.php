<?php
    // if(!isset($_SERVER['HTTP_REFERER'])){
    //     header('location: http://localhost/one-by-one-CMS/createAccount/Home.php');
    //     exit();
    // }


try{
    define("HOST","localhost");
    define("USER","root");
    define("PASS","");
    define("DBNAME","darkDevils");

    $connection=new PDO("mysql:host=".HOST.";dbname=".DBNAME.";",USER,PASS);

    // if($connection==true){
    //     echo "<script>alert('Connected');</script>";
    // }else{
    //     echo "<script>alert('Not Connected DB');</script>";
    // }
}catch(PDOException $e){
    echo $E->getMessage();
}