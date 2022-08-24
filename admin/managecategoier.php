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

        $sql = "DELETE FROM `categories` WHERE Categories_id =$id";
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
    $showAlert = false;
    $showError = false;
    if(isset($_POST['submit'])){
        if(isset($_POST['updateid'])){
            $id = $_POST['updateid'];
            $cat_Name = $_POST['updatename'];
            $cat_desc = $_POST['updatedesc'];
            $sql = "UPDATE `categories` SET Categories_id =$id, Categories_name='$cat_Name', categories_desc ='$cat_desc' WHERE `categories`.Categories_id =$id";
            $result = mysqli_query($conn,$sql);
            if($result){
                $showAlert = "update successfully";
            }
            else{
                $showError = "Update error".mysqli_error($conn);
            }
        }
      } 
    ?>
    <?php
    if($showDelete){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> Delete data successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success </strong>'.$showAlert.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if($showError){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error! </strong>'.$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <div class="modal fade" id="UpdateModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">update data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" name="updateid" id="updateid">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Categories Name</label>
                            <input type="text" class="form-control" id="updatename" name="updatename">
                        </div>
                        <div class="form-group">
                            <label for="desc">Categories Desc</label>
                            <textarea class="form-control" id="updatedesc" name="updatedesc" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Card -->
    <div class="container my-3" id="cred">
        <h2 class=" text-center">All Categories Table</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                        $sql = "SELECT * FROM `categories`"; 
                        $result = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($result)){
                            $catid = $row['Categories_id'];
                            $cat = $row['Categories_name'];
                            $desc = $row['categories_desc'];

                            echo "
                            <tr>
                            <th scope='row'>".$catid."</th>
                            <td>".$cat."</td>
                            <td>".$desc."</td>
                            <td><button class='update btn btn-success' data-bs-toggle='modal' data-bs-target='#UpdateModal' id=".$row['Categories_id']." class='text-light'>Update</button></a></td>
                            <td><button class='btn btn-danger'><a href='managecategoier.php?deleteid=".$catid."' class='text-light'>Delete</a></button></td>
                            </tr>";
                        }
                    ?>
            </tbody>
        </table>
    </div>

    <?php require '../partials/_footer.php';?>

    <script>
        update = document.getElementsByClassName('update');
        Array.from(update).forEach((element) => {
            element.addEventListener("click", (e)=>{
                console.log("update", );
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                console.log(title, description);
                updatename.value = title;
                updatedesc.value = description;
                updateid.value = e.target.id;
                console.log(e.target.id);
            });  
        });
    </script>
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