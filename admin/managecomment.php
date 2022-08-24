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

        $sql = "DELETE FROM `comments` WHERE comment_id =$id";
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
            $c_commentname = $_POST['updatecommentname'];
            $c_threadname = $_POST['updatethreadname'];
            $c_username = $_POST['updateusername'];
            $sql = "UPDATE `comments` SET comment_id =$id, comment_content='$c_commentname', thread_id='$c_threadname', comment_user_id ='$c_username' WHERE comment_id =$id";
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
                            <label for="exampleInputEmail1">Comment Name</label>
                            <input type="text" class="form-control" id="updatecommentname" name="updatecommentname">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">thread Name</label>
                            <input type="text" class="form-control" id="updatethreadname" name="updatethreadname">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">username</label>
                            <input type="text" class="form-control" id="updateusername" name="updateusername">
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
            <h2 class=" text-center">All Comment Table</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">comment_id</th>
                    <th scope="col">comment_name</th>
                    <th scope="col">thread_name</th>
                    <th scope="col">commnet_user</th>
                    <!-- <th scope="col">Update</th> -->
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                        $sql = "SELECT * FROM `comments`"; 
                        $result = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($result)){
                            $id = $row['comment_id'];
                            $comments = $row['comment_content'];
                            $thread_id = $row['thread_id'];
                            $comment_user = $row['comment_user_id'];
                            $sql3 = "SELECT thread_title FROM `threads` WHERE thread_id=$thread_id";
                            $result3 = mysqli_query($conn,$sql3);
                            $row3 = mysqli_fetch_assoc($result3);
                            $thread_name = $row3['thread_title'];
                            $sql2 = "SELECT Email FROM `singup` WHERE sing_id=$comment_user";
                            $result2 = mysqli_query($conn,$sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            $username = $row2['Email'];

                            echo "
                            <tr>
                            <th scope='row'>".$id."</th>
                            <td>".$comments."</td>
                            <td>".$thread_name."</td>
                            <td>".$username."</td>
                            <td><button class='btn btn-danger'><a href='managecomment.php?deleteid=".$id."'class='text-light'>Delete</a></button></td>
                            </tr>";
                        }
                        // <td><button class='update btn btn-success' data-bs-toggle='modal' data-bs-target='#UpdateModal' id=".$row['comment_id']." class='text-light'>Update</button></a></td>
                    ?>
            </tbody>
        </table>
    </div>

    <?php require '../partials/_footer.php';?>
    <!-- Optional JavaScript; choose one of the two! -->

    <script>
        update = document.getElementsByClassName('update');
        Array.from(update).forEach((element) => {
            element.addEventListener("click", (e)=>{
                console.log("update", );
                tr = e.target.parentNode.parentNode;
                name = tr.getElementsByTagName("td")[0].innerText;
                thread_id = tr.getElementsByTagName("td")[1].innerText;
                comment_id = tr.getElementsByTagName("td")[2].innerText;
                console.log(name,thread_id,comment_id);
                updatecommentname.value = name;
                updatethreadname.value = thread_id;
                updateusername.value = comment_id;
                updateid.value = e.target.id;
                console.log(e.target.id);
            });  
        });
    </script>
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