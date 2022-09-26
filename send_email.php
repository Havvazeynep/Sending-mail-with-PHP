<?php
session_start();
error_reporting(E_ERROR);   //hata alındığında sadece error hatasını gösterir

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHPMailer ile mail gönderme işlemi - Havva Zeynep Akdemir">
	<meta name="author" content="https://github.com/Havvazeynep , havvazeynepakdemir@gmail.com">
	<meta name="keywords" content="HTML CSS JS PHP Bootstrap Composer PHPMailer">
    <title>Send Mail</title>
</head>
<body>
    <?php 
    if(isset($_POST)){

        if($_POST["to_email"] && $_POST["sender"] && $_POST["subject"] && $_POST["message"]){
            //Dosya gönderme işlemi

            $file = $_FILES["attachment"];

            if(move_uploaded_file($file["tmp_name"],"files/".$file["name"])){
                //Mail gönderme işlemi gerçekleştirme

                $mail = new PHPMailer(true);
                try{
                    //Server ayarları
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "mymail@gmail.com";
                    $mail->Password = 'my password'; //Mail adresinizin şifresi
                    $mail->CharSet = "utf-8";
                    $mail->SMTPSecure = "tls";
                    $mail->Port = 587;

                    //Alıcı ayarları
                    $mail->setFrom("mymail@gmail.com", $_POST["sender"]);
                    $mail->addAddress($_POST["to_email"], "");
                    $mail->addAttachment("files/".$file["name"]);
                    //$mail->addBCC("","");
                    //$mail->addCC("","");

                    //Gönderi ayarları
                    $mail->isHTML();
                    $mail->Subject = $_POST["subject"];
                    $mail->Body = $_POST["message"];

                    if($mail->send()){
                        $alert = array(
                            "message" => "Mail başarılı bir şekilde gönderilmiştir",
                            "type" => "success"
                        );
                    } else {
                        $alert = array(
                            "message" => "Mail gönderirken bir hata oluştu",
                            "type" => "danger"
                        );
                    }

                } catch (Exception $e) {
                    $alert = array(
                        "message" => $e->getMessage(),
                        "type" => "danger"
                    );
                }
        
                
            } else {
                $alert = array(
                    "message" => "Dosya yüklenirken bir hata oluştu",
                    "type" => "danger"
                );
            }

        }else {
            $alert = array(
                "message" => "Lütfen tüm alanları doldurunuz",
                "type" => "danger"
            );
        }

        $_SESSION["alert"] = $alert;
    
        header("Location: index.php");
    
    }
    
    ?>
</body>
</html>





