<?php
// require '../partials/_dbconnect.php';

// if(isset($_GET['page'])){
//     $page = $_GET['page'];
// }
// else{
//     $page = 1;
// }

// $num_per_page = 02;
// $start_from = ($page-1)*2;


// $query = "SELECT * FROM `contact` limit $start_from, $num_per_page";
// $par_result = mysqli_query($conn, $query);

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

        $sql = "DELETE FROM `contact` WHERE contact_id =$id";
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
            $username = $_POST['updateusername'];
            $email = $_POST['updateemail'];
            $phone = $_POST['updatephone'];
            $desc = $_POST['updatedesc'];
            $sql = "UPDATE `contact` SET contact_id= $id, contact_username='$username', contact_Email='$email',contact_phone ='$phone', contact_desc='$desc' WHERE contact_id =$id";
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
                            <label for="exampleInputEmail1">username</label>
                            <input type="text" class="form-control" id="updateusername" name="updateusername">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" id="updateemail" name="updateemail">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">phone</label>
                            <input type="text" class="form-control" id="updatephone" name="updatephone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">desc</label>
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
            <h2 class=" text-center">All Contact Table</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">contact_id</th>
                    <th scope="col">contact_username</th>
                    <th scope="col">contact_Email</th>
                    <th scope="col">contact_phone</th>
                    <th scope="col">contact_desc</th>
                    <th scope="col">contact_time</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                        $sql = "SELECT * FROM `contact`"; 
                        $result = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($result)){
                            $id = $row['contact_id'];
                            $username = $row['contact_username'];
                            $Email = $row['contact_Email'];
                            $phone = $row['contact_phone'];
                            $desc = $row['contact_desc'];
                            $contact_time = $row['contact_time'];

                            echo "
                            <tr>
                            <th scope='row'>".$id."</th>
                            <td>".$username."</td>
                            <td>".$Email."</td>
                            <td>".$phone."</td>
                            <td>".$desc."</td>
                            <td>".$contact_time."</td>
                            <td><button class='update btn btn-success' data-bs-toggle='modal' data-bs-target='#UpdateModal' id=".$row['contact_id']." class='text-light'>Update</button></a></td>
                            <td><button class='btn btn-danger'><a href='managecontact.php?deleteid=".$id."'class='text-light'>Delete</a></button></td>
                            </tr>";
                        }
                    ?>
            </tbody>
        </table>
        <?php
        // $pr_query = "SELECT * FROM `contact`";
        // $pr_result = mysqli_query($conn, $pr_query);
        // $total_record = mysqli_num_rows($pr_result);

        // $total_page = ceil($total_record/$num_per_page); 
        // if($page>1){
        //     echo "<a href='managecontact.php?page=".($page-1)."' class='btn btn-danger pd-1'>Previous</a>";
        // }  
        // for($i=1;$i<$total_page;$i++){
        //     echo "<a href='managecontact.php?page=".$i."' class='btn btn-primary'>$i</a>";
        // }
        // if($i>$page){
        //     echo "<a href='managecontact.php?page=".($page+1)."' class='btn btn-primary'>Next</a>";
        // }  

        ?>

    </div>

    <?php require '../partials/_footer.php';?>
    <!-- Optional JavaScript; choose one of the two! -->
    <script>
        update = document.getElementsByClassName('update');
        Array.from(update).forEach((element) => {
            element.addEventListener("click", (e)=>{
                console.log("update", );
                tr = e.target.parentNode.parentNode;
                user = tr.getElementsByTagName("td")[0].innerText;
                email = tr.getElementsByTagName("td")[1].innerText;
                phone = tr.getElementsByTagName("td")[2].innerText;
                desc = tr.getElementsByTagName("td")[3].innerText;
                console.log(user, email, phone, desc);
                updateusername.value = user;
                updateemail.value = email;
                updatephone.value = phone;
                updatedesc.value = desc;
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