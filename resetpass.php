<?php include "config.php";
session_start();
$id = $_GET['SsNPaNDa'];
$message = $home = '';
$i=0;

$_SESSION['user'] = $id;
if($_SESSION['user'] == ''){
    header("Location:forgetpassword.php");
}else{
    if(isset($_POST['submit'])){
        $password =  md5($_POST['password']);
        echo $password;
        echo "<br>";
        $repassword = md5($_POST['repassword']);
        if($password !== $repassword){
            $message = "<div class='alert-danger'> password does not matched</div>";
            echo "Incorrect password does not matched";
        }
        else{
            $id_decode = base64_decode($id);
            $q = "select prepass1, prepass2, prepass3, prepass4, prepass5 from userdata where id= $id_decode";
            $r = $conn->query($q);
            // print_r($r);
            if ($r) {
                /* fetch associative array */
                while ($row = $r->fetch_assoc()) {
                    print_r($row['prepass1']);
                    echo "<br>";
                    $pass1= $row['prepass2'];
                    $pass2= $row['prepass3'];
                    $pass3= $row['prepass4'];
                    $pass4= $row['prepass5'];
                    $pass5= $password;

                    // print_r($row['prepass2']);
                    // echo "<br>";
                    // print_r($row['prepass3']);
                    // echo "<br>";
                    // print_r($row['prepass4']);
                    // echo "<br>";
                    // print_r($row['prepass5']);
                    if($password == $row['prepass1'] || $password == $row['prepass2'] || $password == $row['prepass3'] || $password == $row['prepass4'] || $password == $row['prepass5']){
                        echo '<div class="alert alert-secondary">Your old password cant be same as new password</div>';
                    }
                    else{
                        echo "<br>";
                        // echo "Please enter different password";
                            echo "hello";
                            $query = "UPDATE userdata SET password = '$password', prepass1 = '$pass1', prepass2='$pass2', prepass3='$pass3', prepass4='$pass4',prepass5='$password'  WHERE id = '$id_decode' ";
                            $result = $conn->query($query); 
                            print_r($result);

                            if($result){
                                echo '<div class="alert alert-success">Password reset sucessfull..!!</div>';
                                header("Location:login.php");
                            // else{
                            //     echo '<div class="alert-danger">Failed to reset Password..!!</div>';
                            // }
                        }
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
                $r->free();
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