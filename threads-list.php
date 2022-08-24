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
    #queid {
        min-height: 430px;
    }
    </style>

    <title>Welcome to idiscuss - Coding forums</title>
</head>

<body>
    <?php require 'partials/_nav.php';?>
    <?php require 'partials/_dbconnect.php';?>

    <?php 
    $catid = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE Categories_id=$catid";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['Categories_name']; 
        $catdesc = $row['categories_desc']; 
    }
    
    ?>
    <?php
    $showAlert = false;
    $showError = false;
    $id = $_GET['catid'];
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $Tread_title = $_POST['title'];
        $Tread_desc = $_POST['desc'];
        $sing_id = $_POST['sing_id'];

        $sql = "INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_decs`, `thread_user_id`, `thread_cat_id`, `date`) VALUES (NULL, '$Tread_title', '$Tread_desc', '$sing_id', '$id', current_timestamp())";
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
        <h2 class="text-center">iDiscuss - Threads List</h2>
        <div class="alert alert-success" role="alert">
            <h1 class="alert-heading">Welcome to <?php echo $catname; ?> forums</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p class="my-4"> Do not post copyright-infringing material. ...
                Do not post “offensive” posts, links or images. ...
                Do not cross post questions. ...
                Do not PM users asking for help. ...
                Remain respectful of other members at all times.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<div class="container">
        <h1 class="py-2">Start a Discussion</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Tread Title</label>
                <input type="text" class="form-control" id="title" name="title">
                <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                possible.</small>
                </div>
                <div class="form-group">
                <label for="desc">Tread Desc</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>
                <input type="hidden" name="sing_id" value="'.$_SESSION["sing_id"].'">
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>';
        }else{
            echo '<div class="container">
            <h1 class="py-2">Start a Discussion</h1>
            <p class="lead">
            you are logged in please login to be able to start a discussion
            </p>
            </div>';
        }
    ?>
    <div class="container my-3" id="queid">
        <h1>Browise Questions</h1>
        <?php
      $id = $_GET['catid'];
      $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id"; 
      $result = mysqli_query($conn,$sql);
      $noResult = true;
      while($row = mysqli_fetch_assoc($result)){
          $noResult = false;
          $title = $row['thread_title'];
          $desc = $row['thread_decs'];
          $id = $row['thread_id'];
          $thread_time= $row['date'];
          $thread_user_id = $row['thread_user_id'];
          $sql2 = "SELECT Email FROM `singup` WHERE sing_id=$thread_user_id";
          $result2 = mysqli_query($conn,$sql2);
          $row2 = mysqli_fetch_assoc($result2);

          echo '
            <div class="d-flex my-3">
                <div class="flex-shrink-0">
                    <img src="image/user.png" width="34px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="mt-0"><a class="text-dark" href="threads.php?thread_id='.$id.'">'.$title.'</a></h5>
                    '.$desc.'</div>'.' <p class="my-0" style="font-weight:700;">Asked by: '.$row2['Email'].' at '.$thread_time.'</p>
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