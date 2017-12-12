<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>


<nav class="navbar navbar-light py-2 bg-light navbar-expand-md bg-faded justify-content-center">
    <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a>
    <button class="navbar-toggler justify-content-end" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="collapsingNavbar3">
        <ul class="navbar-nav justify-content-start">
            <li class="nav-item">
                <a class="nav-link" href="./index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./about.php">About</a>
            </li>
            <li class="nav-item">

            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto w-100 justify-content-end">

            <?php if (isset($_SESSION['user'])): ?>
                <li class="nav-item">

                   <p><small>Hello, <?php echo $_SESSION['user']['name']; ?></small></p>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="./profile.php">Profile</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="./app/auth/logout.php">Log out</a>
                </li>

            <?php else: ?>

              <li class="nav-item">
                  <a class="nav-link" href="./registration.php">Register</a>
              </li>

              <li class="nav-item">
                    <a class="nav-link" href="./login.php">Login</a>
              </li>
      <?php endif; ?>

        </ul>
    </div>
</nav>
