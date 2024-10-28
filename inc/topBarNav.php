<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="container-lg d-flex justify-content-between px-4">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="<?= validate_image($_settings->info('logo')) ?>" alt="System Logo">
        <span class="d-none d-lg-block"><?= $_settings->info('short_name') ?></span>
      </a>
    </div><!-- End Logo -->
    <nav class="header-nav me-auto">
      <ul class="d-flex align-items-center h-100">
        <li class="nav-item pe-3">
            <a href="<?= base_url ?>" class="nav-link">Home</a>
        </li>
        <li class="nav-item pe-3">
            <a href="<?= base_url.'?page=services' ?>" class="nav-link">Our Services</a>
        </li>
        <li class="nav-item pe-3">
            <a href="<?= base_url.'?page=booking' ?>" class="nav-link">Book Now</a>
        </li>
        <li class="nav-item pe-3">
            <a href="<?= base_url."?page=about" ?>" class="nav-link">About</a>
        </li>
        <li class="nav-item pe-3">
            <a href="<?= base_url.'?page=contact' ?>" class="nav-link">Contact Us</a>
        </li>

       
      </ul>
      
    </nav><!-- End Icons Navigation -->
    <div class="d-flex align-items-center justify-content-end">
      <?php if(isset($_SESSION['user_id'])): ?>
        <!-- Display user dropdown menu if logged in -->
        <div class="dropdown me-3">
          <button class="btn btn-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <?=$_SESSION['user_email']?> <!-- Assuming 'user_name' is the session variable containing the user's name -->
          </button>
          <ul class="dropdown-menu" aria-labelledby="userDropdown">
            <!-- <li><a class="dropdown-item" href="profile.php">Profile</a></li> -->
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </div>
      <?php else: ?>
         <!-- Display login buttons if not logged in -->
         <a href="<?= base_url.'admin' ?>" class="btn btn-primary me-3">Admin Login</a>
        <a href="login.php" class="btn btn-primary">User Login</a>
      <?php endif; ?>
    </div>
  </div>
</header><!-- End Header -->
   