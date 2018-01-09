<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<div class="navcontainerFixed">


<nav class="addenav">

    <a class="fleshbacklogo" href="#"><?php echo $config['title']; ?></a>
    <button class="navbar-toggler justify-content-end" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbox">
        <ul class="navbar-nav addeUl">
            <li class="addeLi nav-item">
                <a class="nav-link" href="./index.php">Home</a>
            </li>
            <li class="addeLi nav-item">
                <a class="nav-link" href="./about.php">About</a>
            </li>
            <li class="addeLi nav-item">
            </li>
        </ul>
        <ul class="navbar-nav addeUl">
        <?php if (isset($_SESSION['user'])): ?>
          <p class="small loggedIn">Logged in as: <?php echo $_SESSION['user']['name']; ?></p>
          <li class="addeLi nav-item">
            <a class="nav-link" href="./profile.php">Profile</a>
          </li>
          <li class="addeLi nav-item">
            <a class="nav-link" href="./app/auth/logout.php">Log out</a>
          </li>
            <?php else: ?>
          <li class="addeLi nav-item">
            <a class="nav-link" href="./registration.php">Register</a>
          </li>
          <li class="addeLi nav-item">
            <a class="nav-link" href="./login.php">Login</a>
          </li>
      <?php endif; ?>
        </ul>
      </div>

</nav>
</div>
