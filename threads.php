<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
    #thread {
        min-height: 600px;
    }
    </style>

    <title>Welcome to idiscuss - Coding forums</title>
</head>

<body>
    <?php require 'partials/_nav.php';?>
    <?php require 'partials/_dbconnect.php';?>

    <?php 
    $id = $_GET['thread_id'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $thread_title = $row['thread_title']; 
        $thread_desc = $row['thread_decs']; 
        $thread_user = $row['thread_user_id'];
        $sql2 = "SELECT Email FROM `singup` WHERE sing_id=$thread_user";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
    }
    ?>
    <?php
    $showAlert = false;
    $showError = false;
    $thread_id = $_GET['thread_id'];
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $comment = $_POST['comment'];
        $comment = str_replace("<", "&lt", $comment);
        $comment = str_replace(">", "&gt", $comment);
        $sing_id = $_POST['sing_id'];

        $sql = "INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_user_id`, `comment_time`) VALUES (NULL, '$comment', '$thread_id', '$sing_id', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if($result){
            $showAlert = true;
        }
    }
    ?>
    <?php
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong> your discussion is insert successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if($showError){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error </strong>'.$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>

    <div class="container my-4">
        <div class="alert alert-success" role="alert">
            <h1 class="alert-heading">Welcome to <?php echo $thread_title; ?> forums</h1>
            <p class="lead"><?php echo $thread_desc; ?></p>
            <hr>
            <p class="my-4"> Do not post copyright-infringing material. ...
                Do not post “offensive” posts, links or images. ...
                Do not cross post questions. ...
                Do not PM users asking for help. ...
                Remain respectful of other members at all times.</p>
            <p><b>posted by:<?php echo $row2['Email']; ?></b></p>
        </div>
    </div>
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<div class="container">
        <h1 class="py-2">Post a Comment</h1>
        <form method="POST">
            <div class="form-group">
                <label for="desc">type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <input type="hidden" name="sing_id" value="'.$_SESSION["sing_id"].'">
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
        }else{
            echo '<div class="container">
            <h1 class="py-2">Post a Comment</h1>
            <p class="lead">
            you are logged in please login to be able to post a Comment
            </div>';
        }
    ?>

    <div class="container my-3" id="thread">
        <h1>Discussions</h1>
        <?php
      $id = $_GET['thread_id'];
      $sql = "SELECT * FROM `comments` WHERE thread_id=$id"; 
      $result = mysqli_query($conn,$sql);
      $noResult = true;
      while($row = mysqli_fetch_assoc($result)){
          $noResult = false;
          $id = $row['comment_id'];
          $comments = $row['comment_content'];
          $comment_time = $row['comment_time'];
          $comment_user = $row['comment_user_id'];
          $sql2 = "SELECT Email FROM `singup` WHERE sing_id=$comment_user";
          $result2 = mysqli_query($conn,$sql2);
          $row2 = mysqli_fetch_assoc($result2);

          echo '
            <div class="d-flex my-3">
                <div class="flex-shrink-0">
                    <img src="image/user.png" width="34px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <p class="my-0" style="font-weight:700;">'.$row2['Email'].'  at '.$comment_time.'</p>
                    '.$comments.'
                </div>
            </div>
            ';
        }
        if($noResult){
            echo ' 
            <div class="alert alert-success" role="alert">
            <div class="container">
                 <h1 class="alert-heading">No Result Found</h1>
                 <p class="lead"> Be the first person to ask question.</p>
               </div>
            </div>';
        }
        ?>
    </div>



    <?php require 'partials/_footer.php';?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>