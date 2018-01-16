<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<div class="navcontainerFixed">

  <nav class="navbar navbar-expand-sm navbar-light whites">
    <img class="logotype" src="/assets/chilluminati.jpeg" alt="">

    <a class="fleshbacklogo" href=""><?php echo $config['title']; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav justify-content-start w-100">
        <a class=" fixed" href="./index.php">Home</a>
        </div>
    <div class="navbar-nav justify-content-end w-100">
          <?php if (isset($_SESSION['user'])): ?>

            <p class="small welcomeUser">Hello, <?php echo $sId; ?></p>
        <a class="fixed " href="./profile.php">Profile</a>
        <a class="fixed" href="./app/auth/logout.php">Log out</a>
          <?php else: ?>
        <a class="fixed" href="./registration.php">Register</a>
        <a class="fixed" href="./login.php">Login</a>
        <?php endif; ?>

    </div>
    </div>
  </nav>

</div>
