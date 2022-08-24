<?php
include '_dbconnect.php';

$login = false;
$showError = "false";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql2 = "SELECT * FROM `admin_login` WHERE `Admin_name` = '$username' AND `Admin_password` = '$password'";
    $result2 = mysqli_query($conn, $sql2);
    if(mysqli_num_rows($result2)){
       echo " Admin login successfully";
       $Adminlogin = true;
       session_start();
       $_SESSION['Adminlogin'] = true;
       $_SESSION['username'] = $username;
       header("location:../admin/Addcategoier.php");
    }
    else{
        $sql = "SELECT * FROM `singup` WHERE Email='$username'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num == 1){
            while($row=mysqli_fetch_assoc($result)){
                if($password == $row['pass']){
                    echo "login successfully";
                    $login = true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['sing_id'] = $row['sing_id'];
                    $_SESSION['username'] = $username;
                    header("location:../index.php");
                }
                else{
                    echo "username and password are not correct.";
                }
            }
        }else{
            $showError = "username and password are not correct.";
            header("location:../index.php");
    
        }
    }
    
}



?>