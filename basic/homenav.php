<ul class="nav homenav">
    <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Dropdown</a>
        <div class="dropdown-menu dp">
            <a class="dropdown-item" href="#">Fashion</a>
            <a class="dropdown-item" href="#">Electronics</a>
            <a class="dropdown-item" href="#">Books</a>
        </div>
  </li>
  <?php 
  session_start();
  if(isset($_SESSION["uid"]) || isset($_SESSION["admineid"]))
  {
    
    if(isset($_SESSION["uid"]))
    {
      ?>
        <li class="nav-item">
        <a class="nav-link" href="cart.php">My Cart</a>
        </li>
    <?php
    }
    ?>

    <li class="nav-item">
    <a class="nav-link" href="user.php">profile</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="logout.php">Logout</a>
    </li>
  <?php
  }
  else
  {
    ?>
  <li class="nav-item">
    <a class="nav-link" href="register.php">Register</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="login.php">Login</a>
  </li>
</ul>
<?php 
  }
  ?>