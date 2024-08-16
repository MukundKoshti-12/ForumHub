<?php
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/Forum">ForumHub</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/Forum">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Top Catagories
          </a>
          <ul class="dropdown-menu">';
   
          $sql = "Select category_name,category_id from `categories` limit 3;";
          $result = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($result)){
            echo '<li><a class="dropdown-item" href="threadlist.php?catid=' . $row['category_id'] . '">' . $row['category_name'] . '</a></li>';
        }

        echo '</ul></li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
      </ul>
      <form class="d-flex mx-2" method="get" action="search.php">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success my-2 my-sm-0 mx-2" type="submit">Search</button>
      </form>';

      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
          echo '<p class="text-light my-0 mx-2"> Welcome ' . $_SESSION['useremail'] .
          '</p><a href="partials/_logout.php" class="btn btn-outline-success ml-2">Logout</a>';
          // echo "logged in";
      }
      else{
      
        echo '<button class="btn btn-outline-success ml-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
      <button class="btn btn-outline-success ml-2 mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>';
      // echo "logged out";
    }

  echo '</div>
</nav>';

include 'partials/_loginModal.php'; 
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == 'true'){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You can login!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>