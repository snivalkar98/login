<?php include "config.php";
session_start();
$id = $_GET['SsNPaNDa'];
$message = $home = '';
$_SESSION['user'] = $id;
if($_SESSION['user'] == ''){
    header("Location:forgetpassword.php");
}else{
    if(isset($_POST['submit'])){
        $password =  md5($_POST['password']);
        // echo $password;
        echo "<br>";
        $repassword = md5($_POST['repassword']);
        if($password !== $repassword){
            $message = "<div class='alert-danger'> password does not matched</div>";
            echo "Incorrect password does not matched";
        }
        else{
            $id_decode = base64_decode($id);
            // echo ($id_decode);
            $query = "SELECT user_id, password FROM password_history where user_id= '$id_decode' id DESC LIMIT 5 ";
            // echo ($q);
            $result = $conn->query($query);
            print_r($result);
            if ($result) {
                while ($row = $result->fetch_assoc()){
                    print_r($row['user_id']);
                    echo "<br>";
                    print_r($row['password']);
                    echo "<br>";
                    echo $password;
                    if($password == $row['password']){
                        echo '<div class="alert alert-secondary">Your old password cant be same as new password</div>';
                    }       
                    else{
                        echo "<br>";
                            echo "hello";
                            $q= "INSERT INTO password_history(user_id,password) VALUES ('$id_decode','$password')";
                            $result = $conn->query($q); 
                            // $query= "UPDATE password_history set password= '$password' where id =";
                            // $result = $conn->query($query); 
                            print_r($result);
                            echo '<div class="alert alert-success">Password reset sucessfull..!!</div>';

                            // if($result){
                                // header("Location:login.php");
                            // else{
                            //     echo '<div class="alert-danger">Failed to reset Password..!!</div>';
                            // }
                        // }
                    }
                        // echo "Please enter different password";
                        // if($i=0){
                        //     $query = "UPDATE userdata SET password = '$password' WHERE id = '$id_decode' ";
                        //     $result = $conn->query($query); 
                        //     if($result){
                        //         echo '<div class="alert alert-success">Failed to reset Password..!!</div>';
                        //         // header("Location:login.php");
                        //     }
                        //     else{
                        //         echo '<div class="alert-danger">Failed to reset Password..!!</div>';
                        //     }
                        // }
                }
                $result->free();
            }            
        }
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset pass</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

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
    <div class="container">
    <h1 class="text-center">We Will help you to retrive your password!</h1>
        <form method="POST">
            <label for="">Password</label>
            <div class="form-group">
                <input type="password" name="password" placeholder="Enter New password" class="form-control">
            </div>
            <label for="">Retype password</label>
            <div class="form-group">
                <input type="password" name="repassword" placeholder="ReEnter password" class="form-control">
            </div>
            <input type="submit" name="submit" class="btn-primary"></input>
        </form>
    </div>
</body>
</html>