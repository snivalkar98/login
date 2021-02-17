<?php
include "config.php";
session_start();
$message= $link = '';
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $subject = "Resset password";
    $headers = "From: snivalkar1998@gmail.com";
    // echo $email;
    $query = "SELECT * from userdata where email = '{$email}'";
    $result = mysqli_query($conn, $query) or die("Email Query Failed");
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            // $id_encode = base64_encode($id);
            $body = "Heres the link to reset the password'http://localhost/i-think/login/repasshis.php?SsNPaNDa=$id_encode'";
            // echo 1;
            // $link = "<a href = 'resetpass.php?SsNPaNDa=$id_encode'>Recieve mail</a>";
        }
        if(mail($email,$subject,$body,$headers)){
            echo "Email Sucessfully sent to $email";
        }else{
            echo "Email Sending failed";
        }
    }else{
        echo '<div class="alert-danger">Invalid email..!!</div>';
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <title>Login!</title>
    <style>
        .container{
            height: 100vh;
            width: 600px;
        }
        .log{
            border: 5px;
            border-radius: 2px;
        }
    </style>
  </head>
  <body>
    <h1 class="text-center">We Will help you to retrive your password!</h1>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <label><i class="fas fa-envelope"></i>&nbspEnter Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <input type="submit" name="submit" class="btn-primary log"> Get the link to create new password</input>
            <?php echo $link;?>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
  </body>
</html>
