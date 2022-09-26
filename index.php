<?php 
session_start();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <meta name="description" content="PHPMailer ile mail gönderme işlemi - Havva Zeynep Akdemir">
	<meta name="author" content="https://github.com/Havvazeynep , havvazeynepakdemir@gmail.com">
	<meta name="keywords" content="HTML CSS JS PHP Bootstrap Composer PHPMailer">
    <title>PHPMailer</title>
</head>
<body>
    <div class="container">
        <h3 class="text-center mt-5 mb-5">PHP ile Mail Gönderme</h3>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if(isset($_SESSION["alert"])) { ?>
                    <div class="alert alert-<?php echo $_SESSION["alert"]["type"];?>">
                        <?php echo $_SESSION["alert"]["message"];?>
                    </div>
                    <?php unset($_SESSION["alert"]); ?>

                <?php } ?>
                <form action="send_email.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Gönderilecek adres</label>
                        <input class="form-control" type="email" required name="to_email">
                    </div>
                    <div class="form-group">
                        <label for="">Gönderenin Adı</label>
                        <input class="form-control" type="text" required name="sender">
                    </div>
                    <div class="form-group">
                        <label for="">Konu</label>
                        <input class="form-control" type="text" required name="subject">
                    </div>
                    <div class="form-group">
                        <label for="">Mesaj</label>
                        <textarea name="message" cols="30" rows="10" required class="form-control"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="formFile" class="form-label">Dosya seç</label>
                        <input class="form-control" type="file" required name="attachment">
                    </div>
                    <button type="submit" class="btn btn-primary">Gönder</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>