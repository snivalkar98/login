<html lang="en">
<head>
<meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>
<title>Sign Up</title>
<body>
<h1 class="text-center">Sign up to get  access!</h1>
    <div class="container">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
            <div class="form-group">
                <label><i class="fas fa-user"></i>&nbspEnter Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label><i class="fas fa-envelope"></i>&nbspEnter Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label><i class="fas fa-key"></i>&nbspEnter PASSWORD</label>
                <input type="password" name="password" class="form-control" required>
            </div>  
            <div class="form-group">
                <label><i class="fas fa-key"></i>&nbsp Re-Enter PASSWORD</label>
                <input type="password" name="repassword" class="form-control" required>
            </div>            
            <input type="submit" name="signup" class="btn-primary log"></input>
        </form> 
    </div>
</body>
</html>
<?php
if(isset($_POST['signup'])){
        include "config.php";
        $name= mysqli_escape_string($conn,$_POST['name']);
        $email = mysqli_escape_string($conn,$_POST['email']);
        $password = md5($_POST['password']);
        $repassword = md5($_POST['repassword']);
        $randomNumber = rand(); 
        // echo ($randomNumber);
        if($password != $repassword){
            echo "Password does not match";
        }else{
            // $sql = "SELECT * FROM userdata";
            // random number generated to pass with the link
            $sql = "INSERT INTO userdata (name, email, password, random_no) VALUES ('$name','$email', '$password', '$randomNumber')";
            // echo ($sql);
            $result = mysqli_query($conn, $sql) or die("Signup Query Failed");
            $q = "select id from userdata where email= '$email'";
            $r = mysqli_query($conn, $q) or die("select ID Query Failed");
            if($r){
                while($row= $r->fetch_assoc()){
                    echo ($row['id']);
                    $id = $row['id'];
                    $query= "INSERT INTO password_history (user_id,password) VALUES ('$id','$password')";
                    $res = mysqli_query($conn, $query) or die("Password_history Query Failed");
                }
            }
            if($result){
                echo "$name your account is created..!";
            }
            else {
                echo "Invalid Inputs entered";
            }
        }
    }
 ?>