<?php

$showError = "false";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '_dbconnect.php';
    $username = $_POST['singupEmail'];
    $pass = $_POST['singupPassword'];
    $cpass = $_POST['singupcPassword'];

    if($pass == $cpass){
        $sql = "INSERT INTO `singup` (`sing_id`, `Email`, `pass`, `date`) VALUES (NULL, '$username', '$pass', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "data is insert";
            header("location:../index.php?signupsuccess=true");
            exit();
        }
    }
    else{
        $showError = "error password are not same.";
        header("location:../index.php?signupsuccess=false&error=$showError");
    }

}


?>