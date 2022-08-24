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
        min-height: 430px;
    }
    </style>

    <title>Welcome to Admin SSite idiscuss - Coding forums</title>
</head>

<body>
    <?php require 'navAdmin.php';?>
    <?php require '../partials/_dbconnect.php';?>
    <?php
    $showAlert = false;
    $showError = false;
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $cate_name = $_POST['name'];
        $cate_desc = $_POST['desc'];
        $cate_name = str_replace("<", "&lt", $cate_name);
        $cate_name = str_replace(">", "&gt", $cate_name);

        $sql = "INSERT INTO `categories` (`Categories_id`, `Categories_name`, `categories_desc`, `Date`) VALUES (NULL, '$cate_name', '$cate_desc', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if($result){
            $showAlert = true;
        }
    }
    ?>
    <?php
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong> your categories is insert successfully check managecategoier.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if($showError){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error </strong> categories in not insert
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <!-- Card -->
    <div class="container my-3" id="cred">
        <h2 class="text-center">Welcome to Admin site of iDiscuss - Coding Forums</h2>
        <div class="container">
            <h3 class="py-2">Add New Categories</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Categories Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="desc">Categories Desc</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success my-3">Submit</button>
            </form>
        </div>
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