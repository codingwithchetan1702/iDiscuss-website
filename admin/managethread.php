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
    #cred {
        min-height: 630px;
    }
    </style>

    <title>Welcome to Admin SSite idiscuss - Coding forums</title>
</head>

<body>
    <?php require 'navAdmin.php';?>
    <?php require '../partials/_dbconnect.php';?>
    <?php
    $showDelete = false;
    $showError = false;
    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $sql = "DELETE FROM `threads` WHERE thread_id =$id";
        $result = mysqli_query($conn,$sql);

        if($result){
            $showDelete = true;
        }
        else{
            $showError = "record is not delete";
        }
    }
    ?>
    <?php
    if($showDelete){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong> Delete data successfully.
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
    <!-- Card -->
    <div class="container my-3" id="cred">
            <h2 class=" text-center">All Thread Table</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Thread_id</th>
                    <th scope="col">Thread_title</th>
                    <th scope="col">Thread_desc</th>
                    <th scope="col">Categories_name</th>
                    <th scope="col">Thread_user</th>
                    <!-- <th scope="col">Update</th> -->
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                        $sql = "SELECT * FROM `threads`"; 
                        $result = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($result)){
                            $thread_id = $row['thread_id'];
                            $thread_title = $row['thread_title'];
                            $thread_desc = $row['thread_decs'];
                            $thread_user = $row['thread_user_id'];
                            $categories_id = $row['thread_cat_id'];
                            $sql3 = "SELECT Categories_name FROM `categories` WHERE Categories_id=$categories_id";
                            $result3 = mysqli_query($conn,$sql3);
                            $row3 = mysqli_fetch_assoc($result3);
                            $cate_name = $row3['Categories_name'];
                            $sql2 = "SELECT Email FROM `singup` WHERE sing_id=$thread_user";
                            $result2 = mysqli_query($conn,$sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            $username = $row2['Email'];

                            echo "
                            <tr>
                            <th scope='row'>".$thread_id."</th>
                            <td>".$thread_title."</td>
                            <td>".$thread_desc."</td>
                            <td>".$cate_name."</td>
                            <td>".$username."</td>
                            <td><button class='btn btn-danger'><a href='managethread.php?deleteid=".$thread_id."'class='text-light'>Delete</a></button></td>
                            </tr>";
                            // <td><button class='btn btn-success'><a href='update.php?updateid=".$thread_id."' class='text-light'>Update</a></button></td>
                        }
                    ?>
            </tbody>
        </table>
    </div>

    <?php require '../partials/_footer.php';?>
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