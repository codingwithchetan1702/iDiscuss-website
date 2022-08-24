<?php
session_start();
include '_dbconnect.php';

echo '
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
  <a class="navbar-brand" href="index.php">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
        </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Top categories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
        $sql = "SELECT Categories_name, Categories_id FROM `categories` LIMIT 3";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
          echo  '<a class="dropdown-item" href="threads-list.php?catid='.$row['Categories_id'].'">'.$row['Categories_name'].'</a>';
        }
        echo '
        </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>';
        if(isset($_SESSION['Adminlogin']) && $_SESSION['Adminlogin']==true)
        {
        echo '
        <li class="nav-item">
          <a class="nav-link" href="admin/Addcategoier.php">Admin_Site</a>
        </li>';
        }
      echo  '
      </ul>
      <div class="raw mx-2">';
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true or isset($_SESSION['Adminlogin']) && $_SESSION['Adminlogin']==true)
{
  echo'
  </div>
  <form class="d-flex"action="search.php" method="GET">
  <input class="form-control me-2" name="search" type="search" placeholder="Search Thread" aria-label="Search">
  <button class="btn btn-success" type="submit">Search</button>
  <p class="text-light my-0 mx-2">Welcome '.$_SESSION['username'].'</p>
  <a href="partials/_logoutModal.php" role="button" class="btn btn-outline-danger ml-2">logout</a>
  </form>
  ';
}
else{
  echo'
  <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
  <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">Sign_up</button>';
}
echo '</div>
</div>
</nav>';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '
  <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Signup Successfully! </strong> you are signup successfully please login
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false"){
  echo '
  <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Error! </strong> password are not same please signup properly
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
// if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true"){
//   echo '
//   <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
//   <strong>Login Successfully! </strong> you are Login successfully
//   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
// </div>';
// }
// if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="false"){
//   echo '
//   <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
//   <strong>Error! </strong> username and password are not same 
//   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
// </div>';
// }
// if(isset($_GET['logoutsuccess']) && $_GET['logoutsuccess']=="true"){
//   echo '
//   <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
//   <strong>Logout Successfully! </strong> you are Logout successfully
//   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
// </div>';
// }
?> 