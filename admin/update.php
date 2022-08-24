<?php
    require 'navAdmin.php';
    require '../partials/_dbconnect.php';
?>
<?php
    $id = $_GET['updateid'];
    $sql2 = "SELECT * FROM `categories` WHERE Categories_id=$id";
    $result2 = mysqli_query($conn,$sql2);
    $row = mysqli_fetch_assoc($result2);
    $cat_name = $row['Categories_name'];
    $cat_desc = $row['categories_desc'];
    if(isset($_POST['submit'])){
        $cat_Name = $_POST['name'];
        $cat_desc = $_POST['desc'];

        $sql = "UPDATE `categories` SET  Categories_id =$id,  Categories_name='$cat_Name',  Categories_id ='$cat_desc' WHERE Categories_id =$id";
        $result = mysqli_query($conn,$sql);
        if($result){
            echo "update successfully";
            header('location:admin/managecategoier.php');
        }
        else{
            echo "Update error".mysqli_error($conn);
        }
    }  
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Crud Wed site</title>
</head>

<body>
    <div class="container my-4">
        <h2>Add a Data</h2>
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Categories Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $cat_name; ?>">
            </div>
            <div class="form-group">
                <label for="desc">Categories Desc</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"><?php echo $cat_desc; ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">submit</button>
        </form>
    </div>

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