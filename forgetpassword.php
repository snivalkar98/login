<?php
include "config.php";
session_start();
$_SESSION["forgetpass_timestamp"] = time();
echo $_SESSION["forgetpass_timestamp"];
$link= '';
// $message= $link = '';
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $subject = "Here's your link for password Resset";
    $headers = "From: snivalkar1998@gmail.com";
    // echo $email;
    $f_date = date("Y-m-d H:i:s");     // 2019-10-30 22:42:18(MySQL DATETIME format)

    echo $f_date;
    $forget_date_query = "UPDATE userdata set forgetdate = '$f_date' where email ='{$email}'";
    $forget_date_result = mysqli_query($conn, $forget_date_query) or die("Email Query Failed"); 
    // exit();
    $query = "SELECT * from userdata where email = '{$email}' AND status = '0'";
    $result = mysqli_query($conn, $query) or die("forgetdate Query Failed");
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $random = $row['random_no'];
            // echo ($random);
            $body = "Heres the link to reset the password'http://localhost/i-think/login/repasshis.php?rno=$random'";
            // $link = "<a href = 'resetpass.php?SsNPaNDa=$random'>Recieve mail</a>";
        }
        if(mail($email,$subject,$body,$headers)){
            echo "Email Sucessfully sent to $email please check the mail and click on the link";
            echo "<script>alert('ok'); </script>";
        }else{
            echo "Email Sending failed. Please re-enter the link";
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
        .box{
            /* height: 100vh;
            width: 600px; */
            display: block;
            width: 50%;
            margin-left: 25%;
            margin-top: 120px;
            background-color: #E5E7E9;
            border-width: 2px;
            border-style: solid;
            border-color: #AEB6BF;
            border-radius: 10px;
            padding: 50px 40px;
        }
        .log{
            border: 5px;
            border-radius: 2px;
        }
        @media screen and (max-width:768px){
            .box{
            /* height: 100vh;
            width: 600px; */
            display: block;
            width: auto;
            margin-top: 120px;
            margin-left: 1%;
            margin-right: 1%;
            background-color: #E5E7E9;
            border-width: 2px;
            border-style: solid;
            border-color: #AEB6BF;
            border-radius: 10px;
            padding: 50px 20px;
            }
        }
    </style>
  </head>
  <body>
    <div class="container">
        <div class="box">
        <h5 class="text-center">We Will help you to retrive your password!</h5>
            <form action="" method="POST" style="margin-top:20px;">
                <div class="form-group">
                    <label><i class="fas fa-envelope"></i>&nbspEnter Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email here">
                </div>
                <input type="submit" name="submit" class="btn-primary log"> Get the link to create new password</input>
            </form>
            <?php echo $link;?>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
  </body>
</html>