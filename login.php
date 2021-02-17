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
    <h1 class="text-center">Login to get access!</h1>
    <div class="container">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
            <div class="form-group">
                <label><i class="fas fa-envelope"></i>&nbspEnter Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label><i class="fas fa-key"></i>&nbspEnter PASSWORD</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <input type="submit" name="login" class="btn-primary log"></input>
            <div><label for="">if you forget remember the password </label>
            <a href="forgetpassword.php">Click Here</a></div>
        </form>
        <?php
        if(isset($_POST['login'])){
            include "config.php";
            $email = mysqli_escape_string($conn,$_POST['email']);
            $password = md5($_POST['password']);
        
            // echo $email;
            // echo $password;

            // $sql = "SELECT * FROM userdata";
            $sql = "SELECT *  FROM userdata WHERE email= '{$email}' AND password= '{$password}' AND status = 0";
            echo ($sql);
            $result = mysqli_query($conn, $sql) or die("Login Query Failed");
            // print_r($result);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    // echo '<div class="alert-sucess">Logged in sucessfully</div>';
                    session_start();
                    $_SESSION["email"] = $row['email'];
                    $_SESSION["id"] = $row['id'];
                    $_SESSION["status"] = $row['status'];
                    header("location: http://localhost/display_checkbox/index.php");
                }
            }else{
                echo '<div class="alert-danger">Username and password does not matched</div>';
            }
        }
        ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
  </body>
</html>