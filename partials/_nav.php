<?php


echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/throttler">Throttler</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/throttler/home.php">Home <span class="sr-only">(current)</span></a>
      </li>';
      
      if(!isset($_SESSION["email"])){
      echo '<li class="nav-item">
        <a class="nav-link" href="/throttler/login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/throttler/signup.php">Signup</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/throttler/admin_login.php">Admin Login</a>
      </li>';
      }
      if(isset($_SESSION["email"])){
      echo '<li class="nav-item">
        <a class="nav-link" href="/throttler/logout.php">Logout</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/throttler/discussion.php">Discuss/Leave a review</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/throttler/profile.php">Profile</a>
      </li>';
      }
      
      
    echo '</ul>
    <div class="my-cart">
    <a href="/throttler/mycart.php" class="btn btn-outline-primary">
      <i class="fas fa-shopping-cart"></i> My Cart
    </a>
</div>
  </div>
</nav>';
?>