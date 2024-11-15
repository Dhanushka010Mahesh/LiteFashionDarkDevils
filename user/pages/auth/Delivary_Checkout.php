<?php
//var_dump($_POST); 
session_start();
require('../../includes/config.php');


if (isset($_POST['order_data_submit'])) {


    // Check for missing values in the form
    if (empty(trim($_POST['cus_full_name'])) || empty(trim($_POST['cus_email_address'])) || 
        empty(trim($_POST['cus_street'])) || empty(trim($_POST['cus_city'])) ||
        empty(trim($_POST['cus_province'])) || empty(trim($_POST['cus_zip_code'])) ||
        empty(trim($_POST['cus_country'])) || empty(trim($_POST['cus_phone_number'])) || 
        empty(trim($_POST['payment_method']))) {
        
        // Alert if any field is missing
        echo "<script>alert('Missing value');</script>";
        exit; // Stop further processing
    } else {

        if (isset($_POST['update_delivery_data']) && $_POST['update_delivery_data'] === 'updateData') {
            $updateData=$connection->prepare("update customers set C_street='{$_POST['cus_street']}' , C_city='{$_POST['cus_city']}' , C_province='{$_POST['cus_province']}' , C_zipCode='{$_POST['cus_zip_code']}' , C_mobile='{$_POST['cus_phone_number']}' where CustermerId='{$_SESSION['cus_Id']}'");
            $updateData->execute();
            echo "<script>alert('Delivery Information Updated');</script>";
        }
        if($_POST['payment_method'] === 'cashOnDelivery'){
            $insertdata=$connection->prepare("INSERT INTO orders (CustomerId, O_fullName, O_emailAddress, O_street, O_city, O_province, O_zip_code, O_phone_number) VALUES (:CustermerId , :fullName , :email , :street , :city , :province , :zipCode , :tp )");
            

            $insertdata->execute([
                ":CustermerId"=>$_SESSION['cus_Id'],
                ":fullName"=>$_POST['cus_full_name'],
                ":email"=>$_POST['cus_email_address'],
                ":street"=>$_POST['cus_street'],
                ":city"=>$_POST['cus_city'],
                ":province"=>$_POST['cus_province'],
                ":zipCode"=>$_POST['cus_zip_code'],
                ":tp"=>$_POST['cus_phone_number']
            ]);

    
            //header("location: ".APPURL."./loginAccount.php");
            echo "<script> window.location.href='http://localhost/LiteFashionDarkDevils/user/pages/PaymentSuccess.php'; </script>";

        }else{
            $insertdata=$connection->prepare("INSERT INTO orders (CustomerId, O_fullName, O_emailAddress, O_street, O_city, O_province, O_zip_code, O_phone_number,O_payment_method)"+
             " VALUES (:CustermerId , :fullName , :email , :street , :city , :province , :zipCode , :tp , :opm)");
            

            $insertdata->execute([
                ":CustermerId"=>$fullname,
                ":fullName"=>$_POST['cus_full_name'],
                ":email"=>$_POST['cus_email_address'],
                ":street"=>$_POST['cus_street'],
                ":city"=>$_POST['cus_city'],
                ":province"=>$_POST['cus_province'],
                ":zipCode"=>$_POST['cus_zip_code'],
                ":tp"=>$_POST['cus_phone_number'],
                ":opm"=>"Online Payment"
            ]);

    
            //header("location: ".APPURL."./loginAccount.php");
            echo "<script> window.location.href='http://localhost/LiteFashionDarkDevils/user/pages/payPal_onlinePayment.php'; </script>";

        }
        

    }
}
?>