<?php include "config.php";
session_start();
$rand_no=$_GET['rno'];

$forget_timestamp_query = "SELECT * from userdata where random_no = '$rand_no'";
$forget_timestamp_result = $conn->query($forget_timestamp_query);
$row = $forget_timestamp_result->fetch_assoc();
// print_r($row['forgetdate']);
echo "<br>";

// echo strtotime($row['forgetdate']);
$f_date = strtotime($row['forgetdate']);
// echo strtotime("+2 minutes");
// $endTime= strtotime($row['forgetdate']) + strtotime("-2 minutes");
// echo $endTime;
// echo "session<br>";
$endTime = strtotime($f_date) + strtotime("-2 minutes"); 
echo $f_date;

echo"<br>";
echo $endTime;

// exit();

// echo $_SESSION['forgetpass_timestamp'];

// $new_time= strtotime("+3 minutes");
// echo $_SESSION['forgetpass_timestamp'];
if($f_date > $endTime ) {    
    $rand_no=$_GET['rno'];
    // echo $rand_no;
    $message = $home = '';
    $_SESSION['user'] = $rand_no;
    // echo ($_SESSION['user']);
    // if isreset is 1 then the password is changed once SSS
    $que = "SELECT * from userdata where isreset = '1' AND random_no = '$rand_no'";
    $res = $conn->query($que);
    print_r($res);
    echo "<br>";
    $row = $res->fetch_assoc();
    echo $row['password'];
    $main_password=$row['password'];
    // exit();
    print_r($row['id']);
    $id= $row['id'];
    echo $id;
    if($res){
        if($_SESSION['user'] == ''){
            header("Location:forgetpassword.php");
        }
        else{  
            if(isset($_POST['submit'])){
                $password =  md5($_POST['password']);
                // echo $password;
                echo "<br>";
                $repassword = md5($_POST['repassword']);
                if($password !== $repassword){
                    echo "<div class='alert-warning'> password does not matched</div>";
                }
                else{            
                    $query = "SELECT * FROM password_history where user_id= '$id' ORDER BY id DESC LIMIT 5";
                    $result = $conn->query($query);
                    print_r($result);
                    foreach ($result as $key =>$value){
                        echo"<br>";
                        if($password==$value['password']){
                            echo "same password cannot be saved";
                            echo '<div class="alert alert-secondary">Your old password cant be same as new password</div>';
                            exit();
                        }
                    }
                    $q= "INSERT INTO password_history(user_id,password, status) VALUES ('$id','$password',1)";
                    $q_result = $conn->query($q); 
                    $query= "UPDATE password_history set password= '$password' where id = '$id'";
                    $query_result = $conn->query($query); 
                    print_r($query_result);
                    if($query_result){
                        echo "sucess Query_result";
                    }
                    $passquery= "UPDATE userdata set password = '$password' isreset=1 where random_no= '$rand_no'";
                    $user_pass_query = $conn->query($passquery); 
                    echo "main password <br>";
                    echo $password;
                    exit();

                    if ($result) {
                    //     while ($row = $result->fetch_assoc()){
                    //         // print_r($row['user_id']);
                    //         // echo "<br>";
                    //         // print_r($row['password']);
                    //         // echo "<br>";
                    //         // echo $password;
                    //         // echo $row['password'];
                    //         echo "'<br>";
                    //         print_r($row);
                    //         echo "'<br>";
                            if($password == $row['password']){
                                echo '<div class="alert alert-secondary">Your old password cant be same as new password</div>';
                            }       
                            else{
                                echo "<br>";
                                echo "hello";
                                $q= "INSERT INTO password_history(user_id,password, status) VALUES ('$id','$password',1)";
                                $q_result = $conn->query($q); 
                                $query= "UPDATE password_history set password= '$password' where id = '$id'";
                                $query_result = $conn->query($query); 
                                print_r($query_result);
                                if($query_result){
                                    echo "sucess Query_result";
                                }
                                $passquery= "UPDATE userdata set password = '$password' isreset=1 where random_no= '$rand_no'";
                                $user_pass_query = $conn->query($passquery); 
                                if($user_pass_query){
                                    echo "secess user_pass_result";
                                }
                                // $query = "UPDATE userdata SET password = '$password' WHERE id = '$id' ";
                                // $user_pass_result = $conn->query($user_pass_query); 
                                if($query_result){
                                //     echo "secess Query_result";
                                // }
                                // exit();
                                if($result){
                                    echo '<div class="alert alert-success">Password reset sucessfull..!!</div>';
                                    echo "1";
                                        // header("Location:login.php");
                                }else{
                                            echo '<div class="alert-danger">Failed to reset Password..!!</div>';
                                    }
                                }
                                }
                                echo "Please enter different password";
                            $result->free();
                            echo ($result);
                        }                
                    }
                }
            }
        }
        else{
            echo "Your link is expired ";
        }
    }
    else{
    header("location:forgetpassword.php");
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