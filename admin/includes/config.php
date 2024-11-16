<?php
    // if(!isset($_SERVER['HTTP_REFERER'])){
    //     header('location: http://localhost/one-by-one-CMS/createAccount/Home.php');
    //     exit();
    // }


try{
    //two time call this file come error block
    if(!defined("HOST")) define("HOST","localhost");
    if(!defined("USER")) define("USER","root");
    if(!defined("PASS")) define("PASS","");
    if(!defined("DBNAME")) define("DBNAME","darkDevils");

    $connection=new PDO("mysql:host=".HOST.";dbname=".DBNAME.";",USER,PASS);

}catch(PDOException $e){
    echo $E->getMessage();
}